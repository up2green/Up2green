<?php

namespace Up2green\OAuthBundle\Buzz\Message;

use Buzz\Message\Request as BaseRequest;
use Up2green\OAuthBundle\OAuth\Exception as OAuthException,
    Up2green\OAuthBundle\OAuth\Consumer,
    Up2green\OAuthBundle\OAuth\Method\MethodInterface,
    Up2green\OAuthBundle\OAuth\Utils as OAuthUtils;

/**
 * OAuth Request class
 */
class Request extends BaseRequest
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * Constructor.
     *
     * @param string $method
     * @param string $resource
     * @param string $host
     * @param array  $parameters
     */
    public function __construct($method = self::METHOD_GET, $resource = '/', $host = null, $parameters = array())
    {
        $this->method     = strtoupper($method);
        $this->resource   = $resource;
        $this->host       = $host;
        $this->parameters = array_merge(array(
            'oauth_nonce'     => OAuthUtils::getNonce(),
            'oauth_timestamp' => OAuthUtils::getTimestamp(),
        ), $parameters);
    }

    /**
     * The request parameters, sorted and concatenated into a normalized string.
     *
     * @return string
     */
    public function getSignableParameters()
    {
        // Grab all parameters
        $params = $this->parameters;

        // Remove oauth_signature if present
        // Ref: Spec: 9.1.1 ("The oauth_signature parameter MUST be excluded.")
        if (isset($params['oauth_signature'])) {
            unset($params['oauth_signature']);
        }

        return $params;
    }

    /**
     * Returns the base string of this request
     *
     * The base string defined as the method, the url
     * and the parameters (normalized), each urlencoded
     * and the concated with &.
     *
     * @return string
     */
    public function getSignatureBaseString()
    {
        $parts = array(
            $this->method,
            $this->resource,
            OAuthUtils::buildHttpQuery($this->getSignableParameters())
        );

        $parts = OAuthUtils::urlencodeRfc3986($parts);

        return implode('&', $parts);
    }

    /**
     * Builds the Authorization: header
     *
     * @param array $parameters
     *
     * @return string
     * @throws OAuthException
     */
    public function buildOAuthHeader(array $parameters)
    {
        $out = 'Authorization: OAuth ';

        $first = true;
        foreach ($parameters as $k => $v) {
            if (substr($k, 0, 5) != "oauth") {
                continue;
            }

            if (is_array($v)) {
                throw new OAuthException('Arrays not supported in headers');
            }

            if (!$first) {
                $out .= ',';
            } else {
                $first = false;
            }

            $out .= OAuthUtils::urlencodeRfc3986($k);
            $out .= '="';
            $out .= OAuthUtils::urlencodeRfc3986($v);
            $out .= '"';
        }

        return $out;
    }
}
<?php

namespace Up2green\CommonBundle\Test;

use Symfony\Bundle\FrameworkBundle\Client as BaseClient;

/**
 * Client class
 * Implement here usefull functions for tests, like connect
 */
class Client extends BaseClient
{
    static protected $connection;

    protected $requested;

    protected function doRequest($request)
    {
        if ($this->requested) {
            $this->kernel->shutdown();
            $this->kernel->boot();
        }

        $this->injectConnection();
        $this->requested = true;

        return $this->kernel->handle($request);
    }

    protected function injectConnection()
    {
        if (null === self::$connection) {
            self::$connection = $this->getContainer()->get('doctrine.dbal.default_connection');
        } else {
            if (! $this->requested) {
                self::$connection->rollback();
            }
            $this->getContainer()->set('doctrine.dbal.default_connection', self::$connection);
        }

        if (! $this->requested) {
            self::$connection->beginTransaction();
        }
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return \Up2green\CommonBundle\Test\Client
     */
    public function connect($username, $password)
    {
        $form = $this->request('GET', '/login')
            ->selectButton('_submit')
            ->form(array(
                '_username' => $username,
                '_password' => $password,
            ));

        $this->submit($form);

        return $this;
    }

    /**
     * Set the sub domain part of the host for the routing
     */
    public function setSubDomain($domain)
    {
        $this->server['HTTP_HOST'] = sprintf('%s.localhost', $domain);
    }
}

<?php

namespace Up2green\UserBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Test the LocaleController 
 */
class LocaleControllerTest extends IsolatedWebTestCase
{
    /**
     * Test the changeAction 
     */
    public function testChange()
    {
        $this->client->request('GET', '/user/change-language/en');
        $this->assertTrue($this->client->getResponse() instanceof RedirectResponse);
    }
}
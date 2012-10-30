<?php

namespace Up2green\BlogBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * Test the OrganizationController of the BlogBundle
 */
class OrganizationControllerTest extends IsolatedWebTestCase
{
    /**
     * @return array
     */
    public function showProvider()
    {
        return array(
            array(200, 1),
            array(404, 5)
        );
    }

    /**
     * Test showAction
     *
     * @param integer $httpStatus Expected HTTP status code
     * @param integer $id         Requested id
     *
     * @dataProvider showProvider
     */
    public function testShow($httpStatus, $id)
    {
        $this->client->request('GET', '/blog/organization/' . $id);
        $this->assertEquals($httpStatus, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Test listAction
     */
    public function testList()
    {
        $crawler = $this->client->request('GET', '/blog/organization/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThan(0, $crawler->filter('div.item')->count());
    }
}

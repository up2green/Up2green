<?php

namespace Up2green\BlogBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * test the ProgramController of the BlogBundle
 */
class ProgramControllerTest extends IsolatedWebTestCase
{
	function showProvider()
	{
		return array(
			array(200, 1),
			array(404, 5)
		);
	}

    /**
     * Test showAction
     *
     * @dataProvider showProvider
     */
    public function testShow($httpStatus, $id)
    {
        $this->client->request('GET', '/blog/program/'.$id);
        $this->assertEquals($httpStatus, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Test listAction
     */
    public function testList()
    {
        $crawler = $this->client->request('GET', '/blog/program/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThan(0, $crawler->filter('div.item')->count());
    }
}

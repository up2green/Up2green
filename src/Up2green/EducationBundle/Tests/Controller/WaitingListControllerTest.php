<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test the WaitingListControllerTest of the EducationBundle
 *
 * @todo Find a way to pass the captcha validation
 */
class WaitingListControllerTest extends WebTestCase
{
    /**
     * Test defultAction of contact
     *
     * @param array $data Post datas
     */
    public function testJoin()
    {
        $client = static::createClient();

        $client->setSubDomain('education');
        $crawler = $client->request('GET', '/waitinglist/join');

        $form = $crawler
            ->selectButton('Soumettre')
            ->form(array(
                'join_waiting_list[firstName]'              => 'Marie',
                'join_waiting_list[lastName]'               => 'Minassyan',
                'join_waiting_list[email][email]'           => 'marie.minassyan@up2green.com',
                'join_waiting_list[email][confirm_email]'   => 'marie.minassyan@up2green.com',
                'join_waiting_list[phone_number]'           => '0667075579',
                'join_waiting_list[kits_number]'            => '2',
                'join_waiting_list[address][name]'   		=> 'Maison',
                'join_waiting_list[address][streetLine1]'   => '12 bd Edgar Quinet',
                'join_waiting_list[address][streetLine2]'   => ' ',
                'join_waiting_list[address][zipcode]'   	=> '75014',
                'join_waiting_list[address][city]'   		=> 'Paris',
                'join_waiting_list[address][country]'       => 'France',
                'join_waiting_list[captcha]'                => ''
            ));

        $client->submit($form);

        $this->assertRegExp('/Mauvaise valeur pour le code visuel/', $client->getResponse()->getContent());
    }
}

<?php

namespace ministryofjustice\SiriusPortalBundle\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $client = new Client();
        /** @var \GuzzleHttp\Message\Response $result */
        $result = $client->get('http://zf2.be.local/api/person/1',array('headers' => array('X-User-ID' => 'manager@opgtest.com')));
        $data = json_decode($result->getBody()->getContents(), true);

        return $this->render('ministryofjusticeSiriusPortalBundle:Default:index.html.twig', $data);
    }
}

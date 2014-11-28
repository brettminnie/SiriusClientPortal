<?php

namespace ministryofjustice\SiriusPortalBundle\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $uid = $request->get('uid', null);
        $dob = $request->get('dob', null);

        if (!empty($uid) && !empty($dob)) {
            $client = new Client();

            try {
                $url = 'http://zf2.be.local/api/my-cases?donor_id=' . $uid . '&dob=' . $dob;
                /** @var \GuzzleHttp\Message\Response $result */
                $result = $client->get($url, array('headers' => array('X-User-ID' => 'manager@opgtest.com')));
                $data = json_decode($result->getBody()->getContents(), true);
            } catch (RequestException $e) {
                $data['error'] = json_decode($e->getResponse()->getBody()->getContents(), true);
            }
        }
        else {
            $data = array();
        }
        return $this->render('ministryofjusticeSiriusPortalBundle:Default:index.html.twig', $data);
    }
}

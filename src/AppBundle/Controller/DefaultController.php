<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Jailbreak;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $jailbreakRepository = $this->getDoctrine()->getRepository(
            'AppBundle:Jailbreak'
        );

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            "mostRecent" => $jailbreakRepository->findBy([], [ "startiOS" => "desc" ], 1)[0],
            "jailbreaks" => $jailbreakRepository->findBy([], [ "startiOS" => "desc" ], -1, 1)
        ]);
    }

    /**
     * @Route("/help", name="help")
     */
    public function helpAction()
    {
        return $this->render('default/help.html.twig');
    }

    /**
     * @Route("/jailbreaks.json", name="jailbreakJSON")
     */
    public function jailbreaksJSONAction()
    {
        $jsonFile = file_get_contents(
            $this->get('kernel')->getRootDir() . "/data/jailbreaks.json"
        );

        $data = json_decode($jsonFile);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(JSON_UNESCAPED_SLASHES);

        return $response;
    }
}

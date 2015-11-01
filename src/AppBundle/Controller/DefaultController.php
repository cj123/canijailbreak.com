<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Jailbreak;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
}

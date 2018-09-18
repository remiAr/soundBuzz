<?php

namespace SoundBuzzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    /**
     * @Route("/")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $tracks = $em->getRepository('SoundBuzzBundle:Track')->findAll();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('SoundBuzzBundle:Default:index.html.twig', [
            'user' => $user,
            'tracks'=>$tracks
        ]);
        /*return $this->render('SoundBuzzBundle:Default:index.html.twig');*/
    }


    public function likeAction()
    {

    }

}

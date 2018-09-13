<?php

namespace SoundBuzzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $tracks = $em->getRepository('SoundBuzzBundle:Tracks')->findBy( array('user' => $this->getUser()));




        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('SoundBuzzBundle:Default:index.html.twig', [
            'user' => $user,
            'playlists'=>$playlists,
            'tracks'=>$tracks
        ]);
        return $this->render('SoundBuzzBundle:Default:index.html.twig');
    }


    public function likeAction()
    {



    }




}

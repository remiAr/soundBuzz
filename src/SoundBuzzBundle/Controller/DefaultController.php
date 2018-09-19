<?php

namespace SoundBuzzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Sensio\Bundle\FrameworkExtraBundle\Configuration\Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tracks = $em->getRepository('SoundBuzzBundle:Track')->findAll();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $playlists = $em->getRepository('SoundBuzzBundle:Playlist')->findAll();

        return $this->render('SoundBuzzBundle:Default:index.html.twig', [
            'user' => $user,
            'tracks'=>$tracks,
            'playlists' => $playlists
        ]);
    }
}

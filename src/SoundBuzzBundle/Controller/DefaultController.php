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
        dump($this->getUser()->getId());

        $playlists = $em->getRepository('SoundBuzzBundle:Playlist')->findBy( array('user' => $this->getUser()));  
        
        foreach($playlists as $p) { 
    
            $tracks=$p->getTrack()->toArray();      
    
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('SoundBuzzBundle:Default:index.html.twig', [
            'user' => $user,
            'playlists'=>$playlists,
            'tracks'=>$tracks
        ]);
    }


    public function likeAction()
    {



    }




}

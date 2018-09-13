<?php

namespace SoundBuzzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PlaylistController extends Controller
{
    public function userPlaylistAction()
    {

        $em = $this->getDoctrine()->getManager();
        //dump($this->getUser()->getId());

        $playlists = $em->getRepository('SoundBuzzBundle:Playlist')->findBy( array('user' => $this->getUser()));
        $tracks = $playlists;
        //dump($playlists);
        foreach($playlists as $p) {
            $tracks =$p->getTrack()->toArray();

        }

        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('SoundBuzzBundle:Playlist:displayPlaylist.html.twig', [
            'user' => $user,
            'playlists'=>$playlists,
            'tracks'=>$tracks
        ]);
     
    }
   

}
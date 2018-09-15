<?php

namespace SoundBuzzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlaylistController extends Controller
{
    public function userPlaylistAction()
    {
        $em = $this->getDoctrine()->getManager();

        $playlists = $em->getRepository('SoundBuzzBundle:Playlist')->findBy( array('user' => $this->getUser()));

        $user = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('SoundBuzzBundle:Playlist:displayPlaylist.html.twig', [
            'user' => $user,
            'playlists' => $playlists,
        ]);
    }

    public function userPlaylistSongsAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $playlist = $em->getRepository('SoundBuzzBundle:Playlist')->find($id);
        $tracks = $playlist->getTracks()->toArray();
        $user = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('SoundBuzzBundle:Playlist:displayPlaylistSongs.html.twig', [
            'user' => $user,
            'playlist' => $playlist,
            'tracks' => $tracks
        ]);
    }
}
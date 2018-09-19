<?php

namespace SoundBuzzBundle\Controller;

use SoundBuzzBundle\Entity\Playlist;
use SoundBuzzBundle\Entity\Track;
use SoundBuzzBundle\Form\AddPlaylist;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlaylistController extends Controller
{
    public function userPlaylistAction()
    {
        $em = $this->getDoctrine()->getManager();
        $playlists = $em->getRepository('SoundBuzzBundle:Playlist')->findBy( array('user' => $this->getUser()));

        return $this->render('SoundBuzzBundle:Playlist:displayPlaylist.html.twig', [
            'user' => $this->get('security.token_storage')->getToken()->getUser(),
            'playlists' => $playlists,
        ]);
    }

    public function getAllPlaylistsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $playlists = $em->getRepository('SoundBuzzBundle:Playlist')->findAll();

        return $this->render('SoundBuzzBundle:Playlist:allPlaylists.html.twig', array(
            'playlists' => $playlists,
        ));
    }

    public function getAllPlaylistsConecAction()
    {
        $em = $this->getDoctrine()->getManager();
        $playlists = $em->getRepository('SoundBuzzBundle:Playlist')->findAll();

        return $this->render('SoundBuzzBundle:Playlist:allPlaylists.html.twig', array(
            'user' => $this->get('security.token_storage')->getToken()->getUser(),
            'playlists' => $playlists,
        ));
    }

    public function userPlaylistSongsAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $playlist = $em->getRepository('SoundBuzzBundle:Playlist')->find($id);
        $tracks = $playlist->getTracks()->toArray();

        return $this->render('SoundBuzzBundle:Playlist:displayPlaylistSongs.html.twig', [
            'user' => $this->get('security.token_storage')->getToken()->getUser(),
            'playlist' => $playlist,
            'tracks' => $tracks
        ]);
    }

    public function addPlaylistAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $playlist = new Playlist();
        $user = $this->getUser();

        $addPlaylistForm = $this->createForm(AddPlaylist::class, $playlist);
        $addPlaylistForm->handleRequest($request);

        if ($addPlaylistForm->isSubmitted() && $addPlaylistForm->isValid())
        {
            $playlist = $addPlaylistForm->getData();
            dump($playlist);
            $playlist->setUser($user);
            $playlist->setDuration(\DateTime::createFromFormat('Y-m-d h:i:s', date('Y-m-d h:i:s')));
            $playlist->setCreatedAt(\DateTime::createFromFormat('Y-m-d h:i:s', date('Y-m-d h:i:s')));
            $playlist->setUpdatedAt(\DateTime::createFromFormat('Y-m-d h:i:s', date('Y-m-d h:i:s')));

            $em->persist($playlist);
            $em->flush();

            $playlists = $em->getRepository('SoundBuzzBundle:Playlist')->findBy( array('user' => $this->getUser()));

            return $this->render('SoundBuzzBundle:Playlist:displayPlaylist.html.twig', array(
                'playlists' => $playlists,
                'user' => $user,
            ));
        }

        return $this->render('SoundBuzzBundle:Playlist:addPlaylist.html.twig', array(
            'addPlaylistForm' => $addPlaylistForm->createView(),
            'user' => $user,
        ));
    }

    public function addTracksAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $playlist = $em->getRepository(Playlist::class)->find($id);
        $tracks = $em->getRepository(Track::class)->findAll();
        $tracks = array_filter($tracks, function($track) use($playlist) {
            return !$playlist->playlistContainsTrack($track);
        });

        return $this->render('SoundBuzzBundle:Playlist:addTracks.html.twig', array(
            'playlist' => $playlist,
            'tracks' => $tracks,
            'user' => $this->getUser(),
        ));
    }

    public function trackAddedAction($id, $trackId)
    {
        $em = $this->getDoctrine()->getManager();
        $playlist = $em->getRepository(Playlist::class)->find($id);
        $track = $em->getRepository(Track::class)->find($trackId);

        $playlist->setTracks($track);

        $em->persist($playlist);
        $em->flush();

        return $this->render('SoundBuzzBundle:Playlist:displayPlaylistSongs.html.twig', array(
            'playlist' => $playlist,
            'tracks' => $playlist->getTracks()->toArray(),
            'user' => $this->getUser(),
        ));
    }
}

<?php

namespace SoundBuzzBundle\Controller;

use SoundBuzzBundle\Entity\Comments;
use SoundBuzzBundle\Entity\Track;
use SoundBuzzBundle\Form\AddComment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        dump($this->getUser()->getId());

        $tracks = $em->getRepository('SoundBuzzBundle:Track')->findBy(
            array('user' => $this->getUser())
        );
        $user= $this->getUser();

        return $this->render('SoundBuzzBundle:Track:index.html.twig', array(
            'tracks' => $tracks,
            'user' => $user
        ));
    }

    public function getAllTracksAction() {
        $em = $this->getDoctrine()->getManager();
        $tracks = $em->getRepository('SoundBuzzBundle:Track')->findAll();

        return $this->render('SoundBuzzBundle:Track:allTracks.html.twig', array(
            'tracks' => $tracks,
        ));
    }
    public function getAllTracksConecAction() {
        $em = $this->getDoctrine()->getManager();
        $tracks = $em->getRepository('SoundBuzzBundle:Track')->findAll();
        $user= $this->getUser();
        return $this->render('SoundBuzzBundle:Track:allTracks.html.twig', array(
            'user' => $user,
            'tracks' => $tracks,
        ));
    }

    public function getTrackAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $track = $em->getRepository('SoundBuzzBundle:Track')->find($id);
        $genres = $track->getGenres();
        $user= $track->getUser();
        $comments = $this->getDoctrine()
            ->getRepository(Comments::class)
            ->findBy(array('track' => $track));

        $newComment = new Comments();
        $addCommentForm = $this->createForm(AddComment::class, $newComment);
        $addCommentForm->handleRequest($request);

        if ($addCommentForm->isSubmitted() && $addCommentForm->isValid())
        {
            $newComment = $addCommentForm->getData();
            $newComment->setUser($user);
            $newComment->setCreatedAt(
                \DateTime::createFromFormat(
                    'Y-m-d h:i:s', date('Y-m-d h:i:s'))
            );
            $newComment->setTrack($track);

            $em->persist($newComment);
            $em->flush();
        }

        return $this->render('SoundBuzzBundle:Track:trackInformation.html.twig', array(
            'track' => $track,
            'user' => $user,
            'comments' => $comments,
            'genres' => $genres,
            'addCommentForm' => $addCommentForm->createView(),
        ));
    }

    public function uploadTrackAction(Request $request)
    {
        $track = new Track();

        // Get connected user
        $user = $this->getUser();

        $form = $this->createForm('SoundBuzzBundle\Form\TrackType', $track);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // GET DATA FORM
            $data = $form->getData();

            // SONG
            $fileSong = $track->getSong();
            $fileNameSong = $fileSong->getClientOriginalName();
            $fileSong->move($this->getParameter('tracks_directory')."/", $fileNameSong);
            $track->setSong($fileNameSong);

            // PICTURE
            $filePictureSong = $track->getSongPicture();
            $fileNamePictureSong =$filePictureSong->getClientOriginalName();
            $filePictureSong->move($this->getParameter('pictures_directory')."/", $fileNamePictureSong);
            $track->setSongPicture($fileNamePictureSong);

            // Query Doctrine
            $track = new Track();
            $track->setExtension($fileSong->getClientOriginalExtension());
            $track->setTitle($data->getTitle());
            $track->setDescription($data->getDescription());
            $track->setUrlPicture($fileNamePictureSong);
            $track->setUrlTrack($fileNameSong);
            $track->setCompositor($user->getFirstName());
            $track->setExplicitContent("0");
            $track->setDownloadAuthorization("0");
            $track->setTransferredAt(new \DateTime('now'));
            $track->setDuration(0);
            $track->setNbListenings(0);
            $track->setNbDownloads(0);
            $track->setNbViews(0);
            $track->setNbLikes(0);
            $track->setUpdatedAt(new \DateTime('now'));
            $track->setCreatedAt(new \DateTime('now'));
            $track->setNbComments(0);
            $track->setIsValidated(0);
            $track->setUser($user);
            $track->setGenres($data->getGenres());

            // Persist data in the DB
            $em = $this->getDoctrine()->getManager();
            $em->persist($track);
            $em->flush();

            return new Response("User song is uploaded successful.");
        } else {
            return $this->render('SoundBuzzBundle:Track:uploadTrack.html.twig', array(
                'form' => $form->createView(),
                'user' => $user,
            ));
        }
    }

    public function editAction(Request $request, Track $track)
    {
        $editForm = $this->createForm('SoundBuzzBundle\Form\TrackType', $track);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('track_edit', array('id' => $track->getId()));
        }

        return $this->render('SoundBuzzBundle:Track:edit.html.twig', array(
            'track' => $track,
            'edit_form' => $editForm->createView(),
            'user' => $this->getUser(),
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $track = $em->getRepository(Track::class)->find($id);

        $em->remove($track);
        $em->flush();

        return $this->redirectToRoute('track_index');
    }

    public function likeAction($id)
    {
        /**
         * TODO
         * Generate a url without parameters (redirect to '/')
         * Recalculate nbLikes after like is done
         */
        $em = $this->getDoctrine()->getManager();
        $tracks = $em->getRepository(Track::class)->findAll();
        $track = $em->getRepository(Track::class)->find($id);
        $user = $this->getUser();

        $track->setLikedByUsers($user);
        $track->setNbLikes(sizeof($track->getLikedByUsers()));

        $em->persist($track);
        $em->flush();

        return $this->render('SoundBuzzBundle:Default:index.html.twig', [
            'user' => $user,
            'tracks' => $tracks,
        ]);
    }

    public function downloadAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $track = $em->getRepository(Track::class)->find($id);

        $currentNumber = $track->getNbDownloads();

        $track->setNbDownloads( $currentNumber + 1 );

        $em->persist($track);
        $em->flush();

        $user = $this->getUser();
        $tracks = $em->getRepository(Track::class)->findAll();

        return $this->redirectToRoute('track_information', array('id' => $track->getId()));

    }
}

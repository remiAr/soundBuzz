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

    public function getTrackAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $track = $em->getRepository('SoundBuzzBundle:Track')->find($id);

        // Traitement de l'ArrayCollection $genres du track
        $genres = $track->getGenres();
        dump($genres);

        $tmp = [];

        foreach ($genres as $genre) {
            array_push($tmp, [
                'name' => $genre->getName(),
            ]);
        }

        dump($tmp[0]['name']);
        // ------------------------------------------------

        $user= $track->getUser();
        $comments = $this->getDoctrine()
            ->getRepository(Comments::class)
            ->findBy(array('track' => $track));

        $newComment = new Comments();
        $addCommentForm = $this->createForm(AddComment::class, $newComment);

        $addCommentForm->handleRequest($request);

        if ($addCommentForm->isSubmitted() && $addCommentForm->isValid()) {
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
            'addCommentForm' => $addCommentForm->createView(),
        ));
    }

    public function uploadTrackAction(Request $request)
    {
        $track = new Track();

        //Get connected user
        $user = $this->getUser();

        $form= $this->createForm('SoundBuzzBundle\Form\TrackType', $track);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //GET DATA FORM
            $data = $form->getData();

            //SONG
            $fileSong = $track->getSong();
            $fileNameSong =$fileSong->getClientOriginalName();
            $fileSong->move($this->getParameter('tracks_directory')."/". $user->getId(), $fileNameSong);
            $track->setSong($fileNameSong);


            //PICTURE
            $filePictureSong = $track->getSongPicture();
            $fileNamePictureSong =$filePictureSong->getClientOriginalName();
            $filePictureSong->move($this->getParameter('pictures_directory')."/". $user->getId(), $fileNamePictureSong);
            $track->setSongPicture($fileNamePictureSong);



            //Query Doctrine
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
            $track->setGenre($data->getGenre());
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


    

}

<?php

namespace SoundBuzzBundle\Controller;

use SoundBuzzBundle\Entity\Track;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use SoundBuzzBundle\Form\TrackFormType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\FileType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  

use Symfony\Component\HttpFoundation\Response;
/**
 * Track controller.
 *
 */
class TrackController extends Controller
{
 
 
     /**
     * Display tracks
     *
     * @Route("/tracks", name="track_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        dump($this->getUser()->getId());


        $tracks = $em->getRepository('SoundBuzzBundle:Track')->findBy( array('user' => $this->getUser()));
        
       

        return $this->render('SoundBuzzBundle:Track:index.html.twig', array(
            'tracks' => $tracks,
        ));
    }

    /**
     * @Route("/trackUplodad", name="track_new")
     */
    public function uploadTrackAction(Request $request)
    {


        $track = new Track(); 
       $form= $this->createForm('SoundBuzzBundle\Form\TrackType', $track);

         
         
           $form->handleRequest($request); 
           if ($form->isSubmitted() && $form->isValid()) { 
             
              //SONG
              $fileSong = $track->getSong(); 
              $fileNameSong =$fileSong->getClientOriginalName();
              $fileSong->move($this->getParameter('tracks_directory'), $fileNameSong); 
              $track->setSong($fileNameSong); 
              

                //PICTURE
                $filePictureSong = $track->getSongPicture(); 
                $fileNamePictureSong =$filePictureSong->getClientOriginalName();
                $filePictureSong->move($this->getParameter('tracks_directory'), $fileNamePictureSong); 
                $track->setSongPicture($fileNamePictureSong); 
                

     
              
             //Get connected user
             $user = $this->getUser();


               //GET DATA FORM
               $data = $form->getData();
            
        
                 //Query Doctrine
               $track = new Track();
               $track->setExtension($fileSong->getClientOriginalExtension());
               $track->setTitle($data->getTitle());
               $track->setDescription($data->getDescription());
               $track->setUrlPicture($this->getParameter('tracks_directory').'/'. $fileNameSong);
               $track->setUrlTrack($this->getParameter('tracks_directory').'/'. $fileNamePictureSong);
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


              return new Response("User song is uploaded succefull."); 
           } else { 

        return $this->render('SoundBuzzBundle:Track:uploadTrack.html.twig', array(

            'form' => $form->createView(),

        ));

    }
}

    /**
     * Delete a track
     *
     * @Route("/{id}/edit", name="track_edit")
     * @Method("DELETE")
     */
    public function editAction(Request $request, Track $track)
    {
        $deleteForm = $this->createDeleteForm($track);
        $editForm = $this->createForm('SoundBuzzBundle\Form\TrackType', $track);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('track_edit', array('id' => $track->getId()));
        }

        return $this->render('SoundBuzzBundle:Track:edit.html.twig', array(
            'track' => $track,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Delete a track
     *
     * @Route("/{id}/delete", name="track_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Track $track)
    {
        dump("test");
        $form = $this->createDeleteForm($track);
        $form->handleRequest($request);
        
            dump($track);
            $em = $this->getDoctrine()->getManager();
            $tracke = $em->getRepository(Track::class)->find($track->getId());
            $em->remove($tracke);
            $em->flush();
        

        return $this->redirectToRoute('track_display');
    }



    /**
     * Creates a form to delete a track entity.
     *
     * @param Track $track The track entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Track $track)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('track_index ', array('id' => $track->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

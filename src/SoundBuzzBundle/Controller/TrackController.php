<?php

namespace SoundBuzzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SoundBuzzBundle\Entity\Track;
use SoundBuzzBundle\Form\TrackFormType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\FileType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use \DateTime;


class TrackController extends Controller
{
    /**
     * @Route("/")
     */
    public function uploadTrackAction(Request $request)
    {


        $track = new Track(); 
        $form = $this->createForm(TrackFormType::class, $track) ;
         
         
           $form->handleRequest($request); 
           if ($form->isSubmitted() && $form->isValid()) { 
              $file = $track->getSong(); 
              $fileName =$file->getClientOriginalName();
              $file->move($this->getParameter('tracks_directory'), $fileName); 
              $track->setSong($fileName); 
              
               //Get connected user
               $user = $this->getUser();


               //GET DATA FORM
               $data = $form->getData();
            
        
                 //Query Doctrine
               $track = new Track();
               $track->setExtension($file->getClientOriginalExtension());
               $track->setTitle($data->getTitle());
               $track->setDescription($data->getDescription());
               $track->setUrlPicture($this->getParameter('tracks_directory').'/'. $fileName);
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
}
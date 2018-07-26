<?php

namespace SoundBuzzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SoundBuzzBundle\Entity\Track;
use SoundBuzzBundle\Form\TrackType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\FileType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class TrackController extends Controller
{
    /**
     * @Route("/")
     */
    public function uploadTrackAction(Request $request)
    {


        $track = new Track(); 
        $form = $this->createFormBuilder($track) 
           
           ->add('song', FileType::class, array('label' => 'Song')) 
           ->add('save', SubmitType::class, array('label' => 'Submit')) 
           ->getForm(); 
         
           $form->handleRequest($request); 
           if ($form->isSubmitted() && $form->isValid()) { 
              $file = $track->getSong(); 
              $fileName = md5(uniqid()).'.'.$file->guessExtension(); 
              $file->move($this->getParameter('tracks_directory'), $fileName); 
              $track->setSong($fileName); 
              return new Response("User song is uploaded succefull."); 
           } else { 

        return $this->render('SoundBuzzBundle:Track:uploadTrack.html.twig', array(

            'form' => $form->createView(),

        ));

    }
    }
}
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
        $tracks = $em->getRepository('SoundBuzzBundle:Track')->findAll();

        
      
           
        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('SoundBuzzBundle:Default:index.html.twig', [
            'user' => $user,
            'tracks'=>$tracks
        ]);
        /*return $this->render('SoundBuzzBundle:Default:index.html.twig');*/
    }


    public function likeAction()
    {

    }

    public function searchAction() {
       
        $searchterm = $searchString = $request->get('Search');
    
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('select t.title from SoundBuzzBundle:Track t WHERE t.title LIKE :title')
        ->setParameter('title','%'."HEY".'%');
        $test = $query->getResult();
    
        dump($test);
      
        return $this->render('SoundBuzzBundle:Default:displaySearchingTracks.html.twig', [
          
            'tracks'=>$test
        ]);
    }



}

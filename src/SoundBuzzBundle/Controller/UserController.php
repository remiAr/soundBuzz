<?php

namespace SoundBuzzBundle\Controller;
use SoundBuzzBundle\Form\RegistrationFormType;
use SoundBuzzBundle\Form\UpdateUserType;
use FOS\UserBundle\Form\Type\ProfileFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{

     /**
     * @Route("/profil/{id}")
     */
    public function getProfilAction($id)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('SoundBuzzBundle:User');

        $profil = $repository->find($id);	

        return $this->render('SoundBuzzBundle:Admin:profil.html.twig', [
            'user' => $profil,
        ]);
    }
    public function getplaylists() {
        $em = $this->getDoctrine()->getManager();
        dump($this->getUser()->getId());

        $playlists = $em->getRepository('SoundBuzzBundle:Playlist')->findBy( array('user' => $this->getUser()));
        //$tracks = $playlists;
        //dump($playlists);
        foreach($playlists as $p) {
            $tracks =$p->getTrack()->toArray();

        }

        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('SoundBuzzBundle:Default:index.html.twig', [
            'user' => $user,
            'playlists'=>$playlists,
            'tracks'=>$tracks
        ]);
    }
    /* public function updateProfilAction(Request $request, $id) {

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:User');

        $profil = $repository->find($id);

        $form =$this->createForm(UpdateUserType::class, $profil);

        if($request->isMethod('POST')) {

            $form->handleRequest($request);

            $em = $this->getDoctrine()->getManager();

            $em->persist($profil);

            $em->flush();

            return $this->redirectToRoute('emotion_profil', ['id' => $profil->getId()]);
        }

        return $this->render('EmotionBundle:Admin:updateProfil.html.twig', ['form' => $form->createView()]);
    }

    public function deleteUserAction($id) {

        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:User');

        $user = $repository->find($id);

        $em->remove($user);

        $em->flush();

        return $this->redirectToRoute('emotion_homepage');
    } */
}

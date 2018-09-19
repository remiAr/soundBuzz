<?php

namespace SoundBuzzBundle\Controller;

use SoundBuzzBundle\Form\UpdateUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function getProfilAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('SoundBuzzBundle:User');
        $userProfile = $repository->find($id);
        $userConnected = $this->getUser();

        return $this->render('SoundBuzzBundle:Admin:profil.html.twig', [
            'user' => $userProfile,
            'userIsConnected' => $userProfile->getId() === $userConnected->getId(),
        ]);
    }

    public function updateProfilAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository('SoundBuzzBundle:User');
        $profil = $repository->find($id);

        $form =$this->createForm(UpdateUserType::class, $profil);

        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            $em = $this->getDoctrine()->getManager();
            $em->persist($profil);
            $em->flush();

            return $this->redirectToRoute('soundbuzz_profil', ['id' => $profil->getId()]);
        }

        return $this->render('SoundBuzzBundle:Admin:updateProfil.html.twig', [
                'user' => $profil,
                'form' => $form->createView(),
            ]
        );
    }

    public function deleteUserAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('SoundBuzzBundle:User');
        $user = $repository->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('soundbuzz_homepage');
    }

    public function getplaylists()
    {
        $em = $this->getDoctrine()->getManager();
        $playlists = $em->getRepository('SoundBuzzBundle:Playlist')->findBy(array('user' => $this->getUser()));

        foreach ($playlists as $p)
        {
            $tracks =$p->getTracks()->toArray();
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('SoundBuzzBundle:Default:index.html.twig', [
            'user' => $user,
            'playlists' => $playlists,
            'tracks' => $tracks
        ]);
    }
}

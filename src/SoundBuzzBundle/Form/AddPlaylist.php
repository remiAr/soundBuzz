<?php

// src/SoundBuzzBundle/Form/AddPlaylist.php
namespace SoundBuzzBundle\Form;

use SoundBuzzBundle\Entity\Playlist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddPlaylist extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Titre'))
            ->add('description', TextType::class, array('label' => 'Decription'))
            ->add('save', SubmitType::class, array('label' => 'Créer la playlist'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Playlist::class,
        ));
    }
}

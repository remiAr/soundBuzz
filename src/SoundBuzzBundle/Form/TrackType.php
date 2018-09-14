<?php

namespace SoundBuzzBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrackType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         ->add('title', TextType::class, array('label' => 'Titre'))
            ->add('genres')
            ->add('description', TextType::class, array('label' => 'Description'))
           ->add('song', FileType::class, array('label' => 'Track'))
           ->add('songPicture', FileType::class, array('label' => 'Track picture'))  
           ->add('save', SubmitType::class, array('label' => 'Submit')) 
           ->getForm(); 
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoundBuzzBundle\Entity\Track'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'soundbuzzbundle_track';
    }


}

<?php

namespace SoundBuzzBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

    

use SoundBuzzBundle\Entity\Track;
use SoundBuzzBundle\Form\TrackType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\FileType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  

class TrackType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         ->add('title', TextType::class, array('label' => 'Titre'))
            ->add('genre')
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

<?php
namespace SoundBuzzBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use SoundBuzzBundle\Entity\Track;
use SoundBuzzBundle\Form\TrackType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\FileType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  


class TrackFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
         ->add('title', TextType::class, array('label' => 'Titre'))
            ->add('genre')
            ->add('description', TextType::class, array('label' => 'Description'))
           ->add('song', FileType::class, array('label' => 'Song')) 
           ->add('save', SubmitType::class, array('label' => 'Submit')) 
           ->getForm(); 

    }

}
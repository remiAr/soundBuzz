<?php
namespace SoundBuzzBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('avatarUrl')
            ->add('isActivated', HiddenType::class, array(
                "data"=> "1",
            ))
            ->add('createdAt', HiddenType::class, array(
                "data" => date("Y-m-d"),
            ))
            ->remove('username');
    }
    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }
}
<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,['attr'=>['class'=>'input','placeholder'=>'Votre nom']])
            ->add('email',EmailType::class,['attr'=>['class'=>'input','placeholder'=>'votre email']])
             ->add('phone',TextType::class,['attr'=>['class'=>'input','placeholder'=>'votre numero de phone']])
            ->add('password', PasswordType::class,['attr'=>['class'=>'input','placeholder'=>'votre mot de passe']])
            ->add('confirm_password',PasswordType::class,['attr'=>['class'=>'input','placeholder'=>'confirmer le mot de passe']])
            ->add('inscription',submitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

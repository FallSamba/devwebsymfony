<?php

namespace App\Form;

use App\Entity\Plat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('prix')
            ->add('descritpion')
            ->add('picture' , FileType::class , array('data_class' => null,'required' => false ))
            ->add('ajouter',submitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}

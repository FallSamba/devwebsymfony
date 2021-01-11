<?php

namespace App\Form;

use App\Entity\Platsearch;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlatsearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
              ->add('name',TextType::class,['required'=>false,

                'label'=>false, 

               'attr'=>['placeholder'=>'Rechercher plat']])


             // ->add('submit', SubmitType::class,['label'=>'Rechercher'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Platsearch::class,
        ]);
    }
}

<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use App\Entity\Evenement;
use App\Entity\Categorieevt;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEvt',TextType::class)
            ->add('descriptionEvt',TextareaType::class)
            ->add('dateEvt',DateType::class, [
                'widget' => 'single_text','attr' => ['class' => 'js-datepicker'],
            ])
            ->add('heureEvt',TimeType::class,['widget'  => 'single_text'])
            ->add('lieuEvt',TextareaType::class)
            ->add('responsable',EmailType::class)
            ->add('places',NumberType::class)
            ->add('categorie',EntityType::class,['class'=>Categorieevt::class,'choice_label'=>'nomCategorie','placeholder' => 'Choisir une catégorie'])
           
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}

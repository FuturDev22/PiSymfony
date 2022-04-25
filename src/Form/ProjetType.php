<?php

namespace App\Form;

use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_projet')

            ->add('categorieProj',ChoiceType::class,[
                'choices'=> array(
                    'Immobilier'=>'Immobilier',
                    'Santé'=>'Santé',
                    'Innovation'=>'Innovation',
                    'Numérique'=>'Numérique',
                    'transition énergétique'=>'transition énergétique',
                    'Alimentation'=>'Alimentation',
                    'Hummanitaire'=>'Hummanitaire',
                )
            ])

            ->add('date_debut',
                DateType::class, [
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'by_reference' => true,

    ])
            ->add('date_fin',
                DateType::class,
                [
                'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'by_reference' => true,
            ])
            ->add('montant_demandee')
            ->add('montant_collecte')
            ->add('etat_projet',ChoiceType::class,[
                'choices'=> array(
                    'Ouverture'=>'Ouverture',
                    'Collecte en cours'=>'Collecte en cours',
                    'Clôture en cours'=>'Clôture en cours',
                )
            ])
            ->add('ajouter',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
         //   'data_class' => Projet::class,
        ]);
    }
}

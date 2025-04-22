<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Requete;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequeteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            /* ->add('created_at', DateType::class, [
                'widget' => 'single_text'
            ]) */
            ->add('type' , TextType::class , [
                    "required" => false,
                    "help" => "catégorie de la requête, ce champ contient au moins 2 lettres"
            ])
            ->add('deadline', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('price')
            ->add('title')
            ->add('description')
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'id',
                'multiple' => true,
                "required" => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Requete::class,
        ]);
    }
}

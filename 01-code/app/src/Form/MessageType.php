<?php

namespace App\Form ;

use App\Options\CategorieEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

class MessageType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder-> add("categorie", EnumType::class, [
            "class" => CategorieEnum::class,
            'placeholder' => 'Choose an option',
            /* "choice_label" => function($choice, string $key, mixed $value){
                return $value;
            }, */
            "choice_value" => function(?CategorieEnum $choice){
                dump($choice);
                return $choice ? $choice->name : '';
            },
            "choice_name" => function(?CategorieEnum $choice){
                return $choice ? $choice->value : '';
            }
        ]);
    }

}
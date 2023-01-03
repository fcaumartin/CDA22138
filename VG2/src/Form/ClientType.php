<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [ 'class' => 'toto' ],
                'constraints' => [
                    new NotBlank(),
                    
                    new Regex([
                        'pattern' => '/[0-9]{3,}/',
                        'message' => "Vous devez entrer des chiffres"
                    ])
                ]
            ])
            ->add('prenom', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add("test", CheckboxType::class, [
                'mapped' => false
            ])
            ->add("test2", ChoiceType::class, [
                'mapped' => false,
                'expanded' => true,
                'choices'  => [
                    'Masculin' => 'm',
                    'Feminin' => 'f',
                    'Je ne sais pas encore !!!' => 'ng',
                ]
            ])
            ->add('ville')
            ->add("Valider", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('field_name')
            ->add('liste', EntityType::class, [
                'class' => Commande::class,
                'choice_label' => 'liste des commandes',
                'label' => 'liste des commandes',
                'query_builder' => function ($repo) use ($options) {
                    return $repo->createQueryBuilder('c')
                    ->select('c')
                    ->where('c.id = :id')
                    ->setParameter('id', $options['data']);
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

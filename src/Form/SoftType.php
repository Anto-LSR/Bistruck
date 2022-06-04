<?php

namespace App\Form;

use App\Entity\Soft;
use App\Entity\TypeBoisson;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class SoftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('libelle')
            ->add('prix')
            ->add('typeBoisson', EntityType::class, [
                'class' => TypeBoisson::class,
                'choice_label' => function (?TypeBoisson $typeBoisson) {
                    return $typeBoisson ? strtoupper($typeBoisson->getLibelle()) : '';
                }
            ])
            ->add('Ajouter', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Soft::class,
        ]);
    }
}

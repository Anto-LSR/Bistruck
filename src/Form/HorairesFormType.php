<?php

namespace App\Form;

use App\Entity\Horaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HorairesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lundi', TimeType::class, [
                'label' => 'Ouverture'
            ])
            ->add('lundiFermeture', TimeType::class, [
                'label' => 'Fermeture'
            ])

            ->add('mardi', TimeType::class, [
                'label' => 'Ouverture'
            ])
            ->add('mardiFermeture', TimeType::class, [
                'label' => 'Fermeture'
            ])
            ->add('mercredi', TimeType::class, [
                'label' => 'Ouverture'
            ])
            ->add('mercrediFermeture', TimeType::class, [
                'label' => 'Fermeture'
            ])
            ->add('jeudi', TimeType::class, [
                'label' => 'Ouverture'
            ])
            ->add('jeudiFermeture', TimeType::class, [
                'label' => 'Fermeture'
            ])
            ->add('vendredi', TimeType::class, [
                'label' => 'Ouverture'
            ])
            ->add('vendrediFermeture', TimeType::class, [
                'label' => 'Fermeture'
            ])
            ->add('samedi', TimeType::class, [
                'label' => 'Ouverture'
            ])
            ->add('samediFermeture', TimeType::class, [
                'label' => 'Fermeture'
            ])
            ->add('dimanche', TimeType::class, [
                'label' => 'Ouverture'
            ])
            ->add('dimancheFermeture', TimeType::class, [
                'label' => 'Fermeture'
            ])
            ->add('closedToday', CheckboxType::class, [
                'label' => 'Ferm?? cette semaine',
                'required' => false
            ])


            ->add('closedLundi', CheckboxType::class, [
                'label' => 'Ferm?? lundi',
                'required' => false
            ])
            ->add('closedMardi', CheckboxType::class, [
                'label' => 'Ferm?? Mardi',
                'required' => false
            ])
            ->add('closedMercredi', CheckboxType::class, [
                'label' => 'Ferm?? Mercredi',
                'required' => false
            ])
            ->add('closedJeudi', CheckboxType::class, [
                'label' => 'Ferm?? Jeudi',
                'required' => false
            ])
            ->add('closedVendredi', CheckboxType::class, [
                'label' => 'Ferm?? Vendredi',
                'required' => false
            ])
            ->add('closedSamedi', CheckboxType::class, [
                'label' => 'Ferm?? Samedi',
                'required' => false
            ])
            ->add('closedDimanche', CheckboxType::class, [
                'label' => 'Ferm?? dimanche',
                'required' => false
            ])




            ->add('Valider', SubmitType::class, [
                'label' => "Valider les heures d'ouverture"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Horaires::class,
        ]);
    }
}

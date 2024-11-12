<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Maintenance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaintenanceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('serviceDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Service Date',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description of Maintenance',
            ])
            ->add('oilChange', CheckboxType::class, [
                'label' => 'Oil Change',
                'required' => false,
            ])
            ->add('brakeInspection', CheckboxType::class, [
                'label' => 'Brake Inspection',
                'required' => false,
            ])
            ->add('tireChange', CheckboxType::class, [
                'label' => 'Tire Change',
                'required' => false,
            ])
            ->add('filterChange', CheckboxType::class, [
                'label' => 'Filter Change',
                'required' => false,
            ])
            ->add('fluidTopUp', CheckboxType::class, [
                'label' => 'Fluid Top-Up',
                'required' => false,
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}

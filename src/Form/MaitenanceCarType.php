<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaitenanceCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('make', ChoiceType::class,)
            ->add('model')
            ->add('year')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Oil Change' => 'Oil Change',
                    'Tire Rotation' => 'Tire Rotation',
                    'Brake Inspection' => 'Brake Inspection',
                    'Other' => 'Other',
                ],
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('mileage', IntegerType::class, [
                'required' => false,
            ])
             ->add('submit', SubmitType::class,[
                    'attr'=> [
                        'class' => 'btn btn-primary mt-4'
                    ],
                    'label' => 'Register Car'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}

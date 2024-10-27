<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('fullName', TextType::class, [
                'attr' =>[
                    'class' =>'form-control',
                    'minLength' =>'2',
                    'maxLength' => '50'
                ],
                'label' => 'Full Name',
                'label_attr'=> [
                    'class' =>'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 2, 'max' => 50])
                ]
            ])
            ->add('email', EmailType::class,[
                 'attr' =>[
                    'class' =>'form-control',
                    'minLength' =>'2',
                    'maxLength' => '180'
                ],
                'label' => 'Email ',
                'label_attr'=> [
                    'class' =>'form-label mt-4'
                ],
                 'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Length(['min' => 2, 'max' => 180]),
                ]
            ])
            ->add('address', TextType::class,[  'attr' =>[
                    'class' =>'form-control',
                    'minLength' =>'6',
                    'maxLength' => '180'
                    ],
                'label' => 'Address ',
                'label_attr'=> [
                 'class' =>'form-label mt-4'
              ]
            ])
           /* ->add('submit', SubmitType::class,[
                    'attr'=> [
                        'class' => 'btn btn-primary mt-4'
                    ],
                    'label' => 'Modify'
                ]
            )*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

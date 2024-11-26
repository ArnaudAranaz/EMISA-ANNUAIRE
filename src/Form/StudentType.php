<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints as Assert;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('birthDay', null, [
                'widget' => 'single_text',
            ])
            ->add('promo')
            ->add('photo', FileType::class, [
                'label' => 'Photo de profil (JPG/PNG)',
                'mapped' => false, // Non lié directement à l'entité
                'required' => false,
                'constraints' => [
                    new Assert\File([
                    'maxSize' => '2M',
                    'mimeTypes' => [
                    'image/jpeg',
                    'image/png',
                    ],
                    'mimeTypesMessage' => 'Veuillez télécharger une image au format JPG ou PNG.',
                    ]),
                ]
            ])

            /*->add('course', EntityType::class, [
                'class' => Course::class,
                'choice_label' => 'title',
            ])*/
            ->add('company')
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Filiere;
use App\Entity\StudentBook;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class StudentBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('studentFullName', TextType::class, [
                'label' => false,
                'attr' =>[
                    'placeholder' => "Nom complet de l'Etudiant ou Professeur",
                    'class'=>'flex-1'
                ],
                'row_attr'=>['class'=>"form-group flex"]
            ])
            ->add('title', TextType::class, [
                'label' => false,
                'attr' =>[
                    'placeholder' => "Titre ou sujet du Livre",
                    'class'=>'flex-1'
                ],
                'row_attr'=>['class'=>"form-group flex"]
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'required'=>false,
                'attr' =>[
                    'placeholder' => "Petite description sur ce travail",
                    "class" => "flex-1",
                    'rows'=>10,
                ],
                "row_attr" => [
                    "class" => "form-group flex"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez les contenus de l\'article',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Les contenus de l\'article doit depasse {{ limit }} characteres',
                        'max' => 4096,
                    ]),
                ]
            ])
            ->add('pdfFile', FileType::class, [
                'label' => false,
                'required' => false,
                'row_attr'=>['class'=>'form-group flex'],
                'attr' =>[
                    'class'=>'flex-1'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '15M',
                        'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size }} {{ suffix }}). La taille maximale autorisée est de {{ limit }} {{ suffix }}',
                        'extensions' => [
                            'pdf'
                        ],
                        'mimeTypesMessage' => "Seul, les fichiers pdf sont permis",
                    ])],
            ])
            ->add('year', DateType::class, [
                'format' => 'dd/MM/yyyy',
                'label' => 'Année',
                'attr' =>[
                    'placeholder' => "Nom complet de l'Etudiant ou Professeur",
                    'class'=>'flex-1'
                ],
                'row_attr'=>['class'=>"form-group flex"]
            ])
            ->add('filiere', EntityType::class,[
                'class' => Filiere::class,
                'choice_label' => 'title',
                'label' => false,
                'by_reference' => false,
                'attr' =>[
                    "class" => "flex-1 choices_categories"
                ],
                "row_attr" => [
                "class" => "form-group flex"
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StudentBook::class,
        ]);
    }
}

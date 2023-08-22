<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr' =>[
                    'placeholder' => "Titre de l'article",
                    'class'=>'flex-1'
                ],
                'row_attr'=>['class'=>"form-group flex"]
            ])
            ->add('content', TextareaType::class, [
                'label' => false,
                'required'=>false,
                'attr' =>[
                    'placeholder' => "Contenu de l'article",
                    'rows'=>15,
                ]
            ])
            ->add('imageFile', FileType::class, [
                'label' => false,
                'row_attr'=>['class'=>'form-group flex'],
                'attr' =>[
                    'class'=>'flex-1'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'maxSizeMessage' => 'Le fichier est trop volumineux (1173.64 kB). La taille maximale autorisée est de 1024 kB',
                        'extensions' => [
                            'jpg',
                            'png'
                        ],
                        'mimeTypesMessage' => "Seul, les images sont permis",
                    ])],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

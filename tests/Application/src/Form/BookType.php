<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Book;
use App\Enum\BookCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, ['label' => 'app.ui.title', 'help' => 'app.ui.title_help'])
            ->add('authorName', null, ['label' => 'app.ui.author_name'])
            ->add('category', EnumType::class, [
                'label' => 'app.ui.category',
                'class' => BookCategory::class,
                'choice_label' => fn (BookCategory $choice) => ucfirst($choice->value),
                'required' => false,
                'placeholder' => 'app.ui.choose_category',
            ])
            ->add('summary', TextareaType::class, ['label' => 'app.ui.summary', 'required' => false])
            ->add('available', CheckboxType::class, ['label' => 'app.ui.available', 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Book::class]);
    }

    public function getBlockPrefix(): string
    {
        return 'sylius_resource';
    }
}

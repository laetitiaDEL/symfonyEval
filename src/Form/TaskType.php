<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr'=>['class'=> 'input'],
                'label'=> 'Saisir le titre de la tache : ',
                'label_attr'=> ['class'=>'label_input'],
                'required' => true,
            ])
            ->add('content', TextareaType::class, [
                'attr'=>['class'=> 'input'],
                'label'=> 'Saisir le contenu de la tache : ',
                'label_attr'=> ['class'=>'label_input'],
                'required' => true,
            ])
            ->add('expiryDate', DateType::class,[
                'html5' => true,
                'widget' => 'single_text',
                'attr' => ['class' => 'input_date'],
                'label' => "Saisir la date d'expiration de la tache : ",
                'required' => false,
            ])
            ->add('statut', ChoiceType::class, [
                'choices'  => [
                    'Yes' => true,
                    'No' => false,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}

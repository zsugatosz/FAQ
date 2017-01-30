<?php
/**
 * Created by PhpStorm.
 * User: Skolem
 * Date: 2017. 01. 23.
 * Time: 19:37
 */

namespace AppBundle\Form;

use AppBundle\Entity\Questions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shortQuestion', TextType::class, array(
                'label' => 'Kérdés ',
                'required'=>true,
                'attr' => array('class' => 'field-long'),))

            ->add('longQuestion', TextareaType::class, array(
                'label' => 'Bővebben',
                'required'=>false,
                'empty_data' => ' ',
                'attr' => array('class' => 'field-long field-textarea'),
            ))
            ->add('saveQuestion', SubmitType::class, array('label' => 'Mentés',
                'attr' => array('class' => 'form-style-1 button'),));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Questions::class,
        ]);

    }
}
<?php

namespace Monastyryov\PhoneBookApiBundle\Form\Type;

use Monastyryov\PhoneBookBundle\Request\RecordRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecordRequestType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', IntegerType::class)
            ->add('name', TextType::class)
            ->add('surname', TextType::class)
            ->add('patronymic', TextType::class)
            ->add('phone_number', TextType::class)
            ->add('street_id', IntegerType::class)
            ->add('birth_timestamp', IntegerType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecordRequest::class,
            'csrf_protection' => false
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'record_request';
    }
}
<?php

namespace AppBundle\Form;

use AppBundle\Entity\Agency;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AgencyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('catchword')
            ->add('description')
            ->add('phone')
            ->add('address')
            ->add('email')
            ->add('image', FileType::class, array(
                'data_class' => null,
                'label' => 'Agence Image (jpg)',
                'required'   => false,
            ))
            ->add('associates', CollectionType::class, array(
                'entry_type' => AssociateType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_options' => array('label' => false),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Agency::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_agency';
    }


}

<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssociateType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'firstName',
                null,
                array(
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add(
                'lastName',
                null,
                array(
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add(
                'phone',
                null,
                array(
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Associate'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_associate';
    }


}

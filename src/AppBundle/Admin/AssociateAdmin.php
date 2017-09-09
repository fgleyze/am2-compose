<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Agency;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class AssociateAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstName', 'text', array(
                'label' => 'Associate firstname',
            ))
            ->add('lastName', 'text', array(
                'label' => 'Associate lastname',
            ))
            ->add('phone', 'text', array(
                'label' => 'Associate phone number',
            ))
            ->add('agency', 'entity', array(
                 'class' => Agency::class,
             ))
       ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
       $datagridMapper
            ->add('firstName')
            ->add('lastName')
            ->add('phone')
            ->add('agency')
       ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('firstName')
            ->add('lastName')
            ->add('phone')
            ->add('agency')
       ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('firstName')
            ->add('lastName')
            ->add('phone')
            ->add('agency')
       ;
    }
}

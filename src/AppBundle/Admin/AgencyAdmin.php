<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class AgencyAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array(
                'label' => 'Agency name',
            ))
            ->add('catchword', 'text', array(
                'label' => 'Agency catchPhrase',
            ))
            ->add('description', 'textarea', array(
                'label' => 'Agency description',
                'attr' => array('rows' => '10'),
            ))
            ->add('file', 'file', array(
                'label' => 'Agency photo',
                'required' => false,
            ))
            ->add('address', 'text', array(
                'label' => 'Agency address',
            ))
            ->add('email', 'text', array(
                'label' => 'Agency email',
            ))
            ->add('phone', 'text', array(
                'label' => 'Agency phone number',
            ))
       ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
       $datagridMapper
            ->add('name')
            ->add('catchword')
            ->add('description')
            ->add('imageName')
            ->add('address')
            ->add('email')
            ->add('phone')
       ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('catchword')
            ->add('description')
            ->add('imageName')
            ->add('address')
            ->add('email')
            ->add('phone')
       ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('catchword')
            ->add('description')
            ->add('imageName')
            ->add('address')
            ->add('email')
            ->add('phone')
       ;
    }

    public function prePersist($image)
    {
        $this->manageFileUpload($image);
    }

    public function preUpdate($image)
    {
        $this->manageFileUpload($image);
    }

    private function manageFileUpload($image)
    {
        if ($image->getFile()) {
            $image->refreshUpdated();
        }
    }
}

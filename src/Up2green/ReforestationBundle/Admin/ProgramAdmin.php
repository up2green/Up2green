<?php

namespace Up2green\ReforestationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Program admin class
 */
class ProgramAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('organization')
            ->add('geoaddress')
            ->add('logo')
            ->add('maxTree')
            ->add('addedTrees')
            ->add('active')
            ->add('translations', 'a2lix_translations')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('organization')
            ->add('geoaddress')
            ->add('maxTree')
            ->add('addedTrees')
            ->add('active')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('organization')
            ->add('geoaddress')
            ->add('maxTree')
            ->add('addedTrees')
            ->add('active')
        ;
    }
}
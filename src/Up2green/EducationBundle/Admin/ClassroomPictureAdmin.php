<?php

namespace Up2green\EducationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Up2green\EducationBundle\Model\ClassroomPicture;

/**
 * Classroom picture admin class
 */
class ClassroomPictureAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $uploadedFileOptions = array(
            'label'    => 'form.classroom_picture_type.picture',
            'required' => false,
        );

        /** @var ClassroomPicture $subject */
        if (($subject = $this->getSubject()) && $subject->getPicture()) {
            $path                               = $subject->getPicture();
            $uploadedFileOptions['help_inline'] = '<img style="max-width:200px; max-height: 200px;" src="' . $path . '" />';
        }

        $formMapper
            ->add('student', null, array(
                'label' => 'form.classroom_picture_type.student'
            ))
            ->add('program', 'model', array(
                'class' => 'Up2green\ReforestationBundle\Model\Program',
                'label' => 'form.classroom_picture_type.program',
            ))
            ->add('classroom', 'model', array(
                'class' => 'Up2green\EducationBundle\Model\Classroom',
                'label' => 'form.classroom_picture_type.program'
            ))
            ->add('uploadedFile', 'file', $uploadedFileOptions);
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('student')
            ->add('program')
            // FIXME this field should have been guessed
            ->add('classroom.school', 'model', array(), null, array(
                'class' => 'Up2green\EducationBundle\Model\School',
            ))
            ->add('classroom')
            ->add('classroom.year');
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('student')
            ->add('program')
            ->add('classroom.school')
            ->add('classroom')
            ->add('classroom.year');
    }
}
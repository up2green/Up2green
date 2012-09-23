<?php

namespace Up2green\EducationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Up2green\EducationBundle\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Classroom controller
 */
class ClassroomController extends Controller
{
    /**
     * @Route("/school/{school_slug}/{classroom_slug}", name="education_classroom_show")
     * @Template()
     * @ParamConverter("school", class="Up2green\EducationBundle\Model\School", options={"mapping"={"school_slug":"slug"}})
     * @ParamConverter("classroom", class="Up2green\EducationBundle\Model\Classroom", options={"mapping"={"classroom_slug":"slug"}})
     *
     * @return array
     */
    public function showAction(Model\School $school, Model\Classroom $classroom)
    {
        if (null === $classroom) {
            throw new NotFoundHttpException();
        }

        return array('classroom' => $classroom);
    }

    /**
     * @Route("/wall", name="education_classroom_wall")
     * @Template()
     *
     * @return array
     */
    public function wallAction()
    {
        // Get the classroom
        $classroomPictures = Model\ClassroomPictureQuery::create()
            ->find()
        ;

        return array('classroomPictures' => $classroomPictures);
    }
}
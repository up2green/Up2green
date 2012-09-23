<?php

namespace Up2green\EducationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Up2green\EducationBundle\DomainObject;

class RegistrationController extends Controller
{
    /**
     * @Route("/registration/new", name="education.registration.new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        // Call to a sevice to know if the voucher isValid

        $userManipulator = $this->get('fos_user.util.user_manipulator');
        $form = $this->createForm('education_registration', new DomainObject\Registration($userManipulator));

        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            if (true === $form->isValid()) {
                $registration = $form->getData();
                $registration->save();

                // Todo Redirect to an other place
                return $this->redirect($this->generateUrl('education.registration.new'));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/registration/geoloc", name="education.registration.geoloc")
     */
    public function GeolocAction(Request $request)
    {
        $address = null;
        if (true === $request->query->has('address')) {
            $address = urldecode($request->query->get('address'));
        }
        $geocoded = $this->get('geocoder')->geocode($address);

        return new JsonResponse($geocoded->toArray());
    }
}
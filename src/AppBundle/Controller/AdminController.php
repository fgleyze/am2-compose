<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Agency;
use AppBundle\Entity\Associate;
use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectImage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/login", name="adminLogin")
     */
    public function loginAction(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('@AppBundle/Admin/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/", name="adminHomepage")
     */
    public function adminHomepageAction(Request $request)
    {
        return $this->forward('AppBundle:AdminAgency:edit', array(
            'id'  => $this->getDoctrine()->getManager()->getRepository(Agency::class)->findLastAgencyPersisted()->getId(),
        ));
    }
}

<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
	/**
	 * @Route("/{catchAll}", name="front", requirements={"catchAll": ".*"})
	 */
	public function frontAction()
	{
		return $this->render('@AppBundle/Front/index.html.twig');
	}
}

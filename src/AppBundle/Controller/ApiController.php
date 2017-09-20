<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Agency;
use AppBundle\Entity\Associate;
use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectImage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{
	/**
	 * @Route("/{id}", name="homepage", defaults={"id": 0}, requirements={"id": "\d+"})
	 * @Route("/agencies/{id}", name="agency", requirements={"id": "\d+"})
	 */
	public function agencyAction(Request $request)
	{
		if (0 == $request->attributes->get('id')) {
			$agency = $this->getDoctrine()->getManager()->getRepository(Agency::class)->findLastAgencyPersisted();
		} else {
			$agency = $this->getDoctrine()->getManager()->find(Agency::class, $request->attributes->get('id'));
		}

		$resource = [
			"id" => $agency->getId(),
			"title" => $agency->getCatchword(),
			"image" => "img/agency/marin1.jpg",
			"image2" => "img/agency/marin2.jpg",
			"description" => $agency->getDescription(),
		];

		$response = $this->crossDomainJsonResponse($resource);
		$response->setEncodingOptions(JSON_UNESCAPED_SLASHES);

		return $response;
	}

	/**
	 * @Route("/agencies/{id}/associates", name="associates", requirements={"id": "\d+"})
	 * @ParamConverter("agency", class="AppBundle:Agency")
	 */
	public function associatesAction(Agency $agency)
	{
		$associates = $this->getDoctrine()->getManager()->getRepository(Associate::class)->findByAgency($agency);

		$associatesView = array();

		foreach ($associates as $associate) {
			$associatesView[] = array(
				"firstName" => $associate->getFirstName(),
				"lastName" => $associate->getLastName(),
				"phone" => $associate->getPhone(),
			);
		};

		$resource = [
			"associates" => $associatesView,
			"address" => $agency->getAddress(),
			"email" => $agency->getEmail(),
			"phone" => $agency->getPhone(),
			"image" => $agency->getImageRelativePath(),
		];

		return $this->crossDomainJsonResponse($resource);
	}

	/**
	 * @Route("/agencies/{id}/projects", name="projects", requirements={"id": "\d+"})
	 * @ParamConverter("agency", class="AppBundle:Agency")
	 */
	public function projectsAction(Agency $agency)
	{
		$projects = $this->getDoctrine()->getManager()->getRepository(Project::class)->findByAgency($agency);

		$projectsView = array();

		$projectsMainImages = $this->getDoctrine()->getManager()->getRepository(ProjectImage::class)->findByAgencyAndPosition($agency, 0);

		foreach ($projects as $project) {
			$imagePath = $projectsMainImages[$project->getId()]->getRelativePath();

			$projectsView[] = array(
				"id" => $project->getId(),
				"title" => $project->getTitle(),
				"image" => $imagePath ? $imagePath : '',
			);
		};

		return $this->crossDomainJsonResponse($projectsView);
	}

	/**
	 * @Route("/projects/{id}", name="projectDetail", requirements={"id": "\d+"})
 	 * @ParamConverter("project", class="AppBundle:Project")
	 */
	public function projectDetailAction(Project $project)
	{
		$imagesView = array();

		foreach ($project->getImages() as $image) {
			$imagesView[] = array(
				"thumbsUrl" => $image->getRelativePath(),
				"imageUrl" => $image->getRelativePath(),
				"position" => $image->getPosition(),
			);
		};

		$projectView = array(
			"id" => $project->getId(),
			"title" => $project->getTitle(),
			"features" => $project->getFeatures(),
			"description" => $project->getDescription(),
			"images" => $imagesView,
		);

		return $this->crossDomainJsonResponse($projectView);
	}

	private function crossDomainJsonResponse($resource)
	{
		return new JsonResponse($resource, 200, array('Access-Control-Allow-Origin'=> '*'));
	}
}

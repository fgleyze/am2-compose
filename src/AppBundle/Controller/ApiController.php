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

/**
 * @Route("api")
 */
class ApiController extends Controller
{
	/**
	 * @Route("/agencies/{id}", name="agency", defaults={"id": 0}, requirements={"id": "\d+"})
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

		$response = new JsonResponse($resource);
		$response->setEncodingOptions(JSON_UNESCAPED_SLASHES);

		return $response;
	}

	/**
	 * @Route("/agencies/{id}/associates", name="associates", defaults={"id": 0}, requirements={"id": "\d+"})
	 */
	public function associatesAction(Request $request)
	{
		if (0 == $request->attributes->get('id')) {
			$agency = $this->getDoctrine()->getManager()->getRepository(Agency::class)->findLastAgencyPersisted();
		} else {
			$agency = $this->getDoctrine()->getManager()->find(Agency::class, $request->attributes->get('id'));
		}

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
			"facebook" => $agency->getFacebook(),
			"instagram" => $agency->getInstagram(),
			"pinterest" => $agency->getPinterest(),
			"phone" => $agency->getPhone(),
			"image" => $agency->getImageRelativePath(),
		];

		return new JsonResponse($resource);
	}

	/**
	 * @Route("/agencies/{id}/social", name="social", defaults={"id": 0}, requirements={"id": "\d+"})
	 */
	public function socialAction(Request $request)
	{
		if (0 == $request->attributes->get('id')) {
			$agency = $this->getDoctrine()->getManager()->getRepository(Agency::class)->findLastAgencyPersisted();
		} else {
			$agency = $this->getDoctrine()->getManager()->find(Agency::class, $request->attributes->get('id'));
		}

		$resource = array(
			"facebook" => $agency->getFacebook(),
			"instagram" => $agency->getInstagram(),
			"pinterest" => $agency->getPinterest(),
		);

		return new JsonResponse($resource);
	}

	/**
	 * @Route("/agencies/{id}/projects", name="projects", defaults={"id": 0}, requirements={"id": "\d+"})
	 */
	public function projectsAction(Request $request)
	{
		if (0 == $request->attributes->get('id')) {
			$agency = $this->getDoctrine()->getManager()->getRepository(Agency::class)->findLastAgencyPersisted();
		} else {
			$agency = $this->getDoctrine()->getManager()->find(Agency::class, $request->attributes->get('id'));
		}

		$projects = $this->getDoctrine()->getManager()->getRepository(Project::class)->findBy(
			array('agency' => $agency, 'published' => true),
			array('position' => 'DESC')
		);

		$projectsView = array();

		$projectsMainImages = $this->getDoctrine()->getManager()->getRepository(ProjectImage::class)->findByAgencyAndPosition($agency, 0);

		foreach ($projects as $project) {
			$imagePath = $projectsMainImages[$project->getId()]->getThumbRelativePath();

			$projectsView[] = array(
				"id" => $project->getId(),
				"title" => $project->getTitle(),
				"image" => $imagePath ? $imagePath : '',
			);
		};

		return new JsonResponse($projectsView);
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
				"imageUrl" => $image->getRelativePath(),
				"imageWidth" => $image->getWidth(),
				"imageHeight" => $image->getHeight(),
				"thumbUrl" => $image->getThumbRelativePath(),
				"thumbWidth" => $image->getThumbWidth(),
				"thumbHeight" => $image->getThumbHeight(),
				"position" => $image->getPosition(),
			);
		};

		$projectView = array(
			"id" => $project->getId(),
			"title" => $project->getTitle(),
			"features" => explode("\n", $project->getFeatures()),
			"description" => nl2br($project->getDescription()),
			"images" => $imagesView,
		);

		return new JsonResponse($projectView);
	}
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Agency;
use AppBundle\Entity\Associate;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
	/**
	 * @Route("/", name="homepage")
	 */
	public function indexAction(Request $request)
	{
		// replace this example code with whatever you need
		return $this->render('default/index.html.twig', [
			'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
		]);
	}

	/**
	 * @Route("/projects", name="projects")
	 */
	public function projectsAction(Request $request)
	{
		$resource = [
			[
				"title" => "BUREAUX : LA RUCHE QUI DIT OUI !, À PARIS",
				"id" => "1",
				"image" => "img/projets/perche/A.JPG",
			],
			[
				"title" => "BUREAUX : LA RUCHE QUI DIT NON !, À PARIS",
				"id" => "2",
				"image" => "img/projets/perche/B.JPG",
			],
			[
				"title" => "BUREAUX : LA RUCHE QUI DIT OK !, À PARIS",
				"id" => "3",
				"image" => "img/projets/perche/C.JPG",
			],
						[
				"title" => "BUREAUX : LA RUCHE QUI DIT OUI !, À PARIS",
				"id" => "1",
				"image" => "img/projets/perche/A.JPG",
			],
			[
				"title" => "BUREAUX : LA RUCHE QUI DIT NON !, À PARIS",
				"id" => "2",
				"image" => "img/projets/perche/B.JPG",
			],
			[
				"title" => "BUREAUX : LA RUCHE QUI DIT OK !, À PARIS",
				"id" => "3",
				"image" => "img/projets/perche/C.JPG",
			],
		];

		return $this->crossDomainJsonResponse($resource);
	}

	/**
	 * @Route("/projects/{id}", name="projectDetail")
	 */
	public function projectDetailAction(Request $request, $id)
	{
		$resource = [
				"id" => $id,
				"title" => "BUREAUX : LA RUCHE QUI DIT OUI !, À PARIS",
				"mainImage" => "img/projets/la-ruche-qui-dit-oui-bureaux/A.jpg",
				"images" => [
					[
						"url" => "img/projets/la-ruche-qui-dit-oui-bureaux/B.jpg",
						"thumbsUrl" => "img/projets/la-ruche-qui-dit-oui-bureaux/thumbs/B.jpg",
						"width" => "500px",
						"height" => "375px",
						"thumbsWidth" => 500,
						"thumbsHeight" => 322,
					],
					[
						"url" => "img/projets/la-ruche-qui-dit-oui-bureaux/C.jpg",
						"thumbsUrl" => "img/projets/la-ruche-qui-dit-oui-bureaux/thumbs/C.jpg",
						"width" => "px",
						"height" => "px",
						"thumbsWidth" => 500,
						"thumbsHeight" => 342,
					],
					[
						"url" => "img/projets/la-ruche-qui-dit-oui-bureaux/D.jpg",
						"thumbsUrl" => "img/projets/la-ruche-qui-dit-oui-bureaux/thumbs/D.jpg",
						"width" => "px",
						"height" => "px",
						"thumbsWidth" => 500,
						"thumbsHeight" => 234,
					],
					[
						"url" => "img/projets/la-ruche-qui-dit-oui-bureaux/E.jpg",
						"thumbsUrl" => "img/projets/la-ruche-qui-dit-oui-bureaux/thumbs/E.jpg",
                        "width" => "px",
                        "height" => "px",
                        "thumbsWidth" => 500,
						"thumbsHeight" => 377,
					],
					[
						"url" => "img/projets/la-ruche-qui-dit-oui-bureaux/F.jpg",
						"thumbsUrl" => "img/projets/la-ruche-qui-dit-oui-bureaux/thumbs/F.jpg",
                        "width" => "px",
                        "height" => "px",
                        "thumbsWidth" => 500,
						"thumbsHeight" => 333,
					],
					[
						"url" => "img/projets/la-ruche-qui-dit-oui-bureaux/G.jpg",
						"thumbsUrl" => "img/projets/la-ruche-qui-dit-oui-bureaux/thumbs/G.jpg",
                        "width" => "px",
                        "height" => "px",
                        "thumbsWidth" => 500,
						"thumbsHeight" => 259,
					]
				],
				"features" =>
				"
					<li>
						<b>Client :</b> La Ruche Qui Dit Oui
					</li>
					<li>
						<b>Budget :</b> 119 000€
					</li>
					<li>
						<b>Superficie :</b> 110 m2
					</li>
					<li>
						<b>Lieu :</b> Bastille, Paris
					</li>
					<li>
						<b>Mission :</b> Complète (de la conception à réalisation)
					</li>
					<li>
						<b>Calendrier :</b> En chantier, livré en 2017
					</li>
					<li>
						<b>Programme :</b> Salles de réunions, Brainstorming et Salle de détente
					</li>
					<li>
						<b>Partenariat avec BäN Architecture</b>
					</li>
				",
				"description" => "La Ruche Qui Dit Oui fait appel à nous pour traduire leur philosophie et principes dans l’architecture de leurs nouveaux bureaux à Bastille. <br/><br/>Ils souhaitent donner une nouvelle image aux clients et aux investisseurs : une start-up solide qui s’installe sereinement dans le marché ; une boite moderne, qui évolue et qui est prête à se développer au-delà des frontières. Les locaux qui leur tient le plus au cœur nous sont confiés : des salles de réunion pour différents types de publics, un brainstorming cosi d’où sortiront toutes les nouvelles idées de l’entreprise et une salle de détente et de réunions internes qui coupe du quotidien. "
			];

		return $this->crossDomainJsonResponse($resource);
	}

	/**
	 * @Route("/agency/{id}", name="agency")
	 * @ParamConverter("agency", class="AppBundle:Agency")
	 */
	public function agencyAction(Agency $agency)
	{
		$resource = [
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
	 * @Route("/agency/{id}/contact", name="contact")
	 * @ParamConverter("agency", class="AppBundle:Agency")
	 */
	public function contactAction(Agency $agency)
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
			"image" => $agency->getImagePath(),
		];

		return $this->crossDomainJsonResponse($resource);
	}

	private function crossDomainJsonResponse($resource)
	{
		return new JsonResponse($resource, 200, array('Access-Control-Allow-Origin'=> '*'));
	}
}

<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
	 * @Route("/agency", name="agency")
	 */
	public function agencyAction(Request $request)
	{
		$resource = [
			"title" => "Une architecture <br/> pour tous",
			"image1" => "img/agency/marin1.jpg",
			"image2" => "img/agency/marin2.jpg",
			"description" => "AM2 Architecture est la collaboration de deux soeurs d'origine colombienne et diplômées Architectes HMONP ( = DPLG) en 2010. Pour enrichir leurs compétences, l’une, Martha Marin, a fait des études d'architecte d'intérieur, et l’autre, Angela Marin, d’urbanisme. Après plusieurs années de collaboration dans différentes agences d'architecture comme TOA Architectes ou Groupe 6, à Paris, Avignon, Marrakech et Bogota entre autre, elles décident en 2015 de s’associer pour créer leur propre structure. Grâce à leur bagage multiculturel et leurs formations, elles offrent, tout en étant moderne, une architecture sensible et fonctionnelle. <br/> <br/> L'ambition d’AM2 est d'enrichir les espaces en rendant leur usages plus adéquats et agréables aux habitants. \"La richesse d'un espace est à la base de notre qualité de vie\". Leur inspiration commence par le détail : une touche de couleur, un rayon de soleil, un objet réinventé ou un espace multifonctionnel qui contribuent à améliorer le quotidien. <br/> <br/> AM2 utilise sa sensibilité et sa créativité pour concevoir des espaces qualitatifs, comfortables et durables, et créer leur identité. Douce et pure mais à la fois contrastée et dynamique elle interpelle, elle surprend, elle émerveille. <br/> <br/> L'architecture d'AM2 naît du dialogue avec le client, du programme et de l'espace. Chaque client et chaque lieu sont uniques et tout \"objet\" peut être une petite architecture. L'objectif de l'agence est de donner les moyens aux usagers pour qu'ils puissent s'approprier de l'espace en y créant leur propre histoire. <br/> <br/> AM2 produit une architecture pour tous et vise à offrir beaucoup en usant peu."
		];

		return $this->crossDomainJsonResponse($resource);
	}

	/**
	 * @Route("/contact", name="contact")
	 */
	public function contactAction(Request $request)
	{
		$resource = [
			"associates" => [
				[
					"name" => "Angela GLEYZE MARIN",
					"phone" => "07 83 93 11 91",
				],
				[
					"name" => "Martha BAILLY MARIN",
					"phone" => "06 50 88 56 00",
				]
			],
			"address" => "103 rue du Chemin Vert, 75011 Paris",
			"email" => "contact@am2-architecture.com",
			"image" => "img/contact/bogota.jpg",
		];

		return $this->crossDomainJsonResponse($resource);
	}

	private function crossDomainJsonResponse($resource)
	{
		return new JsonResponse($resource, 200, array('Access-Control-Allow-Origin'=> '*'));
	}
}

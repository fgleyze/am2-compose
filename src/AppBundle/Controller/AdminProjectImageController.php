<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProjectImage;
use AppBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("admin/project_images")
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminProjectImageController extends Controller
{
    /**
     * Lists all projectImage entities.
     *
     * @Route("/", name="project_images_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projectImages = $em->getRepository('AppBundle:ProjectImage')->findAll();

        return $this->render('@AppBundle/Admin/projectimage/index.html.twig', array(
            'projectImages' => $projectImages,
        ));
    }

    /**
     * Creates a new projectImage entity.
     *
     * @Route("/new", name="project_images_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fileUploader = $this->get('file_uploader');

        $projectImage = new Projectimage();
        $form = $this->createForm('AppBundle\Form\ProjectImageType', $projectImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $projectImage->getImageName();
            $fileName = $fileUploader->upload($file);

            $projectImage->setImageName($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($projectImage);
            $em->flush();

            return $this->redirectToRoute('project_images_show', array('id' => $projectImage->getId()));
        }

        return $this->render('@AppBundle/Admin/projectimage/new.html.twig', array(
            'projectImage' => $projectImage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projectImage entity.
     *
     * @Route("/{id}", name="project_images_show")
     * @Method("GET")
     */
    public function showAction(ProjectImage $projectImage)
    {
        $deleteForm = $this->createDeleteForm($projectImage);

        return $this->render('@AppBundle/Admin/projectimage/show.html.twig', array(
            'projectImage' => $projectImage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectImage entity.
     *
     * @Route("/{id}/edit", name="project_images_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectImage $projectImage)
    {
        $fileUploader = $this->get('file_uploader');

        $deleteForm = $this->createDeleteForm($projectImage);
        $editForm = $this->createForm('AppBundle\Form\ProjectImageType', $projectImage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $projectImage->getImageName();
            $fileName = $fileUploader->upload($file);

            $projectImage->setImageName($fileName);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('project_images_edit', array('id' => $projectImage->getId()));
        }

        return $this->render('@AppBundle/Admin/projectimage/edit.html.twig', array(
            'projectImage' => $projectImage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
}

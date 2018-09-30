<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Agency;
use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectImage;
use AppBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("admin/projects")
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminProjectController extends Controller
{
    /**
     * Lists all project entities.
     *
     * @Route("/", name="projects_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('AppBundle:Project')->findBy(array(), array('position' => 'DESC'));

        return $this->render('@AppBundle/Admin/project/index.html.twig', array(
            'projects' => $projects,
        ));
    }

    /**
     * Creates a new project entity.
     *
     * @Route("/new", name="projects_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm('AppBundle\Form\ProjectType', $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $agency = $em->getRepository('AppBundle:Agency')->findOneById(1);
            $project->setAgency($agency);

            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('projects_index');
        }

        return $this->render('@AppBundle/Admin/project/new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a project entity.
     *
     * @Route("/{id}", name="projects_show")
     * @Method("GET")
     */
    public function showAction(Project $project)
    {
        $deleteForm = $this->createDeleteForm($project);

        return $this->render('@AppBundle/Admin/project/show.html.twig', array(
            'project' => $project,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing project entity.
     *
     * @Route("/{id}/edit", name="projects_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Project $project)
    {
        $fileUploader = $this->get('file_uploader');

        $deleteForm = $this->createDeleteForm($project);
        $editForm = $this->createForm('AppBundle\Form\ProjectType', $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            foreach ($project->getProjectImages() as $projectImage) {
                $projectImage->setProject($project);

                if ($projectImage->getImage()) {
                    $file = $projectImage->getImage();
                    $fileName = $fileUploader->upload($file);
                    $projectImage->setImageName($fileName);

                    $projectImage->setGeometry(
                        $fileUploader->getGeometry($projectImage->getRelativePath()),
                        $fileUploader->getGeometry($projectImage->getThumbRelativePath())
                    );
                }

                if (!$projectImage->getImageName()) {
                    $projectImage->setImageName('empty');
                }
            }

            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('@AppBundle/Admin/project/edit.html.twig', array(
            'project' => $project,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a project entity.
     *
     * @Route("/{id}", name="projects_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Project $project)
    {
        $form = $this->createDeleteForm($project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('projects_index');
    }

    private function createDeleteForm(Project $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projects_delete', array('id' => $project->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/delete_image/{id}", name="delete_project_image")
     * @Method("GET")
     */
    public function deleteProjectImageAction(Request $request, ProjectImage $projectImage)
    {
        $thumbPath = $projectImage->getThumbRelativePath();
        $path = $projectImage->getRelativePath();

        $em = $this->getDoctrine()->getManager();
        $em->remove($projectImage);
        $em->flush();

        unlink($thumbPath);
        unlink($path);

        return $this->redirectToRoute('projects_edit', array('id' => $projectImage->getProject()->getId()));
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Agency;
use AppBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("admin/agencies")
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminAgencyController extends Controller
{
    /**
     * Lists all agency entities.
     *
     * @Route("/", name="agencies_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $agencies = $em->getRepository('AppBundle:Agency')->findAll();

        return $this->render('@AppBundle/Admin/agency/index.html.twig', array(
            'agencies' => $agencies,
        ));
    }

    /**
     * Creates a new agency entity.
     *
     * @Route("/new", name="agencies_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $agency = new Agency();
        $form = $this->createForm('AppBundle\Form\AgencyType', $agency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agency);
            $em->flush();

            return $this->redirectToRoute('agencies_show', array('id' => $agency->getId()));
        }

        return $this->render('@AppBundle/Admin/agency/new.html.twig', array(
            'agency' => $agency,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a agency entity.
     *
     * @Route("/{id}", name="agencies_show")
     * @Method("GET")
     */
    public function showAction(Agency $agency)
    {
        $deleteForm = $this->createDeleteForm($agency);

        return $this->render('@AppBundle/Admin/agency/show.html.twig', array(
            'agency' => $agency,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing agency entity.
     *
     * @Route("/{id}/edit", name="agencies_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Agency $agency)
    {
        $fileUploader = $this->get('file_uploader');

        $deleteForm = $this->createDeleteForm($agency);
        $editForm = $this->createForm('AppBundle\Form\AgencyType', $agency);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if($file = $agency->getImage()) {
                $fileName = $fileUploader->upload($file);
                $agency->setImageName($fileName);
            };

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agencies_edit', array('id' => $agency->getId()));
        }

        return $this->render('@AppBundle/Admin/agency/edit.html.twig', array(
            'agency' => $agency,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a agency entity.
     *
     * @Route("/{id}", name="agencies_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Agency $agency)
    {
        $form = $this->createDeleteForm($agency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agency);
            $em->flush();
        }

        return $this->redirectToRoute('agencies_index');
    }

    /**
     * Creates a form to delete a agency entity.
     *
     * @param Agency $agency The agency entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Agency $agency)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agencies_delete', array('id' => $agency->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

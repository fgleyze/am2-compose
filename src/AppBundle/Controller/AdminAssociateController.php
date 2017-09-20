<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Associate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("admin/associates")
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminAssociateController extends Controller
{
    /**
     * Lists all associate entities.
     *
     * @Route("/", name="associates_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $associates = $em->getRepository('AppBundle:Associate')->findAll();

        return $this->render('@AppBundle/Admin/associate/index.html.twig', array(
            'associates' => $associates,
        ));
    }

    /**
     * Creates a new associate entity.
     *
     * @Route("/new", name="associates_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $associate = new Associate();
        $form = $this->createForm('AppBundle\Form\AssociateType', $associate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($associate);
            $em->flush();

            return $this->redirectToRoute('associates_show', array('id' => $associate->getId()));
        }

        return $this->render('@AppBundle/Admin/associate/new.html.twig', array(
            'associate' => $associate,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a associate entity.
     *
     * @Route("/{id}", name="associates_show")
     * @Method("GET")
     */
    public function showAction(Associate $associate)
    {
        $deleteForm = $this->createDeleteForm($associate);

        return $this->render('@AppBundle/Admin/associate/show.html.twig', array(
            'associate' => $associate,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing associate entity.
     *
     * @Route("/{id}/edit", name="associates_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Associate $associate)
    {
        $deleteForm = $this->createDeleteForm($associate);
        $editForm = $this->createForm('AppBundle\Form\AssociateType', $associate);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('associates_edit', array('id' => $associate->getId()));
        }

        return $this->render('@AppBundle/Admin/associate/edit.html.twig', array(
            'associate' => $associate,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a associate entity.
     *
     * @Route("/{id}", name="associates_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Associate $associate)
    {
        $form = $this->createDeleteForm($associate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($associate);
            $em->flush();
        }

        return $this->redirectToRoute('associates_index');
    }

    /**
     * Creates a form to delete a associate entity.
     *
     * @param Associate $associate The associate entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Associate $associate)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('associates_delete', array('id' => $associate->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

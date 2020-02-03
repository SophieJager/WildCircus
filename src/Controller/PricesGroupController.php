<?php

namespace App\Controller;

use App\Entity\PricesGroup;
use App\Form\PricesGroupType;
use App\Repository\PricesGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/pricesgroup")
 */
class PricesGroupController extends AbstractController
{
    /**
     * @Route("/", name="prices_group_index", methods={"GET"})
     * @param PricesGroupRepository $pricesGroupRepository
     * @return Response
     */
    public function index(PricesGroupRepository $pricesGroupRepository): Response
    {
        return $this->render('admin/prices_group/index.html.twig', [
            'prices_groups' => $pricesGroupRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="prices_group_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pricesGroup = new PricesGroup();
        $form = $this->createForm(PricesGroupType::class, $pricesGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pricesGroup);
            $entityManager->flush();

            return $this->redirectToRoute('prices_group_index');
        }

        return $this->render('admin/prices_group/new.html.twig', [
            'prices_group' => $pricesGroup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prices_group_show", methods={"GET"})
     */
    public function show(PricesGroup $pricesGroup): Response
    {
        return $this->render('admin/prices_group/show.html.twig', [
            'prices_group' => $pricesGroup,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prices_group_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PricesGroup $pricesGroup): Response
    {
        $form = $this->createForm(PricesGroupType::class, $pricesGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prices_group_index');
        }

        return $this->render('admin/prices_group/edit.html.twig', [
            'prices_group' => $pricesGroup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prices_group_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PricesGroup $pricesGroup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pricesGroup->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pricesGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prices_group_index');
    }
}

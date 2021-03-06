<?php

namespace App\Controller;

use App\Entity\Prices;
use App\Form\PricesType;
use App\Repository\PricesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/prices")
 */
class PricesController extends AbstractController
{
    /**
     * @Route("/", name="prices_index", methods={"GET"})
     * @param PricesRepository $pricesRepository
     * @return Response
     */
    public function index(PricesRepository $pricesRepository): Response
    {
        return $this->render('admin/prices/index.html.twig', [
            'prices' => $pricesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="prices_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $price = new Prices();
        $form = $this->createForm(PricesType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($price);
            $entityManager->flush();

            return $this->redirectToRoute('prices_index');
        }

        return $this->render('admin/prices/new.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prices_show", methods={"GET"})
     * @param Prices $price
     * @return Response
     */
    public function show(Prices $price): Response
    {
        return $this->render('admin/prices/show.html.twig', [
            'price' => $price,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prices_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Prices $price
     * @return Response
     */
    public function edit(Request $request, Prices $price): Response
    {
        $form = $this->createForm(PricesType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prices_index');
        }

        return $this->render('admin/prices/edit.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prices_delete", methods={"DELETE"})
     * @param Request $request
     * @param Prices $price
     * @return Response
     */
    public function delete(Request $request, Prices $price): Response
    {
        if ($this->isCsrfTokenValid('delete'.$price->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($price);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prices_index');
    }
}

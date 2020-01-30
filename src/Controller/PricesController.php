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
 * @Route("/prices")
 */
class PricesController extends AbstractController
{
    /**
     * @Route("/", name="prices_index", methods={"GET"})
     */
    public function index(PricesRepository $pricesRepository): Response
    {
        return $this->render('prices/index.html.twig', [
            'prices' => $pricesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="prices_new", methods={"GET","POST"})
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

        return $this->render('prices/new.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prices_show", methods={"GET"})
     */
    public function show(Prices $price): Response
    {
        return $this->render('prices/show.html.twig', [
            'price' => $price,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prices_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Prices $price): Response
    {
        $form = $this->createForm(PricesType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prices_index');
        }

        return $this->render('prices/edit.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prices_delete", methods={"DELETE"})
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

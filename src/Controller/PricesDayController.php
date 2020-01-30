<?php

namespace App\Controller;

use App\Entity\PricesDay;
use App\Form\PricesDayType;
use App\Repository\PricesDayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prices/day")
 */
class PricesDayController extends AbstractController
{
    /**
     * @Route("/", name="prices_day_index", methods={"GET"})
     */
    public function index(PricesDayRepository $pricesDayRepository): Response
    {
        return $this->render('prices_day/index.html.twig', [
            'prices_days' => $pricesDayRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="prices_day_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pricesDay = new PricesDay();
        $form = $this->createForm(PricesDayType::class, $pricesDay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pricesDay);
            $entityManager->flush();

            return $this->redirectToRoute('prices_day_index');
        }

        return $this->render('prices_day/new.html.twig', [
            'prices_day' => $pricesDay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prices_day_show", methods={"GET"})
     */
    public function show(PricesDay $pricesDay): Response
    {
        return $this->render('prices_day/show.html.twig', [
            'prices_day' => $pricesDay,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prices_day_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PricesDay $pricesDay): Response
    {
        $form = $this->createForm(PricesDayType::class, $pricesDay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prices_day_index');
        }

        return $this->render('prices_day/edit.html.twig', [
            'prices_day' => $pricesDay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prices_day_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PricesDay $pricesDay): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pricesDay->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pricesDay);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prices_day_index');
    }
}

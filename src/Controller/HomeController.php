<?php

namespace App\Controller;

use App\Repository\AboutUsRepository;
use App\Repository\PerformancesRepository;
use App\Repository\PricesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param AboutUsRepository $aboutRepo
     * @param PerformancesRepository $perfRepo
     * @param PricesRepository $pricesRepo
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AboutUsRepository $aboutRepo, PerformancesRepository $perfRepo, PricesRepository $pricesRepo)
    {
        return $this->render('home/index.html.twig', [
            'performances' => $perfRepo->findBy(['active'=>1]),
            'aboutus' => $aboutRepo->findBy(['active'=>1]),
            'prices' => $pricesRepo->findAll()
        ]);
    }
}

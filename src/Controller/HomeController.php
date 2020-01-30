<?php

namespace App\Controller;

use App\Form\PricesGroupType;
use App\Repository\AboutUsRepository;
use App\Repository\PerformancesRepository;
use App\Repository\PricesGroupRepository;
use App\Repository\PricesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param AboutUsRepository $aboutRepo
     * @param PerformancesRepository $perfRepo
     * @param PricesRepository $pricesRepo
     * @param PricesGroupRepository $groupRepo
     * @return Response
     */
    public function index(
        AboutUsRepository $aboutRepo,
        PerformancesRepository $perfRepo,
        PricesRepository $pricesRepo,
        PricesGroupRepository $groupRepo
    ) {
        return $this->render('home/index.html.twig', [
            'performances' => $perfRepo->findBy(['active'=>1]),
            'aboutus' => $aboutRepo->findOneBy(['active'=>1]),
            'groups' => $groupRepo -> findBy(['active'=>1]),
            'prices' => $pricesRepo->findAll(),
            'tests'=>$pricesRepo->joinPrices(),
        ]);
    }
}

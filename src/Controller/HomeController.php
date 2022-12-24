<?php

namespace App\Controller;
use App\Entity\Bien;
use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    protected $BienRepository;

    public function __construct(BienRepository $BienRepository)
    {
       $this->BienRepository=$BienRepository;
    }
    public function index(): Response
    {
        
        $safers = $this->getDoctrine()->getRepository(Bien::class)->findAll();
        // var_dump($safers);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'HomeController',"safers" => $safers,
            "find5Biens"=>$this->BienRepository->find5Biens(),
        ]);
    }
}

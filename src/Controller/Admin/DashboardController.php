<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use App\Entity\Categorie;
use App\Entity\Favoris;
use App\Repository\BienRepository;
use App\Repository\CategorieRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
      protected   $bienRepository;
      protected  $categorieRepository;
    public function __construct(BienRepository $bienRepository,CategorieRepository $categorieRepository){
        $this-> bienRepository=$bienRepository;
        $this->categorieRepository=$categorieRepository;
    }
    /**
     * @Route("/admin", name="admin")
     */
   
    
    public function index(): Response
    {
        // return parent::index();
        return $this->render('Bundles/EasyAdminBundle/welcome.html.twig',
    [
        'countAllBien'=>$this->bienRepository->countAllBien(),
        'countAllCategorie'=>$this->categorieRepository->countAllCategorie(),
    ]);

        
    }
    

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ProjetSafers');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Biens', 'fas fa-list', Bien::class);
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud('Favoris', 'fas fa-list', Favoris::class);
    }
}

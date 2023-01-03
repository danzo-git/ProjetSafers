<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use App\Entity\Categorie;
use App\Entity\Favoris;
use App\Entity\Contact;
use App\Repository\BienRepository;
use App\Repository\CategorieRepository;
use App\Repository\FavorisRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{protected   $favorisRepository;
      protected   $bienRepository;
      protected  $categorieRepository;
    public function __construct(FavorisRepository  $favorisRepository,BienRepository $bienRepository,CategorieRepository $categorieRepository){
        $this-> bienRepository=$bienRepository;
        $this->categorieRepository=$categorieRepository;
        $this->favorisRepository=$favorisRepository;
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
        'findMostFrequentValue'=>$this->favorisRepository->findMostFrequentValue(),
        'findMostFrequentbien'=>$this->favorisRepository->findMostFrequentBien()
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
        yield MenuItem::linkToCrud('Contact', 'fas fa-list', Contact::class);
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
        
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
    }
}

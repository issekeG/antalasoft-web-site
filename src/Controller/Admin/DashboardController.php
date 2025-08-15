<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Realisation;
use App\Entity\RealisationCategory;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[AdminDashboard(routePath: '/reserver-admin', routeName: 'admin')]
#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
         return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Antalasoft');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        // Articles → icône de journal
        yield MenuItem::linkToCrud('Les articles', 'fa fa-newspaper', Article::class);

        // Réalisations → icône de trophée
        yield MenuItem::linkToCrud('Les Réalisations', 'fa fa-trophy', Realisation::class);

        // Services → icône d’engrenage
        yield MenuItem::linkToCrud('Les Services', 'fa fa-cogs', RealisationCategory::class);
    }

}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/nos-realisations', name: 'app_realisations')]
    public function realisations(): Response
    {
        return $this->render('realisations/realisations.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/realisations-details', name: 'app_realisation_details')]
    public function realisation_details(): Response
    {
        return $this->render('realisations/realisation-details.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/nos-formations', name: 'app_formations')]
    public function formations(): Response
    {
        return $this->render('formations/formations.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/nos-services', name: 'app_services')]
    public function services(): Response
    {
        return $this->render('services/services.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/nos-articles', name: 'app_blogs')]
    public function blogs(): Response
    {
        return $this->render('blogs/blogs.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/article-details', name: 'app_blog_details')]
    public function article_details(): Response
    {
        return $this->render('blogs/blog-details.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


}

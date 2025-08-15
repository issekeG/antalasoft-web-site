<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ArticleRepository;
use App\Repository\RealisationCategoryRepository;
use App\Repository\RealisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $entityManager,ArticleRepository $articleRepository, RealisationCategoryRepository $realisationService, RealisationRepository $realisationRepository): Response
    {
        $realisations = $realisationRepository->findAll();

        return $this->render('home/index.html.twig', [
            'realisations' => $realisations,
            'realisationServices' => $realisationService->findAll(),
            'articles' => $articleRepository->findBy([]),
        ]);
    }

    #[Route('/nos-realisations', name: 'app_realisations')]
    public function realisations(RealisationRepository $realisationRepository, RealisationCategoryRepository $realisationService): Response
    {
        return $this->render('realisations/realisations.html.twig', [
            'realisations' => $realisationRepository->findBy([]),
            'realisationServices' => $realisationService->findAll(),

        ]);
    }

    #[Route('/realisations-details/{slug}', name: 'app_realisation_details')]
    public function realisation_details(string $slug, RealisationRepository $realisationRepository): Response
    {
        return $this->render('realisations/realisation-details.html.twig', [
            'realisation' => $realisationRepository->findOneBy(['slug' => $slug]),
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
    public function blogs(Request $request,  ArticleRepository $articleRepository): Response
    {
        return $this->render('blogs/blogs.html.twig', [
            'articles' => $articleRepository->findBy([]),
        ]);
    }

    #[Route('/article-details/{slug}', name: 'app_blog_details')]
    public function article_details(string $slug, ArticleRepository $articleRepository): Response
    {
        return $this->render('blogs/blog-details.html.twig', [
            'article' => $articleRepository->findOneBy(['slug' => $slug]),
        ]);
    }

    #[Route('/nous-contact', name: 'app_contact')]
    public function contact(): Response{
        return $this->render('contact/contact.html.twig', []);
    }


}

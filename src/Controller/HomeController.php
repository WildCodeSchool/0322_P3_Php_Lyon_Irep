<?php

namespace App\Controller;

use App\Repository\PresentationRepository;
use App\Repository\NewsletterRepository;
use App\Service\StatisticService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Newsletter;
use App\Form\NewsletterType;

class HomeController extends AbstractController
{
    private StatisticService $statisticService;

    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        NewsletterRepository $newsletterRepository,
        PresentationRepository $presentRepository
    ): Response {
        $presentations = $presentRepository->showPresentationByDate();
        $this->statisticService->recordPageVisit('app_home');

        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsletterRepository->save($newsletter, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/index.html.twig', [
            'newsletter' => $newsletter,
            'form' => $form,
            'presentations' => $presentations
        ]);
    }
}

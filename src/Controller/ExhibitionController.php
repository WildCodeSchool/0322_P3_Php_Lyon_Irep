<?php

namespace App\Controller;

use App\Entity\Exhibition;
use App\Entity\Presentation;
use App\Form\ExhibitionType;
use App\Repository\ExhibitionRepository;
use App\Repository\PresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use DateTime;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/exhibition')]
class ExhibitionController extends AbstractController
{
    #[Route('/new', name: 'app_exhibition_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ExhibitionRepository $exhibitionRepository): Response
    {
        $exhibition = new Exhibition();
        $exhibition->setStart(new DateTime());
        $exhibition->setEnd(new DateTime());

        $form = $this->createForm(ExhibitionType::class, $exhibition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exhibitionRepository->save($exhibition, true);

            return $this->redirectToRoute('app_exhibition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/exhibition/new.html.twig', [
            'exhibition' => $exhibition,
            'form' => $form,
        ]);
    }

    #[Route('/', name: 'app_exhibition_index', methods: ['GET'])]
    public function index(ExhibitionRepository $exhibitionRepository): Response
    {
        return $this->render('/admin/exhibition/index.html.twig', [
            'exhibitions' => $exhibitionRepository->findAll(),
        ]);
    }

    #[Route('/{id}', methods: ['GET'], name: 'exhibition_show_presentation')]
    public function showPresentation(
        int $id,
        ExhibitionRepository $exhibitionRepository,
        PresentationRepository $presentRepository
    ): Response {
        $exhibition = $exhibitionRepository->findOneBy(['id' => $id]);

        $presentations = $presentRepository->findBy(
            ['exhibition' => $exhibition],
        );

        return $this->render('admin/presentation/index.html.twig', [
            'exhibition' => $exhibition,
            'presentations' => $presentations,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_exhibition_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Exhibition $exhibition, ExhibitionRepository $exhibitionRepository): Response
    {
        $form = $this->createForm(ExhibitionType::class, $exhibition);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exhibitionRepository->save($exhibition, true);

            return $this->redirectToRoute('app_exhibition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/exhibition/edit.html.twig', [
            'exhibition' => $exhibition,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_exhibition_delete', methods: ['POST'])]
    public function delete(Request $request, Exhibition $exhibition, ExhibitionRepository $exhiRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $exhibition->getId(), $request->request->get('_token'))) {
            $exhiRepository->remove($exhibition, true);
        }

        return $this->redirectToRoute('app_exhibition_index', [], Response::HTTP_SEE_OTHER);
    }
}

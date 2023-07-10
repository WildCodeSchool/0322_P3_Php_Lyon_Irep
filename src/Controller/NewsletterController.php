<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Entity\Exhibition;
use App\Form\NewsletterType;
use App\Repository\ExhibitionRepository;
use App\Repository\NewsletterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

#[IsGranted('ROLE_ADMIN')]
#[Route('admin/newsletter')]
class NewsletterController extends AbstractController
{
    #[Route('/', name: 'app_newsletter_index', methods: ['GET'])]
    public function index(ExhibitionRepository $exhibitionRepository): Response
    {
        $exhibitions = $exhibitionRepository->findAll();

        return $this->render('admin/newsletter/index.html.twig', [
            'exhibitions' => $exhibitions

        ]);
    }

    #[Route('/{id}/edit', name: 'app_newsletter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Newsletter $newsletter, NewsletterRepository $newsletterRepository): Response
    {
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsletterRepository->save($newsletter, true);

            return $this->redirectToRoute('app_newsletter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/newsletter/edit.html.twig', [
            'newsletter' => $newsletter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_newsletter_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Newsletter $newsletter,
        NewsletterRepository $newsletterRepository
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $newsletter->getId(), $request->request->get('_token'))) {
            $newsletterRepository->remove($newsletter, true);
        }

        return $this->redirectToRoute('app_newsletter_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/export-csv', name: 'app_newsletter_export_csv', methods: ['GET'])]
    public function exportCsv(
        Exhibition $exhibition,
        EncoderInterface $csvEncoder,
        NewsletterRepository $newsletterRepository
    ): Response {
         $newsletters = $newsletterRepository->findBy(
             ['exhibition' => $exhibition],
         );

        $emailsCsv = $csvEncoder->encode($newsletters, 'csv');

        $fileContent = $emailsCsv;
        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'mails.csv'
        );

        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}

<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Entity\Exhibition;
use App\Form\NewsletterType;
use App\Repository\NewsletterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/newsletter')]
class NewsletterController extends AbstractController
{
    #[Route('/', name: 'app_newsletter_index', methods: ['GET'])]
    public function index(NewsletterRepository $newsletterRepository): Response
    {
        return $this->render('admin/newsletter/index.html.twig', [
            'newsletters' => $newsletterRepository->findAll(),
        ]);
    }


    #[Route('/{id}', name: 'app_newsletter_show', methods: ['GET'])]
    public function show(Newsletter $newsletter): Response
    {
        return $this->render('/show.html.twig', [
            'newsletter' => $newsletter,
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
}

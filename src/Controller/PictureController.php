<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/picture')]
class PictureController extends AbstractController
{
    #[Route('/', name: 'app_picture_index', methods: ['GET'])]
    public function index(PictureRepository $pictureRepository): Response
    {
        $categories = $pictureRepository->getCategories();
        return $this->render('picture/index.html.twig', [
            'pictures' => $pictureRepository->findAll(),
            'categories' => $categories,
        ]);
    }




    #[Route('/new', name: 'app_picture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PictureRepository $pictureRepository, SluggerInterface $slugger): Response
    {
        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('photoFile')->getData();
            if ($imageFile) {
                $originalImageName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImageName = $slugger->slug($originalImageName) . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('photos_directory'),
                        $safeImageName
                    );

                    $picture->setImage($safeImageName);
                } catch (FileException $e) {
                    die("erreur de chargement de l'image !!");
                }
            }

            $pictureRepository->save($picture, true);


            return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('picture/new.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_picture_show', methods: ['GET'])]
    public function show(Picture $picture): Response
    {
        return $this->render('picture/show.html.twig', [
            'picture' => $picture,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_picture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Picture $picture, PictureRepository $pictureRepository): Response
    {
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $pictureRepository->save($picture, true);


            return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('picture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_picture_delete', methods: ['POST'])]
    public function delete(Request $request, Picture $picture, PictureRepository $pictureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $picture->getId(), $request->request->get('_token'))) {
            $pictureRepository->remove($picture, true);
        }


        return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\Exhibition;
use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\ExhibitionRepository;
use App\Repository\PictureRepository;
use App\Service\StatisticService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Service\CroppedService;
use App\Service\ImagineService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use DateTime;
use App\Service\DeleteImageService;

#[Route('/picture')]
class PictureController extends AbstractController
{
    private StatisticService $statisticService;
    private DeleteImageService $deleteImageService;



    public function __construct(
        StatisticService $statisticService,
        DeleteImageService $imageService,
    ) {
        $this->statisticService = $statisticService;
        $this->deleteImageService = $imageService;
    }

    #[Route('/exhibition/{id}', name: 'app_picture_index', methods: ['GET'])]
    public function index(
        PictureRepository $pictureRepository,
        Exhibition $exhibition
    ): Response {
        $now = new DateTime();
        if ($exhibition->getStart() > $now || $exhibition->getEnd() < $now) {
            throw $this->createNotFoundException('Cette exposition n\'est pas en cours.');
        }

        $pictures = $pictureRepository->findBy(['exhibition' => $exhibition]);

        $categories = $pictureRepository->getCategoriesForExhibition($exhibition);

        $this->statisticService->recordPageVisit('app_picture_index/' . $exhibition->getId());

        return $this->render('picture/index.html.twig', [
            'pictures' => $pictures,
            'categories' => $categories,
            'exhibition' => $exhibition,
        ]);
    }

    #[Route('/new/{id}', name: 'app_picture_new', methods: ['GET', 'POST'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function new(
        Request $request,
        PictureRepository $pictureRepository,
        SluggerInterface $slugger,
        int $id,
        ExhibitionRepository $exhibitionRepository,
        ImagineService $imagineService
    ): Response {
        $exhibition = $exhibitionRepository->find($id);
        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture, [
            'exhibition_id' => $id,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('newCategory')->getData() !== null) {
                $picture->setCategory($form->get('newCategory')->getData());
            }
            $imageFile = $form->get('photoFile')->getData();
            if ($imageFile) {
                $originalImageName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImageName = 'uploads/images/' . $slugger->slug($originalImageName) .
                 '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $safeImageName
                    );

                    $imagePaths = $imagineService->processImage(
                        $safeImageName,
                        $originalImageName,
                        $this->getParameter('images_directory')
                    );

                    $picture->setImage($safeImageName);
                    $picture->setSmallImage($imagePaths['small']);
                    $picture->setMediumImage($imagePaths['medium']);
                    $picture->setLargeImage($imagePaths['large']);
                    $picture->setExhibition($exhibition);
                    $pictureRepository->save($picture, true);
                } catch (FileException $e) {
                    die("Erreur lors du chargement de l'image !!");
                }
            }

            return $this->redirectToRoute(
                'exhibition_show_presentation',
                ['id' => $exhibition->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('picture/new.html.twig', [
            'exhibition' => $exhibition,
            'picture' => $picture,
            'form' => $form,
        ]);
    }



    #[Route('/{id}', name: 'app_picture_show', methods: ['GET'])]
    public function show(Picture $picture): Response
    {
        $this->statisticService->recordPageVisit('app_picture_show', $picture);
        return $this->render('picture/show.html.twig', [
            'picture' => $picture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_picture_edit', methods: ['GET', 'POST'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function edit(
        Request $request,
        Picture $picture,
        PictureRepository $pictureRepository,
        SessionInterface $session,
        SluggerInterface $slugger,
        ImagineService $imagineService
    ): Response {
        $form = $this->createForm(PictureType::class, $picture, [
            'exhibition_id' => $picture->getExhibition()->getId(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('newCategory')->getData() !== null) {
                $picture->setCategory($form->get('newCategory')->getData());
            }

            $imageFile = $form->get('photoFile')->getData();
            if ($imageFile) {
                $this->deleteImageVersions($picture);


                $originalImageName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImageName = 'uploads/images/'
                 . $slugger->slug($originalImageName)
                  . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $safeImageName
                    );

                    $imagePaths = $imagineService->processImage(
                        $safeImageName,
                        $originalImageName,
                        $this->getParameter('images_directory')
                    );

                    $picture->setImage($safeImageName);
                    $picture->setSmallImage($imagePaths['small']);
                    $picture->setMediumImage($imagePaths['medium']);
                    $picture->setLargeImage($imagePaths['large']);
                } catch (FileException $e) {
                    die("Erreur lors du chargement de la nouvelle image !!");
                }
            }

            $pictureRepository->save($picture, true);

            $previousUrl = $session->get('previous_url');

            return $previousUrl ? $this->redirect($previousUrl) :
            $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
        }

        $session->set('previous_url', $request->headers->get('referer'));

        return $this->render('picture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }

    public function deleteImageVersions(Picture $picture): void
    {
        $imagesDirectory = $this->getParameter('images_directory');
        $this->deleteImageService->deleteImageVersions($picture, $imagesDirectory);
    }


        #[Route('/intermediate/{id}', name: 'app_picture_intermediate', methods: ['GET'])]
    public function intermediatePage(int $id, PictureRepository $pictureRepository): Response
    {
        $picture = $pictureRepository->find($id);

        if (!$picture) {
            throw $this->createNotFoundException('Picture not found');
        }

        $exhibitionId = $picture->getExhibition()->getId();

        return $this->render('picture/cropDone.html.twig', [
        'imageId' => $exhibitionId,
        ]);
    }

    #[Route('/upload-crop', name: 'upload_crop', methods: ['POST'])]
    public function uploadCropAction(
        Request $request,
        CroppedService $croppedService
    ): Response {
        $result = $croppedService->uploadCropAction($request);

        return new Response(
            json_encode($result),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }

    #[Route('/{id}', name: 'app_picture_delete', methods: ['POST'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function delete(
        Request $request,
        Picture $picture,
        PictureRepository $pictureRepository,
        SessionInterface $session
    ): Response {
        if (
            $this->isCsrfTokenValid(
                'delete' . $picture->getId(),
                $request->request->get('_token')
            )
        ) {
            $pictureRepository->remove($picture, true);
        }

        $previousUrl = $session->get('previous_url');

        return $previousUrl ? $this->redirect($previousUrl) :
        $this->redirectToRoute(
            'app_picture_index',
            [],
            Response::HTTP_SEE_OTHER
        );
    }




    #[Route('/{id}/cropped', name: 'app_picture_cropped', methods: ['GET'])]
    public function cropped(Picture $picture): Response
    {

        $html =  $this->render('picture/cropped.html.twig', [
            'picture' => $picture,
        ]);
        return new Response($html);
    }
}

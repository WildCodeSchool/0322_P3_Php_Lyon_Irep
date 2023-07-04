<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Knp\Snappy\Pdf;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;

#[Route('/picture')]
class PictureController extends AbstractController
{
    private PictureRepository $pictureRepository;

    public function __construct(PictureRepository $pictureRepository)
    {
        $this->pictureRepository = $pictureRepository;
    }
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
                $safeImageName = 'uploads/images/' . $slugger->slug($originalImageName) . '.' .
                $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $safeImageName
                    );

                    $picture->setImage($safeImageName);


                    $imagine = new Imagine();
                    $imagePath = $safeImageName;


                    $smallImagePath =  $slugger->slug($originalImageName) . '.jpg';
                    $imagine->open($imagePath)
                        ->thumbnail(new Box(100, 100))
                        ->save($this->getParameter('images_directory') . '/smallImage' . '/' . $smallImagePath);
                    $picture->setSmallImage($smallImagePath);


                    $mediumImagePath =  $slugger->slug($originalImageName) . '.jpg';
                    $imagine->open($imagePath)
                        ->thumbnail(new Box(500, 500))
                        ->save($this->getParameter('images_directory') . '/mediumImage' . '/' . $mediumImagePath);
                    $picture->setMediumImage($mediumImagePath);


                    $largeImagePath =  $slugger->slug($originalImageName) . '.jpg';
                    $imagine->open($imagePath)
                        ->thumbnail(new Box(800, 800))
                        ->save($this->getParameter('images_directory') . '/largeImage' . '/' . $largeImagePath);
                    $picture->setLargeImage($largeImagePath);

                    $pictureRepository->save($picture, true);
                } catch (FileException $e) {
                    die("Erreur lors du chargement de l'image !!");
                }
            }

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

    #[Route('/upload-crop', name: 'upload_crop', methods: ['POST'])]
    public function uploadCropAction(Request $request): Response
    {

        $id = json_decode($request->getContent(), true)['id'];


        $imageData = json_decode($request->getContent(), true)['croppedImage'];


        $filename = uniqid('crop_') . '.png';


        $decodedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));


        $destinationPath = $this->getParameter('kernel.project_dir') . '/public/uploads/images/' . $filename;
        file_put_contents($destinationPath, $decodedImage);

        $picture = $this->pictureRepository->find($id);
        if (!$picture) {
            throw new NotFoundHttpException('Image not found');
        }

        $picture->setImageCrop('uploads/images/' . $filename);
        $this->pictureRepository->save($picture, true);


        return new Response(
            json_encode(['success' => true]),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
    #[Route('/{id}', name: 'app_picture_delete', methods: ['POST'])]
    public function delete(Request $request, Picture $picture, PictureRepository $pictureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $picture->getId(), $request->request->get('_token'))) {
            $pictureRepository->remove($picture, true);
        }


        return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/cropped', name: 'app_picture_cropped', methods: ['GET'])]
    public function cropped(Picture $picture): Response
    {
        return $this->render('picture/cropped.html.twig', [
            'picture' => $picture,
        ]);
    }

    #[Route('/{id}/pdf', name: 'app_picture_pdf', methods: ['GET'])]
    public function generatePdfAction(Picture $picture, Pdf $knpSnappy): Response
    {


        $html = $this->renderView('pdf/generatePdf.html.twig', [
            'picture' => $picture,
        ]);


        $pdf = $knpSnappy->getOutputFromHtml($html);

         return new PdfResponse(
             $pdf,
             'Download.pdf'
         );
    }
}

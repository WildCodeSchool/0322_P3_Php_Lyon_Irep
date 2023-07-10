<?php

namespace App\Controller;

use App\Service\GeneratePdfService;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Picture;

#[Route('/pdf')]
class GeneratePdfController extends AbstractController
{
    private GeneratePdfService $generatePdfService;

    public function __construct(GeneratePdfService $generatePdfService)
    {
        $this->generatePdfService = $generatePdfService;
    }

    #[Route('/exhibition', name: 'app_picture_exhibition_pdf', methods: ['GET'])]
    public function generateExhibitionPdf(): Response
    {
        return $this->generatePdfService->generatePdfExhibition();
    }

    #[Route('/download', name: 'app_picture_download_pdf', methods: ['GET'])]
    public function downloadPdf(): Response
    {
        return $this->generatePdfService->downloadPdf();
    }

    #[Route('/picture/{id}', name: 'app_picture_pdf', methods: ['GET'])]
    public function generatePicturePdf(Picture $picture, Pdf $knpSnappy): Response
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

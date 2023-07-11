<?php

namespace App\Controller;

use App\Service\GeneratePdfService;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Picture;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

#[Route('/pdf')]
class GeneratePdfController extends AbstractController
{
    #[Route('/exhibition', name: 'app_picture_exhibition_pdf', methods: ['GET'])]
    public function generatePdfAction(GeneratePdfService $generatePdfService): BinaryFileResponse
    {
        $pdfFilePath = $generatePdfService->generatePdfExhibition();

        $response = new BinaryFileResponse($pdfFilePath);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Download.pdf');

        return $response;
    }

    #[Route('/download', name: 'app_picture_download_pdf', methods: ['GET'])]
    public function downloadPdf(): BinaryFileResponse
    {
        $pdfFilePath = 'downloadPdf/Download.pdf';
        $response = new BinaryFileResponse($pdfFilePath);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Download.pdf');
        return $response;
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

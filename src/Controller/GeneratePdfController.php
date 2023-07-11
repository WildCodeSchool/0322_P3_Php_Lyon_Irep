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
use App\Repository\ExhibitionRepository;

#[Route('/pdf')]
class GeneratePdfController extends AbstractController
{
    private ExhibitionRepository $exhibitionRepository;

    public function __construct(ExhibitionRepository $exhibitionRepository)
    {
        $this->exhibitionRepository = $exhibitionRepository;
    }
    #[Route('/exhibition/{id}', name: 'app_picture_exhibition_pdf', methods: ['GET'])]
    public function generatePdfAction(GeneratePdfService $generatePdfService, int $id): BinaryFileResponse
    {
        // dd($id);
        $exhibition = $this->exhibitionRepository->find($id);
        $exhibitionName = $exhibition->getName();
        $pdfFilePath = $generatePdfService->generatePdfExhibition($id, $exhibitionName);
        $response = new BinaryFileResponse($pdfFilePath);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Download.pdf');

        return $response;
    }

    #[Route('/download/{exhibitionId}', name: 'app_picture_download_pdf', methods: ['GET'])]
    public function downloadPdf(int $exhibitionId): BinaryFileResponse
    {
        $exhibition = $this->exhibitionRepository->find($exhibitionId);
        $exhibitionName = $exhibition->getName();

        $pdfFilePath = 'downloadPdf/' . $exhibitionName . '.pdf';

        $response = new BinaryFileResponse($pdfFilePath);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $exhibitionName . '.pdf');

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

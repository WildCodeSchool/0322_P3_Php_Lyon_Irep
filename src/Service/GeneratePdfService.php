<?php

namespace App\Service;

use App\Repository\PictureRepository;
use Knp\Snappy\Pdf;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Twig\Environment;

class GeneratePdfService
{
    private PictureRepository $pictureRepository;
    private Pdf $knpSnappy;
    private Environment $twig;
    public function __construct(PictureRepository $pictureRepository, Pdf $knpSnappy, Environment $twig)
    {
        $this->pictureRepository = $pictureRepository;
        $this->knpSnappy = $knpSnappy;
        $this->twig = $twig;
    }
    public function generatePdfExhibition(): Response
    {
        set_time_limit(120);
        $pictures = $this->pictureRepository->findAll();
        $html = $this->twig->render('pdf/generatePdfExhibition.html.twig', [
            'pictures' => $pictures,
        ]);
        $pdf = $this->knpSnappy->getOutputFromHtml($html);
        $pdfFilePath = 'downloadPdf/Download.pdf';
        file_put_contents($pdfFilePath, $pdf);
        $response = new BinaryFileResponse($pdfFilePath);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Download.pdf');
        return $response;
    }

    public function downloadPdf(): BinaryFileResponse
    {
        $pdfFilePath = 'downloadPdf/Download.pdf';
        $response = new BinaryFileResponse($pdfFilePath);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Download.pdf');
        return $response;
    }
}

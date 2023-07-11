<?php

namespace App\Service;

use App\Repository\PictureRepository;
use Knp\Snappy\Pdf;
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
    public function generatePdfExhibition(): string
    {
        set_time_limit(120);
        $pictures = $this->pictureRepository->findAll();
        $html = $this->twig->render('pdf/generatePdfExhibition.html.twig', [
            'pictures' => $pictures,
        ]);
        $pdf = $this->knpSnappy->getOutputFromHtml($html);
        $pdfFilePath = 'downloadPdf/Download.pdf';
        file_put_contents($pdfFilePath, $pdf);
        return $pdfFilePath;
    }
}

<?php

namespace App\Service;

use App\Repository\ExhibitionRepository;
use App\Repository\PictureRepository;
use Knp\Snappy\Pdf;
use Twig\Environment;

class GeneratePdfService
{
    private PictureRepository $pictureRepository;
    private ExhibitionRepository $exhibitionRepository;

    private Pdf $knpSnappy;
    private Environment $twig;
    public function __construct(
        PictureRepository $pictureRepository,
        Pdf $knpSnappy,
        Environment $twig,
        ExhibitionRepository $exhibitionRepository
    ) {
        $this->pictureRepository = $pictureRepository;
        $this->exhibitionRepository = $exhibitionRepository;
        $this->knpSnappy = $knpSnappy;
        $this->twig = $twig;
    }
    public function generatePdfExhibition(int $id, string $exhibitionName): string
    {
        set_time_limit(120);
        $exhibition = $this->exhibitionRepository->find($id);
        $pictures = $this->pictureRepository->findBy(['exhibition' => $exhibition]);
        $html = $this->twig->render('pdf/generatePdfExhibition.html.twig', [
            'pictures' => $pictures,
        ]);
        $pdf = $this->knpSnappy->getOutputFromHtml($html);
        $pdfFilePath = 'downloadPdf/' . $exhibitionName . '.pdf';
        file_put_contents($pdfFilePath, $pdf);
        return $pdfFilePath;
    }
}

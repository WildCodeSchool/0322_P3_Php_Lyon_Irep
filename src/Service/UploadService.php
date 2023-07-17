<?php

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UploadService
{
    public function __construct(
        private SluggerInterface $slugger
    ) {
    }

    public function uploadImg(mixed $fileData, string $directory): string
    {
        $presentationFile = $fileData;
        $safeImageName = '';
        if (!empty($presentationFile)) {
            $originalImageName = pathinfo(
                $presentationFile->getClientOriginalName(),
                PATHINFO_FILENAME
            );
            $safeImageName = 'uploads/presentationImg/' . $this->slugger->slug($originalImageName) .
                '.' . $presentationFile->guessExtension();

            try {
                $presentationFile->move(
                    $directory,
                    $safeImageName
                );
            } catch (FileException $e) {
                die("L'image n'a pas pu être téléchargée.");
            }
        }
        return $safeImageName;
    }
}

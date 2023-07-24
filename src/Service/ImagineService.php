<?php

namespace App\Service;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;

class ImagineService
{
    private Imagine $imagine;

    public function __construct()
    {
        $this->imagine = new Imagine();
    }

    public function processImage(string $imagePath, string $originalImageName, string $imagesDirectory): array
    {

        $smallImagePath = $this->generateImagePath($originalImageName, 'small', 'jpg');
        $this->imagine->open($imagePath)
        ->thumbnail(new Box(100, 100))
        ->save($imagesDirectory . '/smallImage/' . $smallImagePath);


        $mediumImagePath = $this->generateImagePath($originalImageName, 'medium', 'jpg');
        $this->imagine->open($imagePath)
        ->thumbnail(new Box(500, 500))
        ->save($imagesDirectory . '/mediumImage/' . $mediumImagePath);


        $largeImagePath = $this->generateImagePath($originalImageName, 'large', 'jpg');
        $this->imagine->open($imagePath)
        ->thumbnail(new Box(800, 800))
        ->save($imagesDirectory . '/largeImage/' . $largeImagePath);

        return [
        'small' => 'uploads/images/smallImage/' . $smallImagePath,
        'medium' => 'uploads/images/mediumImage/' . $mediumImagePath,
        'large' => 'uploads/images/largeImage/' . $largeImagePath,
        ];
    }

    private function generateImagePath(string $originalImageName, string $version, string $extension): string
    {
        return $originalImageName . '_' . $version . '.' . $extension;
    }
}

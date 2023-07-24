<?php

namespace App\Service;

use App\Entity\Picture;

class DeleteImageService
{
    public function deleteImageVersions(Picture $picture, string $imagesDirectory): void
    {
        $imageVersions = ['getSmallImage', 'getMediumImage', 'getLargeImage'];

        foreach ($imageVersions as $version) {
            $imagePath = $picture->$version();

            if ($imagePath) {
                $imagePath = substr($imagePath, strlen("uploads/images/"));
                $imagePath = $imagesDirectory . '/' . $imagePath;
                $imagePath = str_replace('/', '\\', $imagePath);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $picture->$version(null);
        }
    }
}

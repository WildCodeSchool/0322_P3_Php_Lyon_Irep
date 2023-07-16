<?php

namespace App\Service;

use App\Repository\PictureRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class CroppedService
{
    private PictureRepository $pictureRepository;
    private ParameterBagInterface $parameterBag;
    public function __construct(
        PictureRepository $pictureRepository,
        ParameterBagInterface $parameterBag
    ) {
        $this->pictureRepository = $pictureRepository;
        $this->parameterBag = $parameterBag;
    }


    public function uploadCropAction(Request $request): array
    {
        $id = json_decode($request->getContent(), true)['id'];
        $imageData = json_decode($request->getContent(), true)['croppedImage'];
        $filename = uniqid('crop_') . '.png';
        $decodedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
        $destinationPath = $this->parameterBag->get('kernel.project_dir') . '/public/uploads/images/' . $filename;
        file_put_contents($destinationPath, $decodedImage);
        $picture = $this->pictureRepository->find($id);
        if (!$picture) {
            throw new NotFoundHttpException('Image not found');
        }

        $picture->setImageCrop('uploads/images/' . $filename);
        $this->pictureRepository->save($picture, true);
        return ['success' => true];
    }
}

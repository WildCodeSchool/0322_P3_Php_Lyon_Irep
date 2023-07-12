<?php

namespace App\Controller;

use App\Entity\Exhibition;
use App\Repository\PresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class NavigationController extends AbstractController
{
    private $presentationRepository;

    public function __construct(PresentationRepository $presentationRepository)
    {
        $this->presentationRepository = $presentationRepository;
    }
    #[Route('/save-exhibition-id', name:'save_exhibition_id', methods: ["POST"])]
    public function saveExhibitionId(Request $request, SessionInterface $session): Response
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['id'])) {
            $session->set('exhibitionId', $data['id']);
        }

        return $this->json(['success' => true]);
    }
    /**
 * @Route("/presentation-image/{id}", name="presentation_image")
 */
public function getPresentationImage(Exhibition $exhibition): Response
{
    // Supposons que $presentationRepository est une instance de PresentationRepository
    // et qu'il a une méthode `findFirstByExhibition` qui renvoie la première présentation d'une exposition
    $presentation = $this->presentationRepository->findFirstByExhibition($exhibition);

    if ($presentation && $presentation->getImage()) {
        return new JsonResponse(['imageUrl' => $presentation->getImage()]);
    }

    // Fournir une image par défaut ou une réponse d'erreur si aucune image de présentation n'est trouvée
    return new JsonResponse(['imageUrl' => '/path/to/default/image.jpg']);
}
}

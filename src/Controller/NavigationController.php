<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class NavigationController extends AbstractController
{
    #[Route('/save-exhibition-id', name:'save_exhibition_id', methods: ["POST"])]
    public function saveExhibitionId(Request $request, SessionInterface $session): Response
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['id'])) {
            $session->set('exhibitionId', $data['id']);
        }

        return $this->json(['success' => true]);
    }
}

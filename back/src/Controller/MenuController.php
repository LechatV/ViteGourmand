<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/menu', name: 'app_api_menu_')]
final class MenuController extends AbstractController
{
    public function __construct(
        private MenuRepository $repository,
        private SerializerInterface $serializer,
    ) {
    }

    // Renvoie la liste de tous les menus
    #[Route(name: 'index', methods: 'GET')]
    public function index(): JsonResponse
    {
        $menus = $this->repository->findAll();
        $responseData = $this->serializer->serialize($menus, 'json');

        return new JsonResponse($responseData, Response::HTTP_OK, [], true);
    }
}

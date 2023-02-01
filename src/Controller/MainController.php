<?php

namespace App\Controller;

use App\Services\FilmserieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private FilmserieService $FilmserieService;

    function __construct(FilmserieService $FilmserieService)
    {
        $this->FilmserieService = $FilmserieService;
    }

    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        $data = $this->FilmserieService->getAllFilmSerie();
        return $this->render('main.html.twig',[ 
            'filmseries' => $data
        ]);
    }

    #[Route('/create', name: 'filmserie_create')]
    public function createfilmserie(Request $request): JsonResponse
    {
        $response = $this->FilmserieService->createfilmserie($request);
        if($response){
            return new JsonResponse([
                "code" => 200,
                "message" => "Le Film à bien était crée"
            ]);
        }else{
            return new JsonResponse([
                "code" => 500,
                "message" => "Un probléme est survenu"
            ]);
        }
    }

    #[Route('/getall', name: 'filmserie_getall')]
    public function getallfilmserie(): JsonResponse
    {
        $data = $this->FilmserieService->getAllFilmSerie();
        if($data){
            return new JsonResponse([
                "code" => 200,
                "message" => $data
            ]);
        }else{
            return new JsonResponse([
                "code" => 200,
                "message" => "Il n'y a pas de films"
            ]); 
        }
    }

    #[Route('/get/{item_id}', name: 'filmserie_getitem')]
    public function getitemfilmserie(int $item_id): JsonResponse
    {
        if(!is_int($item_id)){
            return new JsonResponse([
                "code" => 400,
                "message" => "Requete invalide"
            ]);
        }
        $data = $this->FilmserieService->getidFilmSerie($item_id);
        if($data){
            return new JsonResponse([
                "code" => 200,
                "message" => $data
            ]);
        }
    }
    



    
}

<?php

namespace App\Services;

use App\Entity\Filmserie;
use App\Repository\FilmserieRepository;
use Symfony\Component\HttpFoundation\Response;
use Exception;

use DateTime;

class FilmserieService
{
    private $FilmserieRepository;

    public function __construct(FilmserieRepository $FilmserieRepository)
    {
        $this->FilmserieRepository = $FilmserieRepository;
    }


    public function createFilmserieExemple(){

        $filmserie = new Filmserie();
        
        $filmserie->setNom("Avengers");
        $filmserie->setDateCreation(new DateTime());
        $filmserie->setSynopsis("Films de super héros");
        $filmserie->setType("Films");

        $this->FilmserieRepository->save($filmserie, true);

        return true;
    }

    public function createFilmserie($request){
        $data = json_decode($request->getContent(), true);

        $filmserie = new Filmserie();
        
        $filmserie->setNom($data["Nom"]);
        $date = DateTime::createFromFormat('d/m/Y', $data["Date"]);
        $filmserie->setDateCreation($date);
        $filmserie->setSynopsis($data["Synopsis"]);
        $filmserie->setType($data["Type"]);

        $this->FilmserieRepository->save($filmserie, true);

        return true;
    }

    public function getAllFilmSerie(){
        $responses = $this->FilmserieRepository->findall();
        foreach ($responses as $response) {
            $data[] = [
                'id' => $response->getId(),
                'name' => $response->getNom(),
                'synopsis' => $response->getSynopsis(),
                'type' => $response->getType(),
                'date' => $response->getDateCreation(),
            ];
        }
        return $data;
    }

    public function getidFilmSerie($id){
        $response = $this->FilmserieRepository->find($id);
        if(!$response){
            return "Le film n'existe pas";
        }
        $data[] = [
            'id' => $response->getId(),
            'name' => $response->getNom(),
            'synopsis' => $response->getSynopsis(),
            'type' => $response->getType(),
            'date' => $response->getDateCreation(),
        ];
        return $data;
    }

    public function getAllFilmSerieForTempltate(){
        return $this->FilmserieRepository->findall();
    }
}
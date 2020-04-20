<?php

namespace MyApp\Bundle\FilmBundle\Film\Controller;

use MyApp\Component\Film\Domain\Film;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Query;

class ListFilmController extends Controller
{

    public function execute()
    {
        $films = $this->getDoctrine()->getRepository('\MyApp\Component\Film\Domain\Film')->findAll(Query::HYDRATE_ARRAY);

        $filmsAsArray = array_map(function (Film $f) {
            return $this->filmToArray($f);
        }, $films);

        return $this->render('Film/list.html.twig',[
            'listfilms' => $filmsAsArray
        ]);
        //return new JsonResponse($filmsAsArray);
    }

    private function filmToArray(Film $film)
    {
        return [
            'id' => $film->getId(),
            'name' => $film->getName(),
            'description' => $film->getDescription(),
            'actor' => $film->getActor()->getName()
        ];
    }

}
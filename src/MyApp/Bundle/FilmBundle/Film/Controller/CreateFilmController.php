<?php

namespace MyApp\Bundle\FilmBundle\Film\Controller;

use MyApp\Component\Film\Domain\Film;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateFilmController extends Controller
{

    public function execute(Request $request)
    {

        $json = json_decode($request->getContent(), true);

        $name = $json['name'];
        $description = $json['description'];
        $actorId = $json['actorId'];

        $actor = $this->getDoctrine()->getRepository('\MyApp\Component\Film\Domain\Actor')->findOneBy(['id' => $actorId]);

        $film = new Film((string)$name,(string)$description, $actor);

        $em = $this->getDoctrine()->getManager();

        $em->persist($film);
        $em->flush();

        return new Response('', 201);

    }

}
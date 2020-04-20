<?php

namespace MyApp\Bundle\FilmBundle\Film\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateFilmController extends Controller
{

    public function execute(Request $request, $id)
    {

        $json = json_decode($request->getContent(), true);

        $film = $this->getDoctrine()->getRepository('\MyApp\Component\Film\Domain\Film')->findOneBy(['id' => $id]);

        $film->setName($json['name']);
        $film->setDescription($json['description']);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response('', 200);

    }

}
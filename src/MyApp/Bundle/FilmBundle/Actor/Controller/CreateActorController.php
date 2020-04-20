<?php

namespace MyApp\Bundle\FilmBundle\Actor\Controller;

use MyApp\Component\Film\Domain\Actor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateActorController extends Controller
{

    public function execute(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $actor = new Actor((string)$json['name']);
        $em->persist($actor);
        $em->flush();

        return new Response('', 201);

    }

}
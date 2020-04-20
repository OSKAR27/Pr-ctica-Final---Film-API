<?php

namespace MyApp\Bundle\FilmBundle\Actor\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateActorController extends Controller
{

    public function execute(Request $request, $id)
    {

        $json = json_decode($request->getContent(), true);

        $actor = $this->getDoctrine()->getRepository('\MyApp\Component\Film\Domain\Actor')->findOneBy(['id' => $id]);

        $actor->setName($json['name']);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response('', 200);

    }

}
<?php

namespace MyApp\Bundle\FilmBundle\Actor\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DeleteActorController extends Controller
{

    public function execute($id)
    {
        $em = $this->getDoctrine()->getManager();

       $actor = $em->getReference('\MyApp\Component\Film\Domain\Actor', $id);

       $em->remove($actor);
       $em->flush();

       return new Response('', 200);
    }

}
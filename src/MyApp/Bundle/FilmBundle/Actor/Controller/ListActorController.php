<?php

namespace MyApp\Bundle\FilmBundle\Actor\Controller;

use MyApp\Component\Film\Domain\Actor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Query;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;


class ListActorController extends Controller
{
    /**
     *  @Route("/",name="list")
     */
    public function execute()
    {
        $actors = $this->getDoctrine()->getRepository('\MyApp\Component\Film\Domain\Actor')->findAll(Query::HYDRATE_ARRAY);

        $actorsAsArray = array_map(function (Actor $o) {
             return $this->actorToArray($o);
        }, $actors);

         // init cache pool of file system adapter
        $cachePool = new FilesystemAdapter('', 0, "cache");
        //$cachePool->clear();
        // 1. store string values
        $demoString = $cachePool->getItem('demo_array');
        if (!$demoString->isHit())
        {
            $demoString->set(array("one", "two", "three"));
            $cachePool->save($demoString);
        }
        if ($cachePool->hasItem('demo_array'))
        {
            $demoString = $cachePool->getItem('demo_array');
            //echo $demoString->get();
            //var_dump($demoString->get());
            echo "\n";
        }
        
        if ($cachePool->hasItem('demo_string'))
        {
            $demoString = $cachePool->getItem('demo_string');
            //echo $demoString->get();
            //var_dump($demoString->get());
            //echo "\n";
        }

       

        return $this->render('Actor/list.html.twig',[
            'listactor' => $actorsAsArray
        ]);
        //return new JsonResponse($actorsAsArray);

        /*{
	        "name": "oscar"
        }*/
    }

    private function actorToArray(Actor $actor)
    {
        return [
            'id' => $actor->getId(),
            'name' => $actor->getName()
        ];
    }

}
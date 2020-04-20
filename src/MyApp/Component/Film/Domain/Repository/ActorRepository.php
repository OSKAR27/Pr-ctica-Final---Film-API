<?php

namespace MyApp\Component\Film\Domain\Repository;


interface ActorRepository
{

    public function findById($actorId);

    public function findAllOrderedByName();

}
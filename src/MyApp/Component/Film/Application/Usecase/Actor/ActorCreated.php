<?php

namespace MyApp\Component\Film\Application\UseCase\Actor;

use MyApp\Component\Film\Domain\Actor;
use Symfony\Component\EventDispatcher\Event;

class ActorCreated extends Event
{

    const TOPIC = "actor.created";

    private $actor;

    public function __construct(Actor $actor)
    {
        $this->actor = $actor;
    }

    public function getActor(): Actor
    {
        return $this->actor;
    }

}
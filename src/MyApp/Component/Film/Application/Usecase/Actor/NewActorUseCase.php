<?php

namespace MyApp\Component\Film\Application\UseCase\Actor;

use Doctrine\ORM\EntityManager;
use MyApp\Component\Film\Domain\Actor;
use MyApp\Component\Product\Application\Service\EmailService;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class NewActorUseCase
{
    private $entityManager;

    private $dispatcher;

    public function __construct(EntityManager $entityManager, EventDispatcherInterface $dispatcher)
    {
        $this->entityManager = $entityManager;
        $this->dispatcher = $dispatcher;
    }

    public function execute(string $actorName)
    {
        $actor = new Actor($actorName);

        $this->entityManager->persist($actor);
        $this->entityManager->flush();

        $this->dispatcher->dispatch(ActorCreated::TOPIC, new ActorCreated($actor));

    }


}
<?php

namespace MyApp\Bundle\FilmBundle\Actor\Repository;

use MyApp\Component\Film;
use Doctrine\ORM\EntityRepository;

class ActorRepository extends EntityRepository implements Film\Domain\Repository\ActorRepository
{

    public function findById($actorId)
    {
        return $this->findOneBy(['id' => $actorId]);
    }

    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT o FROM \MyApp\Component\Film\Domain\Actor o ORDER BY o.name ASC'
            )
            ->getResult();
    }
}
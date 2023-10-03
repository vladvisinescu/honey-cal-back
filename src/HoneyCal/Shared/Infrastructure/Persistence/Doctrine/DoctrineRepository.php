<?php

namespace HoneyCal\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use HoneyCal\Shared\Domain\Aggregate\AggregateRoot;

abstract class DoctrineRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    protected function entityManager(): EntityManager
    {
        return $this->entityManager;
    }

    protected function repository(string $entityClass): EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }

    protected function remove(AggregateRoot $entity): void
    {
        $this->entityManager()->remove($entity);
        $this->entityManager()->flush($entity);
    }

    protected function persist(AggregateRoot $entity): void
    {
        dd($entity);
        $this->entityManager()->persist($entity);
        $this->entityManager()->flush($entity);
    }
}

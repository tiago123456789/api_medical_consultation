<?php

namespace App\Repository;

use App\Entity\Entity;
use App\Helpers\Pagination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

abstract class Repository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry, $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    public function findAllSortBy(array $filters = [], array $sortBy, Pagination $pagination)
    {
        return $this->findBy(
            $filters, $sortBy,
            $pagination->getQuantityItensPage(), $pagination->getCurrentPage()
        );
    }

    public function findById($id)
    {
        return $this->find($id);
    }

    public function remove($id)
    {
        $entity = $this->findById($id);
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function update($id, array $datasModified)
    {
        $entity = $this->findById($id);
        $fieldsModifieds = array_keys($datasModified);
        foreach ($fieldsModifieds as $fieldModified) {
            $entity->{"set" . ucfirst($fieldModified)}($datasModified[$fieldModified]);
        }
        $this->getEntityManager()->flush();
        return $entity;
    }

    public function create(Entity $newRegister)
    {
        $this->getEntityManager()->persist($newRegister);
        $this->getEntityManager()->flush();
    }
}
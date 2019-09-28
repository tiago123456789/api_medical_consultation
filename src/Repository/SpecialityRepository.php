<?php

namespace App\Repository;

use App\Entity\Speciality;
use Doctrine\Common\Persistence\ManagerRegistry;

class SpecialityRepository extends Repository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Speciality::class);
    }

}
<?php

namespace App\Repository;


use App\Entity\Doctor;
use Doctrine\Common\Persistence\ManagerRegistry;

class DoctorRepository extends Repository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doctor::class);
    }

    public function findAllBySpeciality($specialityId)
    {
        return $this->findBy([ "speciality" => $specialityId ]);
    }
}
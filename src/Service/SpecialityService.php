<?php

namespace App\Service;


use App\Entity\Speciality;
use App\Exception\NotFoundException;
use App\Factory\DoctorFactory;
use App\Factory\SpecialityFactory;
use App\Helpers\Pagination;
use App\Repository\SpecialityRepository;

class SpecialityService
{

    private $repository;

    private $specialityFactory;

    public function __construct(
        SpecialityRepository $doctorRepository, SpecialityFactory $specialityFactory
    )
    {
        $this->repository = $doctorRepository;
        $this->specialityFactory = $specialityFactory;
    }

    public function findAll(array $filters, array $sortBy, Pagination $pagination)
    {
        return $this->repository->findAllSortBy($filters, $sortBy, $pagination);
    }

    public function findById($id)
    {
        $doctor = $this->repository->findById($id);
        if (!$doctor) {
            throw new NotFoundException("Speciality not found!");
        }
        return $doctor;
    }

    public function create(array $newRegister)
    {
        $doctor = $this->specialityFactory->make($newRegister);
        $this->repository->create($doctor);
    }

    public function remove($id)
    {
        $this->findById($id);
        $this->repository->remove($id);
    }

    public function update($id, array $datasModified)
    {
        $this->findById($id);
        $this->repository->update($id, $datasModified);
    }
}
<?php

namespace App\Service;

use App\Exception\NotFoundException;
use App\Factory\DoctorFactory;
use App\Helpers\Pagination;
use App\Repository\DoctorRepository;

class DoctorService
{

    private $repository;

    private $doctorFactory;

    public function __construct(DoctorRepository $doctorRepository, DoctorFactory $doctorFactory)
    {
        $this->repository = $doctorRepository;
        $this->doctorFactory = $doctorFactory;
    }

    public function findAll(array $filters = [], array $sortBy, Pagination $pagination)
    {
        return $this->repository->findAllSortBy($filters, $sortBy, $pagination);
    }

    public function findAllBySpeciality($specialityId)
    {
        return $this->repository->findAllBySpeciality($specialityId);
    }

    public function findById($id)
    {
        $doctor = $this->repository->findById($id);
        if (!$doctor) {
            throw new NotFoundException("Doctor not found!");
        }
        return $doctor;
    }

    public function create(array $newRegister)
    {
        $doctor = $this->doctorFactory->make($newRegister);
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
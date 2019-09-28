<?php

namespace App\Controller;
use App\Exception\MedicalConsultationException;
use App\Service\DoctorService;
use App\Service\SpecialityService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecialityController extends Controller
{

    private $specialityService;

    private $doctorService;

    public function __construct(SpecialityService $specialityService, DoctorService $doctorService)
    {
        $this->specialityService = $specialityService;
        $this->doctorService = $doctorService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $newRegister = $this->getDatasBodyRequest($request);
        $this->specialityService->create($newRegister);
        return new Response("", Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function findAll(Request $request)
    {
        $specialities = $this->specialityService->findAll(
            $this->getFilters($request), $this->getOrdernation($request),
            $this->getPagination($request)
        );
        return new JsonResponse($specialities);
    }

    /**
     * @param $id
     * @return Response
     */
    public function findById($id): Response
    {
        try {
            return new JsonResponse($this->specialityService->findById($id));
        } catch (MedicalConsultationException $e) {
            return $this->displayError($e);
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request): Response
    {
        try {
            $datasModified = $this->getDatasBodyRequest($request);
            $this->specialityService->update($id, $datasModified);
            return new Response("", Response::HTTP_NO_CONTENT);
        } catch (MedicalConsultationException $e) {
            return $this->displayError($e);
        }
    }

    /**
     * @param $id
     * @return Response
     */
    public function remove($id): Response
    {
        try {
            $this->specialityService->remove($id);
            return new Response("", Response::HTTP_NO_CONTENT);
        } catch (MedicalConsultationException $e) {
            return $this->displayError($e);
        }
    }

    /**
     * @param $id
     * @return Response
     */
    public function findAllDoctorsBySpeciality($id): Response
    {
        return new JsonResponse($this->doctorService->findAllBySpeciality($id));
    }
}
<?php

namespace App\Controller;
use App\Exception\MedicalConsultationException;
use App\Service\DoctorService;
use App\Service\SpecialityService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorController extends Controller
{

    private $doctorService;

    private $specialityService;

    function __construct(DoctorService $doctorService, SpecialityService $specialityService)
    {
        $this->doctorService = $doctorService;
        $this->specialityService = $specialityService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $newRegister = $this->getDatasBodyRequest($request);
        $newRegister["speciality"] = $this->specialityService->findById($newRegister["specialityId"]);
        unset($newRegister["specialityId"]);
        $this->doctorService->create($newRegister);
        return new Response("", Response::HTTP_CREATED);
    }

    public function findAll(Request $request)
    {
        $doctors = $this->doctorService->findAll(
            $this->getFilters($request), $this->getOrdernation($request),
            $this->getPagination($request)
        );
        return new JsonResponse($doctors);
    }

    /**
     * @param $id
     * @return Response
     */
    public function findById($id): Response
    {
        try {
            return new JsonResponse($this->doctorService->findById($id));
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
            $this->doctorService->update($id, $datasModified);
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
            $this->doctorService->remove($id);
            return new Response("", Response::HTTP_NO_CONTENT);
        } catch (MedicalConsultationException $e) {
            return $this->displayError($e);
        }
    }
}
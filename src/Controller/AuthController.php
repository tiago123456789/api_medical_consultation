<?php

namespace App\Controller;

use App\Exception\MedicalConsultationException;
use App\Service\AuthService;
use Symfony\Component\DependencyInjection\Tests\Compiler\J;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends Controller
{

    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @Route("/auth", methods={"POST"}, name="auth")
     * @param Request $request
     * @return Response
     */
    public function authenticate(Request $request): Response
    {
        try {
            $credentials = json_decode($request->getContent(), true);

            if (is_null($credentials["username"] || is_null($credentials["password"]))) {
                return new JsonResponse([
                    "message" => "Datas informateds invalid!"
                ], Response::HTTP_BAD_REQUEST);
            }

            $datas = $this->authService->autenticate($credentials);
            return new JsonResponse($datas);
        } catch(MedicalConsultationException $e) {
            $this->displayError($e);
        }
    }
}

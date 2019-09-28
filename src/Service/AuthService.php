<?php

namespace App\Service;


use App\Exception\DataInvalidException;
use App\Repository\UserRepository;
use Firebase\JWT\JWT;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthService
{

    private $userRepository;

    private $passwordEncoder;

    public function __construct(
        UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function autenticate($credentials)
    {
        $user = $this->userRepository->findOneBy([ "username" => $credentials["username"] ]);
        if (!$user) {
            throw new DataInvalidException("Datas invalid!");
        }

        if (!$this->passwordEncoder->isPasswordValid($user, $credentials["password"])) {
            throw new DataInvalidException("Datas invalid!");
        }

        $accessToken = JWT::encode([ "username" => $credentials["username"]], $_ENV["JWT_SECRET"]);
        return [
            "accessToken" => $accessToken
        ];
    }
}
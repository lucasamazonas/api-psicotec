<?php

namespace App\Helper;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory implements EntidadeFactoryInterface
{
    public function __construct(
        protected UserPasswordHasherInterface $passwordHasher
    ) {}

    public function criarEntidade(string $json): User
    {
        $dados = json_decode($json);

        $usuario = new User();
        $usuario->setEmail($dados->email);

        $hashedPassword = $this->passwordHasher->hashPassword(
            $usuario,
            $dados->password
        );

        $usuario->setPassword($hashedPassword);

        return $usuario;
    }

}
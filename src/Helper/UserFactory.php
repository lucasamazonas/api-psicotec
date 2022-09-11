<?php

namespace App\Helper;

use App\Entity\Perfil;
use App\Entity\User;
use App\Repository\PerfilRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory implements EntidadeFactoryInterface
{
    public function __construct(
        protected UserPasswordHasherInterface $passwordHasher,
        protected PerfilRepository $perfilRepository
    ) {}

    public function criarEntidade(string $json): User
    {
        $dados = json_decode($json);

        $usuario = new User();
        $usuario->setName(trim($dados->name));
        $usuario->setEmail(trim($dados->email));

        $id_perfil = ($dados->flag_paciente)
            ? Perfil::ID_PERFIL_PACIENTE : Perfil::ID_PERFIL_PROFISSIONAL;
        $usuario->setPerfil($this->perfilRepository->find($id_perfil));

        $hashedPassword = $this->passwordHasher->hashPassword($usuario, trim($dados->password));
        $usuario->setPassword($hashedPassword);

        return $usuario;
    }

}
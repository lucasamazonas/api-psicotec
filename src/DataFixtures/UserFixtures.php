<?php

namespace App\DataFixtures;

use App\Entity\Perfil;
use App\Entity\User;
use App\Repository\PerfilRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    const USERS = [
        ['Lucas Silva Amazonas', 'admin@admin.com', Perfil::ID_PERFIL_ADMIN],
        ['Lucas Silva Amazonas', 'paciente@paciente.com', Perfil::ID_PERFIL_PACIENTE],
        ['Lucas Silva Amazonas', 'profissional@profissional.com', Perfil::ID_PERFIL_PROFISSIONAL],
    ];

    const PASSWORD = '$2y$13$4XcEat8.GPL/bny94aJZG.ltruoWqNNHuq4T2AozvDdLdEaPSvX5O';

    public function __construct(
        private PerfilRepository $perfilRepository
    ) {}

    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as [$nome, $email, $idPerfil]) {
            $usuario = new User();
            $usuario->setName($nome);
            $usuario->setEmail($email);
            $usuario->setPerfil($this->perfilRepository->find($idPerfil));
            $usuario->setPassword(self::PASSWORD);

            $manager->persist($usuario);
        }

        $manager->flush();
    }
}

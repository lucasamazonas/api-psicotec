<?php

namespace App\DataFixtures;

use App\Entity\Perfil;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PerfilFixtures extends Fixture
{
    const PERFIS = [
        [Perfil::ID_PERFIL_ADMIN, 'Administrador'],
        [Perfil::ID_PERFIL_PACIENTE, 'Paciente'],
        [Perfil::ID_PERFIL_PROFISSIONAL, 'Profissional'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PERFIS as [$id, $descricao]) {
            $perfil = new Perfil();
            $perfil->setId($id);
            $perfil->setDescricao($descricao);

            $manager->persist($perfil);
        }

        $manager->flush();
    }
}

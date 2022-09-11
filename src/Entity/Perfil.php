<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilRepository::class)]
class Perfil
{
    const ID_PERFIL_ADMIN = 'A';
    const ID_PERFIL_PACIENTE = 'B';
    const ID_PERFIL_PROFISSIONAL = 'C';

    #[ORM\Id]
    #[ORM\Column(length: 1)]
    private string $id;

    #[ORM\Column(length: 20)]
    private string $descricao;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

}

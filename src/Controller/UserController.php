<?php

namespace App\Controller;

use App\Entity\User;
use App\Helper\UserFactory;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends BaseController
{
    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $repository,
        UserFactory $factory
    ) {
        parent::__construct($entityManager, $repository, $factory);
    }

    /**
     * @param user $userAtual
     * @param User $entidadeRequest
     */
    public function atualizarEntidadeExistente($userAtual, $entidadeRequest)
    {
        $userAtual->setEmail($entidadeRequest->getEmail());
        $userAtual->setPassword($entidadeRequest->getPassword());
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use App\Helper\UserFactory;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends BaseController
{
    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $repository,
        UserFactory $factory,
        ValidatorInterface $validator
    ) {
        parent::__construct($entityManager, $repository, $factory, $validator);
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

    #[Route('info-usuario-logado', methods: Request::METHOD_GET)]
    public function buscarInformacoesUsuarioLogado(): JsonResponse
    {
        /* @var User $user*/
        $user = $this->getUser();
        $user->setPassword('');
        return $this->json($user);
    }
}

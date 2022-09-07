<?php

namespace App\Controller;

use App\Helper\EntidadeFactoryInterface;
use App\Interface\BaseControllerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends AbstractController implements BaseControllerInterface
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected ObjectRepository $repository,
        protected EntidadeFactoryInterface $factory
    ) {}

    public function criar(Request $request): JsonResponse
    {
        $dadosRequest = $request->getContent();
        $entidade = $this->factory->criarEntidade($dadosRequest);

        $this->entityManager->persist($entidade);
        $this->entityManager->flush();

        return $this->json($entidade);
    }

    public function buscarUm(int $id): JsonResponse
    {
        $entidade = $this->repository->find($id);

        if (is_null($entidade)) {
            return $this->json(['erro' => "registro com id $id não existe."], Response::HTTP_NOT_FOUND);
        }

        return $this->json($entidade);
    }

    public function buscarTudo(): JsonResponse
    {
        return $this->json($this->repository->findAll());
    }

    public function deletar(int $id): JsonResponse
    {
        $entidade = $this->repository->find($id);

        if (is_null($entidade)) {
            return $this->json(['erro' => "registro com id $id não existe."], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($entidade);
        $this->entityManager->flush();

        return $this->json(['delete' => true]);
    }

    public function atualizar(int $id, Request $request): JsonResponse
    {
        $entidadeAtual = $this->repository->find($id);

        if (is_null($entidadeAtual)) {
            return $this->json(['erro' => "registro com id $id não existe."], Response::HTTP_NOT_FOUND);
        }

        $dadosRequest = $request->getContent();
        $entidadeRequest = $this->factory->criarEntidade($dadosRequest);
        $this->atualizarEntidadeExistente($entidadeAtual, $entidadeRequest);

        $this->entityManager->flush();

        return $this->json($entidadeAtual);
    }

    abstract public function atualizarEntidadeExistente($entidadeAtual, $entidadeRequest);
}

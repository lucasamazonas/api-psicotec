<?php

namespace App\Interface;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface BaseControllerInterface {
    public function criar(Request $request): JsonResponse;
    public function buscarUm(int $id): JsonResponse;
    public function buscarTudo(): JsonResponse;
    public function deletar(int $id): JsonResponse;
    public function atualizar(int $id, Request $request): JsonResponse;
}
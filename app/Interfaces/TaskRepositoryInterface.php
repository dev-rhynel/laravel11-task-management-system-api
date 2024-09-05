<?php

namespace App\Interfaces;

interface TaskRepositoryInterface
{
    public function index(array $filters, array $identifier);

    public function create(array $data);

    public function find(int $id);

    public function findByIdentifier(array $identifier);

    public function update(array $identifier, array $data);

    public function delete(array $identifier, int $id);
}

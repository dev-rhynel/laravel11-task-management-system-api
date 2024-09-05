<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function create(array $data);

    public function find($id);

    public function checkIfEmailExists(string $email);

    public function checkIfProviderIdExists(string $provider, string $providerId);

    public function update(array $identifier, array $data);

    public function setUsernameAttribute(string $firstName, string $lastName): string;
}

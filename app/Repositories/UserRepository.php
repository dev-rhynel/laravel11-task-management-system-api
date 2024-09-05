<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private function getModel(bool $useSelect = false)
    {
        if ($useSelect) {
            return User::select([
                'first_name',
                'last_name',
                'username',
                'email',
                'provider',
                'avatar',
                'is_activated',
                'bio',
                'id',
            ]);
        }

        return new User();
    }


    public function index($data = [])
    {
        $queu = $this->getModel(true)->limit(10);

        if (isset($data['sort']) && isset($data['direction'])) {
            $queu->orderBy($data['sort'], $data['direction']);
        }

        if (isset($data['filter'])) {
            $queu->orWhere('provider', $data['filter']);
        }

        if (isset($data['search'])) {
            $queu->orWhere('title', 'ilike', '%' . $data['search'] . '%');
        }

        return $queu->paginate(isset($data['per_page']) ? $data['per_page'] : 10);
    }

    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }

    public function find($id)
    {
        return $this->getModel()->find($id);
    }

    public function checkIfEmailExists(string $email)
    {
        return $this->getModel()->where('email', $email)->first();
    }

    public function checkIfProviderIdExists(string $provider, string $providerId)
    {

        return $this->getModel()->where('provider', $provider)
            ->where('provider_id', $providerId)->first();
    }

    public function update(array $identifier, array $data): User
    {
        $user = $this->getModel()
            ->where($identifier)
            ->firstOrFail();
        $user->update($data);
        return $user->refresh();
    }

    public function setUsernameAttribute(string $firstName, string $lastName): string
    {
        $username = strtolower("{$firstName}{$lastName[0]}");

        $suffix = 0;
        while ($this->getModel()->whereUsername($username)->exists()) {
            $suffix++;
            $username = "{$firstName}{$lastName[0]}{$suffix}";
        }

        return $username;
    }
}

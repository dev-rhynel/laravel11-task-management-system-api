<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

use function PHPSTORM_META\map;

class TaskRepository implements TaskRepositoryInterface
{
    private function getModel()
    {
        return new Task();
    }


    public function index(array $data, array $identifier)
    {
        $tasks = $this->getModel()->where($identifier);

        if (isset($data['sort_by']) && isset($data['sort_direction'])) {
            $tasks = $tasks->orderBy($data['sort_by'], $data['sort_direction']);
        }
        if (isset($data['filters'])) {
            $filters = collect($data['filters'])->map(function ($value, $key) {
                return [
                    'column' => $key,
                    'value' => $value,
                ];
            });

            foreach ($filters as $filter) {
                $tasks->where(
                    $filter['column'],
                    $filter['value']
                );
            }

        }

        if (isset($data['search'])) {
            $tasks = $tasks->orWhere('title', 'ilike', "%{$data['search']}%");
        }

        return $tasks->paginate($data['per_page'] ?? 10);
    }


    public function create(array $data)
    {
        $task = $this->getModel()->create($data);
        return $task->refresh();
    }


    public function find(int $id)
    {
        return $this->getModel()->findOrFail($id);
    }


    public function findByIdentifier(array $identifier)
    {
        return $this->getModel()->where($identifier)->firstOrFail();
    }


    public function update(array $identifier, array $updateData): Task
    {
        $task = $this->getModel()->where($identifier)->firstOrFail();
        $task->update($updateData);
        return $task->refresh();
    }


    public function delete(array $identifier, int $taskId): void
    {
        $task = $this->findByIdentifier($identifier);

        $task->getModel()->delete($taskId);
    }
}

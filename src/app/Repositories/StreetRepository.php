<?php


namespace App\Repositories;

use App\Models\Street;

class StreetRepository
{
    protected Street $model;

    public function __construct(Street $model)
    {
        $this->model = $model;
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->all();
    }

    public function allWithParent(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->with('city.region')->get();
    }

    public function findByQueryWithParentName(string $query): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->where('name', 'ILIKE', "%{$query}%")
            ->orWhereHas('city', function ($q) use ($query) {
                $q->where('name', 'ILIKE ', "%{$query}%")
                    ->orWhereHas('region', function ($q2) use ($query) {
                        $q2->where('name', 'ILIKE', "%{$query}%");
                    });
            })
            ->with(['city.region']) // Подгружаем связанные города и улицы
            ->get();
    }

    public function find($id): ?Street
    {
        return $this->model->find($id);
    }

    public function create(array $data): Street
    {
        return $this->model->create($data);
    }

    public function update($id, array $data): ?Street
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function delete($id): ?bool
    {
        $user = $this->model->find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}

<?php

namespace App\Repositories;

use App\Models\Region;

class RegionRepository{
    protected Region $model;
    public function __construct(Region $model){
        $this->model = $model;
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->all();
    }

    public function allWithChild(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->with('cities.streets')->get();
    }

    public function find($id) : ?Region
    {
        return $this->model->find($id);
    }

    public function create(array $data) : Region
    {
        return $this->model->create($data);
    }

    public function update($id, array $data) : ?Region
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function delete($id) : ?bool
    {
        $user = $this->model->find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}

<?php

namespace App\Repositories;

use App\Contracts\Base\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function paginate($perPage = 6, $filters = [], $search = null)
    {
        $query = $this->model->query();

        if ($search) {
            foreach ($this->model->getFillable() as $field) {
                $query->orWhere($field, 'like', "%$search%");
            }
        }

        foreach ($filters as $key => $value) {
            $query->where($key, $value);
        }

        return $query->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
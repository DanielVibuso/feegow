<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class Repository
{
    protected $model;
    /**
     * @param Model $model
     */
    //public function __construct(protected Model $model)
   // {
    //}

    /**
     * @return LengthAwarePaginator return the employees paginated
     */
    public function index(array $options): LengthAwarePaginator
    {
        return $this->model->when(isset($options['sort']), function ($query) use ($options) {
            $query->orderBy($options['sort'], $options['order'] ?? 'asc');
        })->paginate($options['perPage'] ?? 15);
    }

    /**
     * @param array $newModelData
     *
     * @return Model
     */
    public function store(array $newModelData) : Model
    {
        return $this->model->create($newModelData);
    }

    /**
     * @param array $newModelData
     *
     * @return Model
     */
    public function update(string $id,  array $newModelData) : Model
    {
        $model = $this->getItemById($id);
        $model->update($newModelData);

        return $model;
    }    
    
    /**
     * @param string $id
     *
     * @return Model
     */
    public function getItemById(string $id): Model
    {
        return $this->model->where('id', $id)->firstOrFail();
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function delete(string $id): void
    {
        $this->getItemById($id)->delete();
    }

}

<?php
namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Container\Container as App;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->app = new App();
        $this->makeModel();
    }
    
    abstract public function model();

    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new Exception('');
        }

        return $this->model = $model;
    }

    public function getAll()
    {
        $this->makeModel();

        return $this->model->all();
    }

    public function getById($id)
    {
        $this->makeModel();

        return $this->model->findOrFail($id);
    }

    public function create(array $attributes)
    {
        $this->makeModel();

        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($attributes);
        $model->save();

        return $this;
    }

    public function delete($id)
    {
        $this->makeModel();
        $this->getById($id)->delete();

        return true;
    }
}

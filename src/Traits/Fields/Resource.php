<?php


namespace Radevlabs\Bake\Traits\Fields;


use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use stdClass;

trait Resource
{
    public function resource($resource)
    {
        if (!($resource instanceof EloquentBuilder
            or $resource instanceof stdClass
            or is_array($resource)
            or $resource instanceof QueryBuilder)){
            throw new Exception('$resource must be instance of array, Collection, Illuminate\Database\Eloquent\Builder or Illuminate\Database\Query\Builder.');
        }

        $this->data['resource'] = $resource;

        if ($this->data['serverside'] ?? false){
            $this->data['resource'] = encrypt(query_statement($this->data['resource']));
        } else{
            if ($this->data['resource'] instanceof QueryBuilder
                or $this->data['resource'] instanceof EloquentBuilder){
                $this->data['resource'] = $this->data['resource']
                    ->get()
                    ->toArray();
            }

            if ($this->data['resource'][0] instanceof stdClass){
                $this->data['resource'] = collect($this->data['resource'])
                    ->map(function ($item) {
                        return (array)$item;
                    })->toArray();
            }
        }

        return $this;
    }
}

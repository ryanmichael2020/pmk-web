<?php

namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class WithTrashedScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->withTrashed();

        // remove "where deleted_at = null"
        $wheres = $builder->getQuery()->wheres;
        foreach ($wheres as $key => $data) {
            if ($data['column'] == $model->getTable() . '.deleted_at' && $data['type'] == "Null") {
                unset($builder->getQuery()->wheres[$key]);
            }
        }

        return $builder;
    }
}

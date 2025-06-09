<?php

namespace Dailyapps\SyncManager;

use Dailyapps\SyncManager\Concerns\Configurable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class SyncManager
{
    use Configurable;

    public function sync(array $data)
    {
        $modelType = Arr::pull($data, 'model_type');
        $modelClass = $this->modelClass($modelType);

        /** @var Model $model */
        $model = app($modelClass);

        foreach ($this->mapping($modelClass) as $sourceField => $targetField) {
            $model->$sourceField = $data[$targetField];
        }

        foreach ($this->relations($modelClass) as $relation) {
            $relationData = Arr::pull($data, $relation);

            if (is_null($relationData)) continue;

            $this->syncRelation($model, $relation, $relationData);
        }

        $this->beforeSynchronize($model);

        $model->save();

        $this->afterSynchronize($model);
    }

    public function syncRelation(Model $model, string $relationName, array $relationData)
    {

    }

    public function beforeSynchronize(Model $model)
    {

    }

    public function afterSynchronize(Model $model)
    {

    }
}
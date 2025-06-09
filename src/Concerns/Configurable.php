<?php

namespace Dailyapps\SyncManager\Concerns;

use Exception;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait Configurable
{
    /**
     * @throws Exception
     */
    private function configuration(string $type, ?string $key = null, mixed $default = null): mixed
    {
        $config = config('sync.models.'.$type);

        if (is_null($config)) {
            throw new NotFoundHttpException('SyncManager configuration not found');
        }

        return Arr::get($config, $key, $default);
    }

    /**
     * @throws Exception
     */
    public function modelClass(string $type): string
    {
        return $this->configuration($type, 'model');
    }

    /**
     * @throws Exception
     */
    public function mapping(string $type): array
    {
        return $this->configuration($type, 'mapping', []);
    }

    /**
     * @throws Exception
     */
    public function relations(string $type): array
    {
        return $this->configuration($type, 'relations', []);
    }
}
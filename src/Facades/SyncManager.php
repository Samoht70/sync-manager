<?php

namespace Dailyapps\SyncManager\Facades;

use Illuminate\Support\Facades\Facade;

class SyncManager extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sync-manager';
    }
}
<?php

namespace HalcyonAgile\FilamentExport\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HalcyonAgile\FilamentExport\FilamentExport
 */
class FilamentExport extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HalcyonAgile\FilamentExport\FilamentExport::class;
    }
}

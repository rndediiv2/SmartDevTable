<?php

namespace rndediiv2\SmartDevTable\Facades;

use Illuminate\Support\Facades\Facade;

class SmartDevTable extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'SmartDevTable';
    }
}
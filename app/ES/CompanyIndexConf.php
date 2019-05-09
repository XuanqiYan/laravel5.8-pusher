<?php

namespace App\ES;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class CompanyIndexConf extends IndexConfigurator
{
    use Migratable;
    protected $name = 'company';
    /**
     * @var array
     */
    protected $settings = [
        "number_of_shards"=> 5,
        "number_of_replicas"=> 1,
    ];
}
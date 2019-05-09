<?php

namespace App;

use ScoutElastic\Searchable;
use Illuminate\Database\Eloquent\Model;
use App\ES\CompanyIndexConf;

class Company extends Model
{
    use Searchable;

    /**
     * @var string
     */
    protected $indexConfigurator = CompanyIndexConf::class;

    /**
     * @var array
     */
    protected $searchRules = [
        //
    ];

    /**
     * @var array
     */
    protected $mapping = [
        "properties"=>[
            "name"=>[
                "type"=>'text',
                "analyzer"=>'ik_max_word',//定义倒叙索引分析器
                "search_analyzer"=>'ik_max_word',//定义搜索数据的分析器
                "boost"=>3,//定义name的搜索权重
                "fields"=>[
                    "raw"=>[
                        "type"=>"keyword",
                        "ignore_above"=>'256'
                    ]
                ] 
            ],
            "city"=>[
                "type"=>"keyword"    
            ],
            "vision"=>[
                "type"=>"text",
                "analyzer"=>'ik_max_word',//定义倒叙索引分析器
                "search_analyzer"=>'ik_max_word',//定义搜索数据的分析器
            ],
            "email"=>[
                "type"=>'text',
                "fields"=>[
                    "raw"=>[
                        "type"=>"keyword",
                        "ignore_above"=>'256'
                    ]
                ] 
            ],
            'phone'=>[
                'type'=>'long'
            ]


        ]

    ];

    public function searchableAs(){
        return 'company';
    }
}
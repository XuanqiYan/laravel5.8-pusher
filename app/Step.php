<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Step extends Model
{
    protected $fillable= ['name','task_id','completion'];

    public function task(){
        return $this->belongsTo('App\Task'); 
    }
}

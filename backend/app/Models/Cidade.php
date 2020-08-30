<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
 

    public function estados()
    {
        return $this->belongsTo('App\Models\Estado', 'estado_id','id');
    }

    
}

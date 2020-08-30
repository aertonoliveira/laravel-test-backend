<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imovel extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'rua',
        'numero',
        'complemento',
        'bairro',
        'email',
        'estado_id',
        'cidade_id',
        'status',
    ];

    protected $dates = ['deleted_at'];

    public function search($filter)
    {
        $grupo = $this->with('estado','cidade')->where(function ($query) use ($filter) {
            if (isset($filter['id']))
                $query->where('id', $filter['id']);

            if (isset($filter['id_user']))
                $query->where('id_user', $filter['id_user']);
        })
            ->paginate(10);

        return $grupo;
    }

    public function estado(){
        return $this->belongsTo('App\Models\Estado', 'estado_id', 'id');
    }

    public function cidade(){
        return $this->belongsTo('App\Models\Cidade', 'cidade_id', 'id');
    }

    public function contrato(){
        return $this->hasOne('App\Models\Contrato', 'imovel_id','id');
    }


}

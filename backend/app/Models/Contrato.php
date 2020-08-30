<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{

    protected $fillable = [
        'tipo_pessoa',
        'documento',
        'email',
        'nome_completo',
        'imovel_id',
    ];

    public function search($filter)
    {
        $grupo = $this->with('imovel.estado','imovel.cidade')->where(function ($query) use ($filter) {
            if (isset($filter['id']))
                $query->where('id', $filter['id']);

            if (isset($filter['id_user']))
                $query->where('id_user', $filter['id_user']);
        })
            ->paginate();

        return $grupo;
    }
    public function imovel()
    {
        return $this->belongsTo('App\Models\Imovel', 'imovel_id','id');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{

    private $repository;

    public function __construct(Cidade $cidade)
    {
        $this->repository = $cidade;
    }
    public function index($id)
    {
        return [
            'status_code' => 200,
            'data' => $this->repository->where('estado_id', $id)->get()
        ];

    }
}

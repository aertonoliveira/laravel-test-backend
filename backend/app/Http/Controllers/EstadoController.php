<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    private $repository;

    public function __construct(Estado $estado)
    {
        $this->repository = $estado;
    }
    public function index()
    {
        return [
            'status_code' => 200,
            'data' => $this->repository->all()
        ];

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContratoRequest;
use App\Models\Contrato;
use App\Models\Imovel;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    private $repository;

    public function __construct(Contrato $contrato)
    {
        $this->repository = $contrato;
    }

    public function index(Request $request)
    {
        if ($request->query()) {
            return $this->repository->search($request->query());
        } else {
            return $this->repository->with('imovel.estado', 'imovel.cidade')->orderBy('id')->paginate(10);
        }
    }

    public function store(StoreContratoRequest $request)
    {

        try {
            $contrato = Contrato::create($request->all());
            $imovel = Imovel::find($request->imovel_id);
            $imovel->status = true;
            $imovel->save();

            return [
                'status_code' => 200,
                'data' => $contrato
            ];
        } catch (\Exception $error) {
            return [
                'status_code' => 400,
                'message' => $error->getMessage()
            ];
        }
    }

    public function destroy($id)
    {
        $contrato = $this->repository->find($id);

        if (is_null($contrato)) {
            return [
                'status_code' => 400,
                'message' => 'O Contrato não existe'
            ];
        }
        $imovel = Imovel::find($contrato->imovel_id);
        $imovel->status = false;
        $imovel->save();
        $contrato->delete();

        return response()->json([], 204);
    }

    public function countContratos(){
        return [
            'status_code' => 200,
            'data' => $this->repository->all()->count()
        ];
    }


}

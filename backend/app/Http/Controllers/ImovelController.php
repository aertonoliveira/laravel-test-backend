<?php

namespace App\Http\Controllers;



use App\Http\Requests\StoreImovelRequest;
use App\Http\Requests\UpdateImovelRequest;
use App\Jobs\EnviarEmail;
use App\Models\Contrato;
use App\Models\Imovel;
use Illuminate\Http\Request;

class ImovelController extends Controller
{
    private $repository;



    public function __construct (Imovel $imovel) {
        $this->repository = $imovel;
    }

    public function index (Request $request) {
        if ($request->query()) {
            return $this->repository->search($request->query());
        } else {
            return $this->repository->with('estado','cidade')->orderBy('id')->paginate(10);
        }
    }

    public function imoveisNaoAssociados()
    {
        $imoveis = $this->repository->doesntHave('contrato')->get();

        return [
        'status_code' => 200,
        'data' => $imoveis
    ];
    }


    public function store(StoreImovelRequest $request)
    {

        try {
            $imovel = Imovel::create($request->all());

            $email = ['email' => $imovel->email];
            EnviarEmail::dispatch($email);

            return [
                'status_code' => 200,
                'data' => $imovel
            ];
        } catch (\Exception $error) {
            return [
                'status_code' => 400,
                'message' => $error->getMessage()
            ];
        }
    }

    public function update (int $id, UpdateImovelRequest $request) {
        try {
            $imovel = $this->repository->find($id);

            if (is_null($imovel)) {
                return [
                    'status_code' => 400,
                    'message' => 'O imovel não existe'
                ];
            }

            $imovel->rua = $request->rua;
            $imovel->numero = $request->numero;
            $imovel->complemento = $request->complemento;
            $imovel->bairro = $request->bairro;
            $imovel->email = $request->email;
            $imovel->estado_id = $request->estado_id;
            $imovel->cidade_id = $request->cidade_id;
            $imovel->status = $request->status;

            $imovel->save();

            return [
                'status_code' => 200,
                'data' => $request->all()
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
        $imovel = $this->repository->find($id);

        if($imovel->status){
           $contrato2 = Contrato::where('imovel_id',$imovel->id)->first();
           $contrato = new ContratoController($contrato2);
           $contrato->destroy($contrato2->id);
        }

        $imovel->delete();

        return response()->json([], 204);
    }

    public function countImoveis(){
        return [
            'status_code' => 200,
            'data' => $this->repository->all()->count()
        ];
    }
}

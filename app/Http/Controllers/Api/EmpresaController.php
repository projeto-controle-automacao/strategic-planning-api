<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Empresa;
use App\Http\Requests\EmpresaRequest;


class EmpresaController extends Controller
{
    private $empresa;
    public function __construct(Empresa $empresa)
    {
        $this->empresa = $empresa;
    }

    public function index()
    {
        $empresas = $this->empresa::all();
        return response()->json($empresas, 200);
    }


    public function store(EmpresaRequest $request)
    {
        $data = $request->all();
        try {
            $empresa = $this->empresa->create($data);

            return response()->json([
                "data" => [
                    "message" => "Empresa cadastrada com sucesso"
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    public function show($id)
    {
        try {
            $empresa = $this->empresa->findOrFail($id);
            return response()->json([
                'data' => [
                    "empresa" => $empresa
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    public function update($id, EmpresaRequest $request)
    {
        $data = $request->all();
        try {
            $empresa = $this->empresa->findOrFail($id);
            $empresa->update($data);
            return response()->json([
                'data' => [
                    "message" => 'Empresa atualizada com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    public function destroy($id)
    {
        try {
            $empresa = $this->empresa->findOrFail($id);
            $empresa->delete();
            return response()->json([
                "message" => "empresa deletada com sucesso"
            ], 204);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}

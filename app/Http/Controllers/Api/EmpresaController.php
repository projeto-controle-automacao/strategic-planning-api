<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresa;
use Symfony\Component\Mime\Message;

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


    public function store(Request $request)
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
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update($id, Request $request)
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
            return response()->json([
                'error' => $e->getMessage()
            ], 401);
        }
    }

    public function destroy($id, Request $request)
    {
        try {
            $empresa = $this->empresa->findOrFail($id);
            $empresa->delete();
            return response()->json([
                "message" => "empresa deletada com sucesso"
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 401);
        }
    }
}

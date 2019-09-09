<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Company;
use App\Http\Requests\CompanyRequest;


class CompanyController extends Controller
{
    private $company;
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function index()
    {
        $user = auth('api')->user();
        $companies = $user->companies;
        //$companies = $this->company::all();
        return response()->json($companies, 200);
    }


    public function store(CompanyRequest $request)
    {
        $data = $request->all();
        try {
            $user = auth('api')->user();
            $company = $user->companies()->create($data);

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
            $user = auth('api')->user();
            $company = $user->companies()->findOrFail($id);
            return response()->json([
                'data' => [
                    "empresa" => $company
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    public function update($id, CompanyRequest $request)
    {
        $data = $request->all();
        try {
            $user = auth('api')->user();
            $company = $user->companies()->findOrFail($id);
            $company->update($data);
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
            $user = auth('api')->user();
            $company = $user->companies()->findOrFail($id);
            $company->delete();
            return response()->json([
                "message" => "empresa deletada com sucesso"
            ], 204);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}

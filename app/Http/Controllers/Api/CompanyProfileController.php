<?php

namespace App\Http\Controllers\Api;

use App\CompanyProfile;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyProfileRequest;
use App\Api\ApiMessages;


class CompanyProfileController extends Controller
{

    private $company;
    public function __construct(Company $company)
    {
        $this->company = $company;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = auth('api')->user();
        $company = $user->companies()->findOrFail($id);

        return $company->profiles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyProfileRequest $request, $id)
    {
        $data = $request->all();

        try {
            $user = auth('api')->user();
            $company = $user->companies()->findOrFail($id);
            $company->profiles()->create($data);

            return response()->json([
                'data' => [
                    "message" => "perfil criado com sucesso"
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $profile_id)
    {
        try {
            $user = auth('api')->user();
            $company = $user->companies()->findOrFail($id);
            $companyProfile = $company->profiles()->findOrFail($profile_id);
            return response()->json([
                'data' => [
                    "perfil" => $companyProfile
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $profile_id)
    {
        $data = $request->all();

        try {
            $user = auth('api')->user();
            $company = $user->companies()->findOrFail($id);
            $companyProfile = $company->profiles()->findOrFail($profile_id);
            $companyProfile->update($data);
            return response()->json([
                'data' => [
                    "message" => 'Perfil atualizado com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $profile_id)
    {
        try {
            $user = auth('api')->user();
            $company = $user->companies()->findOrFail($id);
            $companyProfile = $company->profiles()->findOrFail($profile_id);
            $companyProfile->delete();
            return response()->json([
                "message" => "perfil deletado com sucesso"
            ], 204);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}

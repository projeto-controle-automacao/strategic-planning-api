<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubfrasesHasPillarsFields;

class SubFrases_has_Fields extends Controller
{
    public function getByPillarAndField(Request $request)
    {
        $pillar = $request->pillar;
        $field = $request->field;
        return SubfrasesHasPillarsFields::where('pillar_id', $pillar)->where('field_id', $field)->join('sub_frases', 'id', '=', 'sub_frase_id')->get('expression');
    }

    public function getByPillar(Request $request)
    {
        $pillar = $request->pillar;
        return SubfrasesHasPillarsFields::select('field_id', 'expression')->where('pillar_id', $pillar)->join('sub_frases', 'id', '=', 'sub_frase_id')->orderBy('field_id')->get();
    }

}

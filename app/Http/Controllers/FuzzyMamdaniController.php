<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\FuzzyMamdani;

class FuzzyMamdaniController extends Controller
{
    private $dir = 'fuzzy_mamdani.';

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->only(['demand', 'balance_or_deficit', 'balance_or_deficit_value']);

            if($data['balance_or_deficit'] === 'balance') {
                $data['fuzzyMamdani'] = (new FuzzyMamdani($data['demand'], $data['balance_or_deficit_value']))->meta();
            }

            elseif($data['balance_or_deficit'] === 'deficit') {
                $data['fuzzyMamdani'] = (new FuzzyMamdani($data['demand'], 0, $data['balance_or_deficit_value']))->meta();
            }

            return view($this->dir.'index', $data);
        } else {
            return view($this->dir.'index');
        }
    }
}

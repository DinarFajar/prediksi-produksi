<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data['company'] = Company::first();

        return view('home', $data);
    }

    public function edit()
    {
        $data['company'] = Company::first();

        return view('edit_about', $data);
    }
}

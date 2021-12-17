<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\CompanyRequest;

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

    public function update(CompanyRequest $request) 
    {
        $data = $request->validated();

        if(Company::exists()) {
            Company::where('id', 1)->update($data);
        } else {
            Company::create($data);
        }

        return redirect()
            ->route('home')
            ->with('success', 'Tentang Kami berhasil diperbarui');
    }
}

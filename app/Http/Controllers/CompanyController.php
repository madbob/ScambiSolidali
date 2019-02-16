<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;

use App\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function fromRequest($company, $request)
    {
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->phone = $request->input('phone');
        $company->website = normalizeUrl($request->input('website'));
        $company->donation_frequency = $request->input('donation_frequency');
        $company->address = $request->input('address');
        $coordinates = explode(',', $request->input('coordinates'));
        $company->lat = $coordinates[0];
        $company->lng = $coordinates[1];
        return $company;
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'coordinates' => 'required|max:255',
        ]);

        $company = new Company();
        $company = $this->fromRequest($company, $request);
        $company->save();

        Session::flash('message', 'Nuova azieda salvata');
        return redirect(url('giocatori'));
    }

    public function show($id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $company = Company::find($id);
        return view('company.modal', ['company' => $company]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'coordinates' => 'required|max:255',
        ]);

        $company = Company::find($id);
        $company = $this->fromRequest($company, $request);
        $company->save();

        Session::flash('message', 'Azienda salvato');
        return redirect(url('giocatori'));
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $company = Company::find($id);
        $company->users()->sync([]);
        $company->delete();

        Session::flash('message', 'Azienda eliminata');
        return redirect(url('giocatori'));
    }
}

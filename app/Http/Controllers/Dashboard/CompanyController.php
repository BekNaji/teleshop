<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Company;
use Auth;

class CompanyController extends Controller
{
    # companies list page
    public function index(Request $request)
    {
        $companies = Company::all();

        return view('dashboard.company.index',compact('companies'));
    }

    # company create page
    public function create(Request $request)
    {
        return view('dashboard.company.create');
    }

    # company create page
    public function edit(Request $request)
    {
        $company = Company::find($request->id);

        return view('dashboard.company.edit',compact('company'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(),
        [
            'name' => 'required|unique:companies|min:3|max:255',
        ])->validate();

        $company            = new Company();
        $company->status    = $request->status;
        $company->name      = $request->name;
        $company->save();

        return redirect()->route('company.index')->with(['message'=>'Stored!']);
    }

    public function update(Request $request)
    {
        Validator::make($request->all(),
        [
            'name' => 'required|min:3|max:255|unique:companies,name,'.$request->id,
        ])->validate();

        $company            = Company::find($request->id);
        $company->status    = $request->status;
        $company->name      = $request->name;
        $company->save();

        return redirect()->route('company.index')->with(['message'=>'Updated!']);
    }

    public function remove(Request $request)
    {
        $company = Company::find($request->id);

        $company->delete();
        return back()->with(['message'=>'Deleted!']);
    }

    // settings edit

    public function settingsEdit()
    {
        $user = Auth::user();
        return view('dashboard.company.settings',compact('user'));
    }

    public function settingsUpdate(Request $request)
    {
        $company = Company::find(Auth::user()->company->id);
        $company->product_row = $request->product_row;
        $company->product_page = $request->product_page;
        $company->dollr = $request->dollr;
        $company->save();
        return back()->with(['message'=>'Updated']);
        
    }
}

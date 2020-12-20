<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    # users list page
    public function index()
    {
        $users = User::all();

        return view('dashboard.user.index',compact('users'));
    }

    # user create page
    public function create()
    {
        $companies = Company::all();

        return view('dashboard.user.create',compact('companies'));
    }

    # user edit page
    public function edit(Request $request)
    {
        $user = User::find($request->id);

        $companies = Company::all();

        return view('dashboard.user.edit',compact('user','companies'));
    }

    # user store function
    public function store(Request $request)
    {
        Validator::make($request->all(),
        [
            'name'  => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:20',
        ])->validate();
        
        $user          = new User();
        $user->role     = $request->role;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->company_id = $request->company_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.index')->with(['message'=>'Saved!']);
    }

    # user update function
    public function update(Request $request)
    {
        Validator::make($request->all(),
        [
            'name'  => 'required',
            'email' => 'required|unique:users,email,'.$request->id, // update unique email
        ])->validate();
        
        $user           = User::find($request->id);
        $user->role     = $request->role;
        $user->name     = $request->name;
        $user->company_id = $request->company_id;   
        $user->email    = $request->email;
        if($request->password != '')
        {
            Validator::make($request->all(),
            [
                'password' => 'required|min:6|max:20'
            ]);
            $user->password = Hash::make($request->password);
        }

        
        $user->save();

        return redirect()->route('user.index')->with(['message'=>'Updated!']);
    }

    # user remove function
    public function remove(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        return redirect()->route('user.index')->with(['message'=>'Deleted!']);
    }
}

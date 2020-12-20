<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        //dd(Carbon::now()->startOfMonth()->format('d-m-Y'));
        return view('dashboard.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\AddSchedule;

class DashboardController extends Controller
{
   public function index()
{
    $matkul = MataKuliah::all();
    
    $schedules = AddSchedule::where('user_id', auth()->id())
        ->orderBy('time', 'asc')
        ->get();

    return view('dashboard', compact('matkul', 'schedules'));
}

}

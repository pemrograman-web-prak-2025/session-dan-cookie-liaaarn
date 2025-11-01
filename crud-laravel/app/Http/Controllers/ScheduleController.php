<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddSchedule;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function create()
    {
        return view('addSchedule');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);

        AddSchedule::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'time' => $request->time,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Schedule added!');
    }

    public function markAsDone($id)
    {
        $schedule = AddSchedule::findOrFail($id);

        History::create([
            'user_id' => $schedule->user_id,
            'datetime' => now(),
            'title' => $schedule->title,
            'description' => $schedule->description,
        ]);

        $schedule->delete();

        return redirect()->route('dashboard')->with('success', 'Task marked as done!');
    }
}

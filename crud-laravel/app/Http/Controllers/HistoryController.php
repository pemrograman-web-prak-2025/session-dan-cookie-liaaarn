<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::where('user_id', Auth::id())
            ->orderBy('datetime', 'desc')
            ->get();

        return view('history', compact('histories'));
    }

    public function destroy($id)
    {
        $history = History::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $history->delete();

        return redirect()->route('history')->with('success', 'History deleted!');
    }
}

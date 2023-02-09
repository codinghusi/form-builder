<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        $entries = User::find(auth()->id())->entries;
        return view('dashboard', [
            'entries' => $entries
        ]);
    }
}

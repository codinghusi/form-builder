<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Common\FormText;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        $forms = User::find(auth()->id())->forms->sortByDesc('updated_at');
        return view('dashboard', [
            'forms' => $forms
        ]);
    }
}

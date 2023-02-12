<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EntryController extends Controller
{
    private function validateForm(Request $request, ?string $id = null): array {
        return $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique('papers')
                    ->ignore($id)
                    ->where(function ($query) {
                        return $query->where('user_id', Auth::id());
                    })
            ],
            'description' => 'max:65535',
        ]);
    }

    public function createForm(): View {
        return view('papers.form', ['mode' => 'create']);
    }

    public function createPost(Request $request): View | RedirectResponse {
        $validated = $this->validateForm($request);

        if ($validated) {
            $entry = new Paper();
            $entry->title = $request->input('title');
            $entry->description = $request->input('description');
            $entry->user_id = Auth::id();
            $entry->save();
            return redirect()->route('entry.view', ['id' => $entry->id]);
        }
        return view('papers.form', (object) ['mode' => 'create']);
    }

    public function viewForm(Request $request, string $id): View {
        $entry = Paper::find($id);
        if (!$entry) {
            abort(404);
        }
        $entry->mode = $entry->user_id == auth()->id() ? "update" : "view";
        return view('papers.form', $entry);
    }

    public function viewUpdate(Request $request, string $id): View {
        $entry = Paper::find($id);
        if (!$entry) {
            abort(404);
        } else if ($entry->user_id != auth()->id()) {
            abort(403);
        }
        $validated = $this->validateForm($request, $id);

        if ($validated) {
            $entry->title = $request->input('title');
            $entry->description = $request->input('description');
            $entry->save();
            $entry->mode = "update";
            return view('papers.form', $entry);
        }
        $entry->mode = "update";
        return view('papers.form', $entry);
    }

    public function delete(Request $request, string $id): RedirectResponse {
        $entry = Paper::find($id);
        if (!$entry) {
            abort(404);
        } else if ($entry->user_id != auth()->id()) {
            abort(403);
        }
        $entry->delete();
        return redirect()->to('dashboard');
    }

    public function pdf(Request $request, string $id) {
        $entry = Paper::find($id);
        if (!$entry) {
            abort(404);
        }
        $pdf = Pdf::loadView('papers.pdf', $entry->toArray());
        $name = date("d.m.Y") . ' - ' . preg_replace('/[^\wäöüß]/i', '_', strtolower($entry->title));
        return $pdf->download($name . '.pdf');
    }
}

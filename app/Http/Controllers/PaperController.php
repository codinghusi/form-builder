<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Paper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PaperController extends Controller
{
    private function validateForm(Request $request, ?string $id = null, ?string $form_id = null): array {
        return $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique('papers')
                    ->ignore($id)
                    ->where(function ($query) use ($form_id) {
                        return $query->where('form_id', $form_id);
                    })
            ]
        ]);
    }

    public function createView(Request $request, string $form_id): View {
        $form = Form::find($form_id);
        if (!$form) {
            abort(404);
        }
        return view('papers.form', [
            'mode' => 'create',
            "form_id" => $form_id,
            "form" => $form
        ]);
    }

    public function create(Request $request, string $form_id): View | RedirectResponse {
        $validated = $this->validateForm($request, null, $form_id);

        $form = Form::find($form_id);

        if (Auth::id() != $form->user_id) {
            $form = $form->replicate();
            $form->user_id = Auth::id();
        }

        if ($validated) {
            $paper = new Paper();
            $paper->title = $request->input('title');
            $paper->values = $request->input('values');
            $paper->form_id = $form->id;
            $paper->save();
            return redirect()->route('paper.view', ['id' => $paper->id]);
        }
        return view('papers.form', (object) ['mode' => 'create']);
    }

    public function view(Request $request, string $id) {
        $paper = Paper::find($id);
        if (!$paper) {
            abort(404);
        }
        $mode = $paper->form->user_id == auth()->id() ? "update" : "view";
        return view('papers.form', [
            'paper' => $paper,
            'mode' => $mode
        ]);
    }

    public function update(Request $request, string $id): View {
        $paper = Paper::find($id);
        if (!$paper) {
            abort(404);
        } else if ($paper->form->user_id != auth()->id()) {
            abort(403);
        }
        $validated = $this->validateForm($request, $id, $paper->form_id);

        if ($validated) {
            $paper->title = $request->input('title');
            $paper->values = $request->input('values');
            $paper->save();
            $mode = "update";
            return view('papers.form', [
                'paper' => $paper,
                'mode' => $mode
            ]);
        }
        $mode = "update";
        return view('papers.form', [
            'paper' => $paper,
            'mode' => $mode
        ]);
    }

    public function delete(Request $request, string $id): RedirectResponse {
        $paper = Paper::find($id);
        if (!$paper) {
            abort(404);
        } else if ($paper->form->user_id != auth()->id()) {
            abort(403);
        }
        $paper->delete();
        return redirect()->to('form.papers', ['id' => $paper->form_id]);
    }

    public function pdf(Request $request, string $id) {
        $paper = Paper::find($id);
        if (!$paper) {
            abort(404);
        }
        $pdf = Pdf::loadView('papers.pdf', [
            'paper' => $paper,
            'mode' => 'pdf'
        ]);
        $name = $paper->updated_at->format("d.m.Y") . ' - ' . preg_replace('/[^\wäöüß]/i', '_', strtolower($paper->title));
        return $pdf->download($name . '.pdf');
    }
}

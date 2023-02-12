<?php

namespace App\Http\Controllers;

use App\Common\FormText;
use App\Models\Paper;
use App\Models\Form;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FormController extends Controller
{
    private function validateForm(Request $request, ?string $id = null): array {
        return $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('forms')
                    ->ignore($id)
                    ->where(function ($query) {
                        return $query->where('user_id', Auth::id());
                    })
            ],
            'description' => 'max:65535',
            'form_text' => 'required|max:65535'
        ]);
    }

    public function createForm(Request $request): View {
        return view('forms.form', [
            'mode' => 'create',
            'parsedFromText' => FormText::parse($request->input('form_text') ?? '')
        ]);
    }

    public function papers(Request $request, string $id): View {
        $form = Form::find($id);
        if (!$form) {
            abort(404);
        }
        $papers = $form->papers->sortByDesc('updated_at');
        return view('forms.papers', ['papers' => $papers, 'id' => $id]);
    }

    public function createPost(Request $request): View | RedirectResponse {
        $validated = $this->validateForm($request);

        if ($validated) {
            $form = new Form();
            $form->name = $request->input('name');
            $form->description = $request->input('description');
            $form->form_text = $request->input('form_text');
            $form->user_id = Auth::id();
            // FIXME: add count column
            $form->save();
            return redirect()->route('form.view', [ 'id' => $form->id ]);
        }
        return view('forms.form', (object) [
            'mode' => 'create',
            'parsedFromText' => FormText::parse($request->input('form_text'))
        ]);
    }

    public function viewForm(Request $request, string $id) {
        $form = Form::find($id);
        if (!$form) {
            abort(404);
        }
        $form->mode = $form->user_id == auth()->id() ? "update" : "view";
        $form->parsedFormText = $form->parsed;
        return view('forms.form', $form);
    }

    public function viewUpdate(Request $request, string $id): View {
        $form = Form::find($id);
        if (!$form) {
            abort(404);
        } else if ($form->user_id != auth()->id()) {
            abort(403);
        }
        $validated = $this->validateForm($request, $id);

        if ($validated) {
            $form->name = $request->input('name');
            $form->description = $request->input('description');
            $form->form_text = $request->input('form_text');
            $form->save();

            $form->mode = "update";
            $form->parsedFormText = $form->parsed;
            return view('forms.form', $form);
        }
        $form->mode = "update";
        $form->parsedFormText = $form->parsed;
        return view('forms.form', $form);
    }

    public function delete(Request $request, string $id): RedirectResponse {
        $form = Form::find($id);
        if (!$form) {
            abort(404);
        } else if ($form->user_id != auth()->id()) {
            abort(403);
        }
        $form->delete();
        return redirect()->to('dashboard');
    }

    public function pdf(Request $request, string $id) {
        $form = Form::find($id);
        if (!$form) {
            abort(404);
        }
        $pdf = Pdf::loadView('papers.pdf', $form->toArray());
        $name = date("d.m.Y") . ' - ' . preg_replace('/[^\wäöüß]/i', '_', strtolower($form->title));
        return $pdf->download($name . '.pdf');
    }
}

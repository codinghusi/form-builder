@props([
    'mode' => 'view',
    'paper',
    'form' => null,
    'form_id'
])

@php
    if (!in_array($mode, ['view', 'update', 'create'])) {
        abort(500);
    }

    $page = [
        'title' => __("paper.$mode.header"),
        'description' => __("paper.$mode.description"),
        'saveText' => __("paper.form.$mode"),
        'deleteText' => __("paper.form.delete"),
        'copyText' => __("paper.form.copy"),
        'download' => __("paper.form.download"),
    ];

    if (isset($paper)) {
        $id = $paper->id;
        $title = $paper->title;
        $values = $paper->values;
        $parsed = $paper->parsed;
        $form_id = $paper->form_id;
    } else {
        $id = null;
        $title = '';
        $values = [];
        $parsed = [];
        $parsed = $form->parsed;
    }

@endphp

<x-app-layout>
    <x-slot name="title">
        {{ $page['title'] }}
    </x-slot>

    <x-slot name="controls">
        @if ($mode != 'create')
            <x-secondary-button tag="a" :href="route('paper.pdf-download', ['id' => $id])">
                @svg('uiw-file-pdf', 'h-6 w-9')
                {{ $page['download'] }}
            </x-secondary-button>
        @endif
        <x-secondary-button tag="a" target="_blank" :href="route('form.view', ['id' => $form_id])">
            Zum Formular
        </x-secondary-button>
        <x-secondary-button tag="a" :href="route('form.papers', ['id' => $form_id])">
            Zur Liste
        </x-secondary-button>
    </x-slot>

    <x-slot name="content">
        <x-forms :title="$page['title']" :description="$page['description']">
            <input type="hidden" value="{{$id}}" name="id" />
            <x-forms.input name="title" :label="__('paper.form.title')" :value="$title" required />

            @include('papers.paper',  [ 'parsed' => $parsed, 'values' => $values ])

            <div class="flex justify-end gap-1">
                @switch ($mode)
                    @case ('update')
                        <x-danger-button type="submit" :formaction="route('paper.delete', ['id'=>$id])" onclick="if (!confirm('Wirklich löschen?')) event.preventDefault()">
                            {{ $page['deleteText'] }}
                        </x-danger-button>
                    @case ('create')
                        <x-primary-button>
                            {{ $page['saveText'] }}
                        </x-primary-button>
                        @break
                    @case ('view')
                        <x-primary-button type="submit" :formaction="route('paper.create', ['id'=>$id])">
                            {{ $page['copyText'] }}
                        </x-primary-button>
                    @break
                @endswitch
            </div>

        </x-forms>
    </x-slot>
</x-app-layout>


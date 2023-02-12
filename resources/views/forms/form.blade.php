@props([
    'id' => null,
    'name' => '',
    'description' => '',
    'mode' => 'view',
    'form_text' => '',
    'parsedFormText' => [],
    'values' => []
])

@php
    if (!in_array($mode, ['view', 'update', 'create'])) {
        abort(500);
    }

    $page = [
        'title' => __("form.$mode.header"),
        'description' => __("form.$mode.description"),
        'saveText' => __("form.form.$mode"),
        'deleteText' => __("form.form.delete"),
        'copyText' => __("form.form.copy"),
    ];
@endphp

<x-app-layout>
    <x-slot name="title">
        {{ $page['title'] }}
    </x-slot>

    <x-slot name="controls">
        <x-secondary-button tag="a" :href="route('dashboard')">
            Zur Liste
        </x-secondary-button>
    </x-slot>

    <x-page-card>
        <x-forms :title="$page['title']" :description="$page['description']">
            <input type="hidden" value="{{$id}}" name="id"/>
            <x-forms.input name="name" :label="__('form.form.name')" :value="$name" required/>
            <x-forms.input name="description" type="textarea" :label="__('form.form.description')"
                           :value="$description"/>
            <x-forms.input name="form_text" type="textarea" :label="__('form.form.form_text')" rows="10"
                           :value="$form_text" required/>

            {{-- Buttons --}}
            <div class="flex justify-end gap-1">
                @switch ($mode)
                    @case ('update')
                        <x-danger-button type="submit" :formaction="route('form.delete', ['id'=>$id])"
                                         onclick="if (!confirm('Wirklich löschen?')) event.preventDefault()">
                            {{ $page['deleteText'] }}
                        </x-danger-button>
                    @case ('create')
                        <x-primary-button>
                            {{ $page['saveText'] }}
                        </x-primary-button>
                        @break
                    @case ('view')
                        <x-primary-button :formaction="route('form.create', ['id'=>$id])">
                            {{ $page['copyText'] }}
                        </x-primary-button>
                        @break
                @endswitch
            </div>

        </x-forms>
    </x-page-card>

    {{-- Preview--}}
    @if (count($parsedFormText) > 0)
        <x-page-card class="mb-10">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4"> {{__('form.form.preview')}} </h2>
            @include('papers.paper', ['parsed' => $parsedFormText, 'mode' => 'disabled'])
        </x-page-card>
    @endif
</x-app-layout>


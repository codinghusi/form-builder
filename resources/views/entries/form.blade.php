@php
    $id ??= null;
    $title ??= '';
    $description ??= '';
    $id ??= '';
    $mode ??= 'view';

    if (!in_array($mode, ['view', 'update', 'create'])) {
        abort(500);
    }

    $page = [
        'title' => __("entry.$mode.header"),
        'description' => __("entry.$mode.description"),
        'saveText' => __("entry.form.$mode"),
        'deleteText' => __("entry.form.delete"),
        'copyText' => __("entry.form.copy"),
    ];
@endphp

<x-app-layout>
    <x-slot name="title">
        {{ $page['title'] }}
    </x-slot>

    <x-slot name="content">
        <x-forms :title="$page['title']" :description="$page['description']">
            <input type="hidden" value="{{$id}}" name="id" />
            <x-forms.input name="title" :label="__('entry.form.title')" :value="$title" required/>
            <x-forms.input name="description" type="textarea" :label="__('entry.form.description')"
                           :value="$description"/>

                <div class="flex justify-end gap-1">
                    @switch ($mode)
                        @case ('update')
                            <x-danger-button type="submit" :formaction="route('entry.delete', ['id'=>$id])" onclick="if (!confirm('Wirklich löschen?')) event.preventDefault()">
                                {{ $page['deleteText'] }}
                            </x-danger-button>
                        @case ('create')
                            <x-primary-button>
                                {{ $page['saveText'] }}
                            </x-primary-button>
                            @break
                        @case ('view')
                            <x-primary-button :formaction="route('entry.create', ['id'=>$id])">
                                {{ $page['copyText'] }}
                            </x-primary-button>
                        @break
                    @endswitch
                </div>

        </x-forms>
    </x-slot>
</x-app-layout>


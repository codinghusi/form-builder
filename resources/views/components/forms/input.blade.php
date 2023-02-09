@props([
    'disabled' => false,
    'required' => false,
    'autofocus' => false,
    'type' => 'text',
    'value' => '',
    'action' => '',
    'attributes' => '',
    'name',
    'label'
])

@php
    $attrs = [];
    if ($autofocus) {
        $attrs[] = "autofocus";
    }
    if ($required) {
        $attrs[] = "required";
    }
    $attributes = $attributes->merge($attrs);
@endphp

<div>
    <x-input-label :for="$name" :value="$label . ($required ? '*' : '')" />
    @switch($type)
        @case('text')
            <x-text-input {{ $attributes }} :id="$name" :disabled="$disabled" :name="$name" :type="$type" class="mt-1 block w-full" :value="old($name, $value)" :required="$required" :autofocus="$autofocus" :autocomplete="$name" />
            @break
        @case('textarea')
            <textarea {{ $disabled ? 'disabled' : '' }} class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                      {{ $attributes }} name="{{$name}}" id="{{$name}}">{{
                old($name, $value)
            }}</textarea>
            @break
    @endswitch
    <x-input-error class="mt-2" :messages="$errors->get($name)" />
</div>

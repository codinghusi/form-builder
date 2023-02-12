@props([
    'type' => 'text',
    'value' => '',
    'action' => '',
    'attributes' => '',
    'name',
    'label',
    'required' => false
])

<div>
    <x-input-label :for="$name" :value="$label . ($required ? '*' : '')" />
    @switch($type)
        @case('text')
            <x-text-input {{ $attributes->merge(['class' => 'mt-1 block w-full']) }} :id="$name" :name="$name" :type="$type" :value="old($name, $value)" :autocomplete="$name" />
            @break
        @case('textarea')
            <textarea {{ $attributes->merge(["class" => 'mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm' ]) }} name="{{$name}}" id="{{$name}}">{{
                old($name, $value)
            }}</textarea>
            @break
    @endswitch
    <x-input-error class="mt-2" :messages="$errors->get($name)" />
</div>

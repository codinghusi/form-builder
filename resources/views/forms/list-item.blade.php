@props([
    'name',
    'id'
])

<li class="list-entry">
    <a class="flex gap-2 flex-1 py-6" href="{{ route('form.papers', [ 'id' => $id ]) }}">
        @svg('uiw-document', 'h-6 w-9')
        {{ $name }}
    </a>

    <a href="{{ route('form.view', [ 'id' => $id ]) }}" class="py-6">
        @svg('uiw-edit', 'h-6 w-9')
    </a>
</li>



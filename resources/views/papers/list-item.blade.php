

<li class="list-entry">
    <a class="flex gap-2 flex-1 py-6" href="{{ route('paper.view', [ 'id' => $id ]) }}">
        @svg('uiw-file-text', 'h-6 w-9')
        {{ $title }}
    </a>

    <a href="{{ route('paper.pdf-download', [ 'id' => $id ]) }}" class="py-6">
        @svg('uiw-file-pdf', 'h-6 w-9')
    </a>
</li>



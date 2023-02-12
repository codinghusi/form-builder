<a {!! $attributes->merge(['class' => 'flex gap-1 rounded bg-green-700 px-4 py-2 pl-3 font-bold']) !!}>
    @svg('uiw-plus-square-o', 'h-6 w-9')
    {{ $slot }}
</a>

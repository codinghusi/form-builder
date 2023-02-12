@props([
    'parsed' => [],
    'mode' => 'disabled',
    'values' => []
])

<div class="markdown">
    @php $i = 0 @endphp
    @foreach ($parsed as $key=>$part)
        @if ($key === 'count')
            @continue
        @endif



        @if ($mode == 'pdf')
            @php
                $value = $values[$i] ?? '<ausgelassen>';
            @endphp
            @switch ($part['type'])
                @case('plain')
                    {!! $part['value'] !!}
                    @break

                @case('text')
                    <span class="text">{{ old("values[$i]", $value) }}</span>
                    @break

                @case('freitext')
                    <div class="text">{{ old("values[$i]", $value) }}</div>
                    @break

                @case('table')
                    TABLE
                    @break
            @endswitch
        @else
            @php
                $value = $values[$i] ?? '';
            @endphp
            @switch ($part['type'])
                @case('plain')
                    {!! $part['value'] !!}
                    @break

                @case('text')
                        <x-text-input
                            {{ $attributes->merge([ 'class' => 'mx-1', 'disabled' => $mode == 'disabled' ]) }}
                            type="text"
                            name="values[]"
                            :value='old("values[$i]", $value)'
                            :size="$part['value']" />
                    @break

                @case('freitext')
                    <textarea
                        {!! $attributes->merge([
                            'disabled' => $mode == 'disabled',
                            'class' => "block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"]) !!}>{{
                        old("values[$i]", $value)
                    }}</textarea>
                    @break

                @case('table')
                    TABLE
                    @break
            @endswitch
        @endif
        @if ($part['type'] != 'plain')
            @php $i += 1 @endphp
        @endif
    @endforeach
</div>

@props([
    'parsed' => [],
    'mode' => 'disabled',
    'values' => []
])

<div class="markdown">
    @php
        $i = 0;
        $resize = $mode === 'disabled' ? 'resize-none' : '';
    @endphp
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
                    <table>
                        <tbody>
                            @foreach ($part['value'] as $row)
                                <tr>
                                    @foreach ($row as $cell)
                                        <th>{{ $cell }}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach ($row as $cell)
                                        <td>
                                            {{ old("values[$i]", $values[$i++] ?? '') }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                            {!! $attributes->merge([
                                'class' => "$resize mx-1",
                                'disabled' => ($mode === 'disabled'),
                             ]) !!}
                            type="text"
                            name="values[]"
                            :value='old("values[$i]", $value)'
                            :size="$part['value']" />
                    @break

                @case('freitext')
                    <textarea
                        {!! $attributes->merge([
                                'class' => "$resize block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm",
                                'disabled' => $mode === 'disabled',
                            ])
                        !!}>{{
                        old("values[$i]", $value)
                    }}</textarea>
                    @break

                @case('table')
                        <table class="w-full table-fixed">
                            <tbody>
                            @foreach ($part['value'] as $row)
                                <tr>
                                    @foreach ($row as $cell)
                                        <th>{{ $cell }}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach ($row as $cell)
                                        <td>
                                            <textarea name="values[]"
                                            {!!
                                                $attributes->merge([
                                                    'class' => "$resize w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm",
                                                    'disabled' => $mode === 'disabled'
                                                ])
                                            !!}>{{
                                                old("values[$i]", $values[$i++] ?? '')
                                            }}</textarea>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @break
            @endswitch
        @endif
        @if ($part['type'] != 'plain')
            @php $i += 1 @endphp
        @endif
    @endforeach
</div>

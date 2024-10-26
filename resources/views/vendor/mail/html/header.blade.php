@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                {{-- <img src="{{ asset('assets/img/events-3.jpg') }}" class="logo" alt="Laravel Logo"> --}}
                <img src="https://bmw.astra.co.id/wp-content/uploads/2023/07/BMW.svg_-300x300.png" class="logo"
                    alt="Laravel Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>

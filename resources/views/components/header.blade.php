@php
    use App\Helpers\BreadcrumbHelper;
    $breadcrumb = BreadcrumbHelper::generate();
@endphp

<div class="fixed top-0 z-20 w-full bg-white shadow-sm">
    <div class="container mx-auto ml-70 flex items-center overflow-x-auto py-4 pl-3 whitespace-nowrap">
        @foreach ($breadcrumb as $index => $item)
            @if ($index === 0)
                {{-- Home icon --}}
                @if ($item['clickable'] ?? false)
                    <a
                        href="{{ $item['url'] }}"
                        class="cursor-pointer text-sm text-gray-600 transition-colors duration-200 hover:text-blue-600"
                    >
                        {!! $item['title'] !!}
                    </a>
                @else
                    <span class="text-sm text-gray-600">{!! $item['title'] !!}</span>
                @endif
            @else
                <span class="mx-3 text-sm text-gray-500">/</span>

                @if ($item['clickable'] ?? false)
                    {{-- Page yang bisa diklik --}}
                    <a
                        href="{{ $item['url'] }}"
                        class="cursor-pointer text-sm text-gray-500 transition-colors duration-200 hover:text-blue-600"
                    >
                        {{ $item['title'] }}
                    </a>
                @else
                    {{-- Page yang tidak bisa diklik (termasuk halaman aktif) --}}
                    <span class="text-sm text-gray-500">{{ $item['title'] }}</span>
                @endif
            @endif
        @endforeach
    </div>
</div>

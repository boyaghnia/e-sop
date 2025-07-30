@php
    use App\Helpers\BreadcrumbHelper;
    $breadcrumb = BreadcrumbHelper::generate();
@endphp

<div class="fixed top-0 z-20 w-full bg-white shadow-sm">
    <div class="container mx-auto ml-70 flex items-center overflow-x-auto py-4 pl-3 whitespace-nowrap">
        @foreach ($breadcrumb as $index => $item)
            @if ($index === 0)
                <a href="{{ $item['url'] }}" class="text-gray-600 hover:text-blue-600">
                    {!! $item['title'] !!}
                </a>
            @else
                <span class="mx-4 text-gray-500">/</span>

                @if ($index !== count($breadcrumb) - 1)
                    {{-- <a href="{{ $item['url'] }}" class="text-gray-500 hover:text-blue-600">{{ $item['title'] }}</a> --}}
                    <span class="font-medium text-gray-500">{{ $item['title'] }}</span>
                @else
                    <span class="font-medium text-gray-500">{{ $item['title'] }}</span>
                @endif
            @endif
        @endforeach
    </div>
</div>

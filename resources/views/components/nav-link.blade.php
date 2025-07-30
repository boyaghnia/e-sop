@props(['active' => false])

<a
    {{ $attributes }}
    @class([
        'mt-2 flex transform items-center rounded-lg px-3 py-2 transition-colors duration-300',
        $active
            ? 'animate-expand-border rounded-l-none border-l-4 border-yellow-400 text-gray-200 hover:bg-gray-800 hover:text-gray-200'
            : 'text-gray-200 hover:bg-gray-800 hover:text-gray-200',
        'aria-current' => $active ? 'page' : false,
    ])
>
    {{ $slot }}
</a>

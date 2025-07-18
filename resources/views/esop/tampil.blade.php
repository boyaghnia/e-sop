<x-layout>
    <div class="mt-1 mb-3 flex w-full items-center justify-between pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800">Data SOP</h3>
            <p class="text-sm text-slate-600">Direktorat Jenderal Perhubungan Udara</p>
        </div>
        <div class="ml-3">
            <div class="relative w-full max-w-sm min-w-[200px]">
                <div class="relative w-80">
                    <input
                        id="searchInputDashboard"
                        class="ease h-10 w-full rounded border border-slate-200 bg-white py-2 pr-11 pl-3 text-sm text-slate-700 shadow-sm transition duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-slate-400 focus:shadow-md focus:outline-none"
                        placeholder="Search..."
                        type="text"
                    />
                    <button
                        class="absolute top-1 right-1 my-auto flex h-8 w-8 items-center rounded bg-white px-2"
                        type="button"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="3"
                            stroke="currentColor"
                            class="h-8 w-8 text-slate-600"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan x-data untuk modal -->
    <div
        class="relative mb-5 flex w-full flex-col overflow-scroll rounded-sm bg-white bg-clip-border text-gray-700 shadow-sm"
    >
        <table class="w-full table-auto text-left">
            <thead>
                <tr>
                    <th class="border-b border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                        <p class="text-sm leading-none text-slate-600">ID</p>
                    </th>
                    <th class="border-b border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                        <p class="text-sm leading-none text-slate-600">Unit Organisasi</p>
                    </th>
                    <th class="border-b border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                        <p class="text-sm leading-none text-slate-600">Nama SOP</p>
                    </th>
                    <th class="border-b border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                        <p class="text-sm leading-none text-slate-600">Tanggal Pembuatan</p>
                    </th>
                    <th class="border-b border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                        <p class="text-sm leading-none text-slate-600">Status</p>
                    </th>
                    <th class="border-b border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                        <p class="text-sm leading-none text-slate-600">Aksi</p>
                    </th>
                </tr>
            </thead>
            <tbody class="tableBodyDashboard">
                @foreach ($esops as $index => $esop)
                    <tr class="tr_pegawai border-b border-slate-200 hover:bg-slate-50">
                        <td class="p-4 py-5">
                            <p class="block text-sm font-semibold text-slate-800">
                                {{ $index + 1 }}
                            </p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-600">{{ $esop->user->name ?? '-' }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-600">{{ $esop->nama_sop }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-600">{{ $esop->created_at->format('d-m-Y') }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-600"></p>
                        </td>
                        <td class="p-4 py-5">
                            <div class="flex flex-row items-center space-x-2">
                                <a href="{{ route('esop.edit', ['id' => $esop->id]) }}">
                                    <button
                                        class="cursor-pointer rounded-sm bg-blue-500 px-2 py-2 text-xs font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="size-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                                            />
                                        </svg>
                                    </button>
                                </a>
                                <form
                                    action="{{ route('esop.delete', ['id' => $esop->id]) }}"
                                    method="POST"
                                    class="delete-esop-form"
                                    data-nama="{{ $esop->nama_sop }}"
                                    style="display: inline"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="button"
                                        class="btn-delete-esop cursor-pointer rounded-sm bg-red-500 px-2 py-2 text-xs font-semibold text-white shadow-sm hover:bg-red-400"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="size-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21
                c.342.052.682.107 1.022.166m-1.022-.165L18.16
                19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25
                2.25 0 0 1-2.244-2.077L4.772 5.79m14.456
                0a48.108 48.108 0 0 0-3.478-.397m-12
                .562c.34-.059.68-.114 1.022-.165m0
                0a48.11 48.11 0 0 1 3.478-.397m7.5
                0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964
                51.964 0 0 0-3.32 0c-1.18.037-2.09
                1.022-2.09 2.201v.916m7.5 0a48.667
                48.667 0 0 0-7.5 0"
                                            />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    {{--
                        @empty
                        <tr>
                        <td colspan="6" class="p-4 text-center text-sm text-slate-600">Tidak ada data pengguna</td>
                        </tr>
                    --}}
                @endforeach
            </tbody>
        </table>

        <div class="items-center justify-between px-4 py-3">
            {{-- {{ $users->links('dashboard.pagination') }} --}}
        </div>
    </div>

    <div class="flex items-center justify-start gap-x-2">
        <a href="{{ url('/esop/tambah') }}">
            <button
                class="cursor-pointer rounded-sm bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
            >
                Tambah SOP
            </button>
        </a>
    </div>

    {{--
        <div class="rounded-sm bg-white p-4 shadow-sm">
        <table class="w-full table-fixed border border-black text-sm">
        <thead>
        <tr class="border border-black bg-gray-300 font-bold">
        <td class="w-10 p-2">ID</td>
        <td class="w-50 p-2">Unit Organisasi</td>
        <td class="p-2">Nama SOP</td>
        <td class="p-2">Tanggal Pembuatan</td>
        <td class="p-2">Aksi</td>
        <td class="p-2">Status</td>
        </tr>
        </thead>
        <tbody>
        @foreach ($esops as $index => $esop)
        <tr class="border border-black">
        <td class="p-2">{{ $index + 1 }}</td>
        <td class="p-2">{{ $esop->user->name ?? '-' }}</td>
        <td class="p-2">{{ $esop->nama_sop }}</td>
        <td class="p-2">{{ $esop->created_at->format('d-m-Y') }}</td>
        <td class="p-2">
        <a href="{{ route('esop.edit', ['id' => $esop->id]) }}">
        <button
        class="cursor-pointer rounded-sm bg-blue-500 px-2 py-2 text-xs font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
        >
        <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="size-4"
        >
        <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
        />
        </svg>
        </button>
        </a>
        <form
        action="{{ route('esop.delete', ['id' => $esop->id]) }}"
        method="POST"
        class="delete-esop-form"
        data-nama="{{ $esop->nama_sop }}"
        style="display: inline"
        >
        @csrf
        @method('DELETE')
        <button
        type="button"
        class="btn-delete-esop cursor-pointer rounded-sm bg-red-500 px-2 py-2 text-xs font-semibold text-white shadow-sm hover:bg-red-400"
        >
        <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="size-4"
        >
        <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21
        c.342.052.682.107 1.022.166m-1.022-.165L18.16
        19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25
        2.25 0 0 1-2.244-2.077L4.772 5.79m14.456
        0a48.108 48.108 0 0 0-3.478-.397m-12
        .562c.34-.059.68-.114 1.022-.165m0
        0a48.11 48.11 0 0 1 3.478-.397m7.5
        0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964
        51.964 0 0 0-3.32 0c-1.18.037-2.09
        1.022-2.09 2.201v.916m7.5 0a48.667
        48.667 0 0 0-7.5 0"
        />
        </svg>
        </button>
        </form>
        </td>
        <td class="p-2">
        {{ $esop->status }}
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>
        
        <div class="flex items-center justify-start gap-x-2 py-5">
        <a href="{{ url('/esop/tambah') }}">
        <button
        class="cursor-pointer rounded-sm bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
        >
        Tambah SOP
        </button>
        </a>
        </div>
        </div>
    --}}
</x-layout>

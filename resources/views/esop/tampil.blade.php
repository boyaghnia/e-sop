<x-layout>
    {{-- First Table: My ESOPs --}}
    <div class="mt-1 mb-3 flex w-full items-center justify-between pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800">SOP Saya</h3>
            <p class="text-sm text-slate-600">{{ Auth::user()->name }}</p>
        </div>
        <div class="ml-3">
            <div class="relative w-full max-w-sm min-w-[200px]">
                <div class="relative w-80">
                    <input
                        id="searchInputMyEsops"
                        class="ease h-10 w-full rounded border border-slate-200 bg-white py-2 pr-11 pl-3 text-sm text-slate-700 shadow-sm transition duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-slate-400 focus:shadow-md focus:outline-none"
                        placeholder="Cari SOP saya..."
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

    <div
        class="relative mb-5 flex w-full flex-col overflow-scroll rounded-sm bg-white bg-clip-border text-gray-700 shadow-sm"
    >
        <table class="w-full table-auto text-left">
            <thead>
                <tr>
                    <th class="border-b border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                        <p class="text-sm leading-none text-slate-600">No</p>
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
            <tbody class="tableBodyMyEsops">
                @foreach ($myEsops as $index => $esop)
                    <tr class="tr_pegawai border-b border-slate-200 hover:bg-slate-50">
                        <td class="p-4 py-5">
                            <p class="block text-sm font-semibold text-slate-800">
                                {{ ($myEsops->currentPage() - 1) * $myEsops->perPage() + $index + 1 }}
                            </p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-600">{{ $esop->user->name ?? '-' }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-600">{{ $esop->nama_sop }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-600">{{ $esop->created_at->format('d/m/Y') }}</p>
                        </td>
                        <td class="p-4 py-5">
                            @if ($esop->file_path && $esop->file_name)
                                <a href="{{ asset('storage/' . $esop->file_path) }}" target="_blank">
                                    <div
                                        class="flex w-fit items-center space-x-2 rounded-sm bg-green-500 px-2 py-1 text-sm text-white shadow-sm"
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
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />
                                        </svg>
                                        <p>Disahkan</p>
                                    </div>
                                </a>
                            @else
                                <a href="{{ route('esop.print', ['id' => $esop->id]) }}" target="_blank">
                                    <div
                                        class="flex w-fit items-center space-x-2 rounded-sm bg-blue-500 px-2 py-1 text-sm text-white shadow-sm"
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
                                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"
                                            />
                                        </svg>
                                        <p>Draft</p>
                                    </div>
                                </a>
                            @endif
                        </td>
                        <td class="p-4 py-5">
                            <div class="flex flex-row items-center space-x-2">
                                <a href="{{ route('esop.print', ['id' => $esop->id]) }}">
                                    <button
                                        type="button"
                                        class="cursor-pointer rounded-sm bg-green-500 px-2 py-2 text-xs font-semibold text-white shadow-sm hover:bg-green-400 focus-visible:outline-offset-2 focus-visible:outline-green-600"
                                        title="Cetak SOP"
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
                                                d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z"
                                            />
                                        </svg>
                                    </button>
                                </a>

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
                @endforeach
            </tbody>
        </table>

        <div class="items-center justify-between px-4 py-3">
            {{ $myEsops->links('pagination.pagination') }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // My ESOPs search
            let searchInputMyEsops = document.getElementById('searchInputMyEsops');
            let tableBodyMyEsops = document.querySelector('.tableBodyMyEsops');
            let originalMyEsopsContent = tableBodyMyEsops.innerHTML;
            let myEsopsPaginationContainer = document
                .querySelector('.tableBodyMyEsops')
                .closest('.relative')
                .querySelector('.items-center');
            let originalMyEsopsPaginationContent = myEsopsPaginationContainer.innerHTML;

            // Search for My ESOPs
            searchInputMyEsops.addEventListener('input', function () {
                let query = this.value.trim();

                if (query === '') {
                    tableBodyMyEsops.innerHTML = originalMyEsopsContent;
                    myEsopsPaginationContainer.innerHTML = originalMyEsopsPaginationContent;
                    return;
                }

                fetch(`/dashboard/search?query=${query}&table=my`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                    },
                })
                    .then((response) => response.json())
                    .then((result) => {
                        updateTable(result, tableBodyMyEsops, myEsopsPaginationContainer, query, 'SOP saya');
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        showError(tableBodyMyEsops, myEsopsPaginationContainer, error);
                    });
            });

            // Helper function to update table
            function updateTable(result, tableBody, paginationContainer, query, type) {
                tableBody.innerHTML = '';

                if (result.success && result.data && result.data.length > 0) {
                    result.data.forEach((esop, index) => {
                        let tr = document.createElement('tr');
                        tr.classList.add('tr_pegawai', 'border-b', 'border-slate-200', 'hover:bg-slate-50');

                        let createdDate = new Date(esop.created_at);
                        let formattedDate = createdDate.toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                        });

                        tr.innerHTML = `
                            <td class="p-4 py-5">
                                <p class="block text-sm font-semibold text-slate-800">${index + 1}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-600">${esop.user?.name ?? '-'}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-600">${esop.nama_sop}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-600">${formattedDate}</p>
                            </td>
                            <td class="p-4 py-5">
                                ${
                                    esop.file_path && esop.file_name
                                        ? `<div onclick="window.open('/storage/${esop.file_path}', '_blank')"
                                        class="cursor-pointer flex w-fit items-center space-x-2 rounded-sm bg-green-500 px-2 py-1 text-sm text-white shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p>Disahkan</p>
                                    </div>`
                                        : `<div onclick="window.open('/esop/print/${esop.id}', '_blank')"
                                            class="cursor-pointer flex w-fit items-center space-x-2 rounded-sm bg-blue-500 px-2 py-1 text-sm text-white shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                            </svg>
                                            <p>Draft</p>
                                        </div>`
                                }
                            </td>
                            <td class="p-4 py-5">
                                <div class="flex flex-row items-center space-x-2">
                                    <a href="/esop/print/${esop.id}">
                                        <button type="button" class="cursor-pointer rounded-sm bg-green-500 px-2 py-2 text-xs font-semibold text-white shadow-sm hover:bg-green-400 focus-visible:outline-offset-2 focus-visible:outline-green-600" title="Cetak SOP">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                            </svg>
                                        </button>
                                    </a>
                                    <a href="/esop/edit/${esop.id}">
                                        <button class="cursor-pointer rounded-sm bg-blue-500 px-2 py-2 text-xs font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                    </a>
                                    <form action="/esop/delete/${esop.id}" method="POST" class="delete-esop-form" data-nama="${esop.nama_sop}" style="display: inline">
                                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" class="btn-delete-esop cursor-pointer rounded-sm bg-red-500 px-2 py-2 text-xs font-semibold text-white shadow-sm hover:bg-red-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        `;

                        tableBody.appendChild(tr);
                    });

                    paginationContainer.innerHTML = `
                        <p class="text-sm text-gray-600">
                            Menampilkan ${result.data.length} hasil pencarian ${type} untuk "${query}"
                        </p>
                    `;
                } else {
                    tableBody.innerHTML =
                        '<tr><td colspan="6" class="p-4 text-center text-sm text-slate-600">Tidak ada data ditemukan</td></tr>';
                    paginationContainer.innerHTML = `
                        <p class="text-sm text-gray-600">
                            Tidak ada hasil untuk pencarian "${query}"
                        </p>
                    `;
                }
            }

            // Helper function to show error
            function showError(tableBody, paginationContainer, error) {
                tableBody.innerHTML =
                    '<tr><td colspan="6" class="p-4 text-center text-sm text-red-600">Terjadi kesalahan saat mencari data</td></tr>';
                paginationContainer.innerHTML = `
                    <p class="text-sm text-red-600">
                        Error: ${error.message}
                    </p>
                `;
            }

            // Event listener untuk tombol delete SOP
            document.addEventListener('click', function (event) {
                if (event.target.closest('.btn-delete-esop')) {
                    event.preventDefault();

                    const button = event.target.closest('.btn-delete-esop');
                    const form = button.closest('.delete-esop-form');
                    const namaSop = form.getAttribute('data-nama');

                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: `Apakah Anda yakin ingin menghapus SOP "${namaSop}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>
</x-layout>

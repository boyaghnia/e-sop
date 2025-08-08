<x-layout>
    <div class="flex w-full space-x-3">
        {{-- 1 Kiri - Diagram Doughnut Draft/Disahkan/Total --}}
        <div class="">
            <div class="mt-1 mb-3 flex w-full items-center justify-between pl-3">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Statistik Draft & Disahkan</h3>
                    <p class="text-sm text-slate-600">Perbandingan jumlah</p>
                </div>
            </div>
            <div
                class="relative mb-5 flex w-full flex-col items-center rounded-sm bg-white bg-clip-border p-6 text-gray-700 shadow-sm"
            >
                <canvas id="sopDoughnutChart" width="300" height="366"></canvas>
                <div id="sopDoughnutLegend" class="mt-4 flex h-[50px] flex-col items-center space-y-2"></div>
            </div>
        </div>

        {{-- 2 Tengah - Diagram Statistik Role --}}
        <div class="">
            <div class="mt-1 mb-3 flex w-full items-center justify-between pl-3">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Statistik SOP</h3>
                    <p class="text-sm text-slate-600">Grafik jumlah SOP per role pengguna</p>
                </div>
            </div>

            <div
                class="relative mb-5 flex w-full flex-col rounded-sm bg-white bg-clip-border p-6 text-gray-700 shadow-sm"
            >
                <canvas id="roleStatsChart" width="400" height="366"></canvas>
            </div>
        </div>

        <div class="w-full">
            {{-- 3 Kanan --}}
            <div class="mt-1 mb-3 flex w-full items-center justify-between pl-3">
                <div>
                    @if (Auth::user()->role == 'admin')
                        <h3 class="text-lg font-semibold text-slate-800">Statistik Unit Organisasi</h3>
                        <p class="text-sm text-slate-600">Direktorat Jenderal Perhubungan Udara</p>
                    @elseif (Auth::user()->role == 'obu')
                        <h3 class="text-lg font-semibold text-slate-800">Statistik SOP UPBU</h3>
                        <p class="text-sm text-slate-600">SOP dari Unit Pelaksana Bandar Udara</p>
                    @else
                        <h3 class="text-lg font-semibold text-slate-800">Statistik SOP</h3>
                        <p class="text-sm text-slate-600">{{ Auth::user()->name }}</p>
                    @endif
                </div>
                <div class="ml-3">
                    <div class="relative w-full max-w-sm min-w-[200px]">
                        <div class="relative w-80">
                            <input
                                id="searchInputUnitStats"
                                class="ease h-10 w-full rounded border border-slate-200 bg-white py-2 pr-11 pl-3 text-sm text-slate-700 shadow-sm transition duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-slate-400 focus:shadow-md focus:outline-none"
                                placeholder="Cari unit organisasi..."
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
                                <p class="text-sm leading-none text-slate-600">Jumlah SOP</p>
                            </th>
                            <th class="border-b border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                                <p class="text-sm leading-none text-slate-600">Draft</p>
                            </th>
                            <th class="border-b border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                                <p class="text-sm leading-none text-slate-600">Disahkan</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="tableBodyUnitStats">
                        @foreach ($unitStats as $index => $unit)
                            <tr class="tr_pegawai border-b border-slate-200 hover:bg-slate-50">
                                <td class="p-4 py-5">
                                    <p class="block text-sm font-semibold text-slate-800">
                                        {{ ($unitStats->currentPage() - 1) * $unitStats->perPage() + $index + 1 }}
                                    </p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-600">{{ $unit->user->name ?? '-' }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-center text-sm font-semibold text-slate-600">
                                        {{ $unit->total_sop }}
                                    </p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-center text-sm font-semibold text-slate-600">{{ $unit->draft }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-center text-sm font-semibold text-slate-600">
                                        {{ $unit->disahkan }}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="items-center justify-between px-4 py-3">
                    {{ $unitStats->links('pagination.pagination') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Second Table: All ESOPs based on role --}}
    <div class="mt-1 mb-3 flex w-full items-center justify-between pl-3">
        <div>
            @if (Auth::user()->role == 'admin')
                <h3 class="text-lg font-semibold text-slate-800">Semua Data SOP</h3>
                <p class="text-sm text-slate-600">Direktorat Jenderal Perhubungan Udara</p>
            @elseif (Auth::user()->role == 'obu')
                <h3 class="text-lg font-semibold text-slate-800">Data SOP UPBU</h3>
                <p class="text-sm text-slate-600">SOP dari Unit Pelaksana Bandar Udara</p>
            @else
                <h3 class="text-lg font-semibold text-slate-800">Data SOP</h3>
                <p class="text-sm text-slate-600">{{ Auth::user()->name }}</p>
            @endif
        </div>
        <div class="ml-3">
            <div class="relative flex w-full max-w-sm min-w-[200px] items-center space-x-2">
                <div>
                    <button
                        id="exportButton"
                        class="flex w-fit cursor-pointer items-center justify-center rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-400"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                            />
                        </svg>
                        <p class="px-2">Export</p>
                    </button>
                </div>

                <div class="relative w-80">
                    <input
                        id="searchInputAllEsops"
                        class="ease h-10 w-full rounded border border-slate-200 bg-white py-2 pr-11 pl-3 text-sm text-slate-700 shadow-sm transition duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-slate-400 focus:shadow-md focus:outline-none"
                        placeholder="Cari semua SOP..."
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
            <tbody class="tableBodyAllEsops">
                @foreach ($allEsops as $index => $esop)
                    <tr class="tr_pegawai border-b border-slate-200 hover:bg-slate-50">
                        <td class="p-4 py-5">
                            <p class="block text-sm font-semibold text-slate-800">
                                {{ ($allEsops->currentPage() - 1) * $allEsops->perPage() + $index + 1 }}
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
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
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
                                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504-1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"
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
                                                d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015-1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z"
                                            />
                                        </svg>
                                    </button>
                                </a>
                                <a href="{{ route('esop.edit', ['id' => $esop->id]) }}">
                                    <button
                                        class="cursor-pointer rounded-sm bg-blue-500 px-2 py-2 text-xs font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                        title="Edit SOP"
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
            {{ $allEsops->links('pagination.pagination') }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Doughnut Chart Draft/Disahkan
            const doughnutCtx = document.getElementById('sopDoughnutChart');
            if (doughnutCtx) {
                // Ambil semua data SOP dari seluruh table (tanpa pagination)
                fetch('/dashboard/search?table=all')
                    .then((response) => response.json())
                    .then((result) => {
                        let draft = 0;
                        let disahkan = 0;
                        if (result.success && result.data) {
                            result.data.forEach((esop) => {
                                if (esop.file_path && esop.file_name) {
                                    disahkan++;
                                } else {
                                    draft++;
                                }
                            });
                        }
                        const total = draft + disahkan;

                        const doughnutData = {
                            labels: ['Draft', 'Disahkan'],
                            datasets: [
                                {
                                    data: [draft, disahkan],
                                    backgroundColor: [
                                        'rgba(59, 130, 246, 0.8)', // Blue
                                        'rgba(16, 185, 129, 0.8)', // Green
                                    ],
                                    borderColor: ['rgba(59, 130, 246, 1)', 'rgba(16, 185, 129, 1)'],
                                    borderWidth: 1,
                                },
                            ],
                        };

                        new Chart(doughnutCtx, {
                            type: 'doughnut',
                            data: doughnutData,
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'bottom',
                                        labels: {
                                            font: { size: 14 },
                                            color: '#334155',
                                            usePointStyle: true,
                                            padding: 20,
                                            generateLabels: function (chart) {
                                                const data = chart.data;
                                                if (data.labels.length && data.datasets.length) {
                                                    return data.labels.map((label, i) => {
                                                        return {
                                                            text: `${label} (${data.datasets[0].data[i]})`,
                                                            fillStyle: data.datasets[0].backgroundColor[i],
                                                            strokeStyle: data.datasets[0].borderColor[i],
                                                            lineWidth: 2,
                                                            hidden: false,
                                                            index: i,
                                                        };
                                                    });
                                                }
                                                return [];
                                            },
                                        },
                                    },
                                    title: {
                                        display: true,
                                        text: 'Draft vs Disahkan',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function (context) {
                                                let label = context.label || '';
                                                let value = context.parsed;
                                                return `${label}: ${value}`;
                                            },
                                        },
                                    },
                                },
                                cutout: '70%',
                            },
                        });

                        // Tambahkan legend total di bawah chart
                        const legendContainer = document.getElementById('sopDoughnutLegend');
                        legendContainer.innerHTML = '';
                        const legendTotal = document.createElement('div');
                        legendTotal.className = 'mt-2 text-base font-semibold text-slate-700';
                        legendTotal.innerHTML = `Total SOP: <span class="text-slate-900">${total}</span>`;
                        legendContainer.appendChild(legendTotal);
                    });
            }
            // Role Statistics Chart
            const ctx = document.getElementById('roleStatsChart');
            if (ctx) {
                // Fetch data untuk mendapatkan breakdown draft dan disahkan per role
                fetch('/dashboard/search?table=all')
                    .then((response) => response.json())
                    .then((result) => {
                        if (result.success && result.data) {
                            // Hitung data per role
                            const roleStatsData = {};

                            // Initialize roles
                            const roleOrder = ['sekretariat', 'direktorat', 'balai', 'obu', 'upbu'];
                            roleOrder.forEach((role) => {
                                roleStatsData[role] = { draft: 0, disahkan: 0, total: 0 };
                            });

                            // Process data
                            result.data.forEach((esop) => {
                                const userRole = esop.user?.role || 'unknown';
                                if (roleStatsData[userRole]) {
                                    if (esop.file_path && esop.file_name) {
                                        roleStatsData[userRole].disahkan++;
                                    } else {
                                        roleStatsData[userRole].draft++;
                                    }
                                    roleStatsData[userRole].total++;
                                }
                            });

                            const labels = [];
                            const draftData = [];
                            const disahkanData = [];

                            roleOrder.forEach((role) => {
                                if (roleStatsData[role]) {
                                    let roleName = role;
                                    switch (role) {
                                        case 'sekretariat':
                                            roleName = 'Sekretariat';
                                            break;
                                        case 'direktorat':
                                            roleName = 'Direktorat';
                                            break;
                                        case 'balai':
                                            roleName = 'Balai';
                                            break;
                                        case 'obu':
                                            roleName = 'OBU';
                                            break;
                                        case 'upbu':
                                            roleName = 'UPBU';
                                            break;
                                        default:
                                            roleName = role.charAt(0).toUpperCase() + role.slice(1);
                                    }
                                    labels.push(roleName);
                                    draftData.push(roleStatsData[role].draft);
                                    disahkanData.push(roleStatsData[role].disahkan);
                                }
                            });

                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [
                                        {
                                            label: 'Draft',
                                            data: draftData,
                                            backgroundColor: 'rgba(59, 130, 246, 0.8)', // Blue
                                            borderColor: 'rgba(59, 130, 246, 1)',
                                            borderWidth: 1,
                                        },
                                        {
                                            label: 'Disahkan',
                                            data: disahkanData,
                                            backgroundColor: 'rgba(16, 185, 129, 0.8)', // Green
                                            borderColor: 'rgba(16, 185, 129, 1)',
                                            borderWidth: 1,
                                        },
                                    ],
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        x: {
                                            stacked: true,
                                        },
                                        y: {
                                            stacked: true,
                                            beginAtZero: true,
                                            ticks: {
                                                stepSize: 1,
                                            },
                                        },
                                    },
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Statistik SOP',
                                        },
                                        legend: {
                                            display: true,
                                            position: 'top',
                                        },
                                        tooltip: {
                                            mode: 'index',
                                            intersect: false,
                                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                            titleColor: 'white',
                                            bodyColor: 'white',
                                            borderColor: 'rgba(255, 255, 255, 0.1)',
                                            borderWidth: 1,
                                            cornerRadius: 8,
                                            displayColors: true,
                                            callbacks: {
                                                title: function (context) {
                                                    return context[0].label;
                                                },
                                                afterTitle: function (context) {
                                                    const dataIndex = context[0].dataIndex;
                                                    const total = draftData[dataIndex] + disahkanData[dataIndex];
                                                    return `Total SOP: ${total}`;
                                                },
                                                label: function (context) {
                                                    const label = context.dataset.label;
                                                    const value = context.parsed.y;
                                                    return ` ${label}: ${value}`;
                                                },
                                            },
                                        },
                                    },
                                },
                            });
                        }
                    })
                    .catch((error) => {
                        console.error('Error fetching role stats data:', error);
                        // Fallback to original data if fetch fails
                        const roleData = @json($roleStats);
                        // ... original chart code as fallback
                    });
            }

            // Unit Stats search
            let searchInputUnitStats = document.getElementById('searchInputUnitStats');
            let tableBodyUnitStats = document.querySelector('.tableBodyUnitStats');
            let originalUnitStatsContent = tableBodyUnitStats.innerHTML;
            let unitStatsPaginationContainer = document
                .querySelector('.tableBodyUnitStats')
                .closest('.relative')
                .querySelector('.items-center');
            let originalUnitStatsPaginationContent = unitStatsPaginationContainer.innerHTML;

            // Search for Unit Stats
            searchInputUnitStats.addEventListener('input', function () {
                let query = this.value.trim();

                if (query === '') {
                    tableBodyUnitStats.innerHTML = originalUnitStatsContent;
                    unitStatsPaginationContainer.innerHTML = originalUnitStatsPaginationContent;
                    return;
                }

                fetch(`/dashboard/search?query=${query}&table=units`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                    },
                })
                    .then((response) => response.json())
                    .then((result) => {
                        updateUnitTable(result, tableBodyUnitStats, unitStatsPaginationContainer, query);
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        showError(tableBodyUnitStats, unitStatsPaginationContainer, error);
                    });
            });

            // Helper function to update unit stats table
            function updateUnitTable(result, tableBody, paginationContainer, query) {
                tableBody.innerHTML = '';

                if (result.success && result.data && result.data.length > 0) {
                    result.data.forEach((unit, index) => {
                        let tr = document.createElement('tr');
                        tr.classList.add('tr_pegawai', 'border-b', 'border-slate-200', 'hover:bg-slate-50');

                        tr.innerHTML = `
                            <td class="p-4 py-5">
                                <p class="block text-sm font-semibold text-slate-800">${index + 1}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-600">${unit.user?.name ?? '-'}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-600">${unit.total_sop}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-600">${unit.draft}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-600">${unit.disahkan}</p>
                            </td>
                        `;

                        tableBody.appendChild(tr);
                    });

                    paginationContainer.innerHTML = `
                        <p class="text-sm text-gray-600">
                            Menampilkan ${result.data.length} hasil pencarian unit organisasi untuk "${query}"
                        </p>
                    `;
                } else {
                    tableBody.innerHTML =
                        '<tr><td colspan="5" class="p-4 text-center text-sm text-slate-600">Tidak ada data ditemukan</td></tr>';
                    paginationContainer.innerHTML = `
                        <p class="text-sm text-gray-600">
                            Tidak ada hasil untuk pencarian "${query}"
                        </p>
                    `;
                }
            }

            // All ESOPs search
            let searchInputAllEsops = document.getElementById('searchInputAllEsops');
            let tableBodyAllEsops = document.querySelector('.tableBodyAllEsops');
            let originalAllEsopsContent = tableBodyAllEsops.innerHTML;
            let allEsopsPaginationContainer = document
                .querySelector('.tableBodyAllEsops')
                .closest('.relative')
                .querySelector('.items-center');
            let originalAllEsopsPaginationContent = allEsopsPaginationContainer.innerHTML;

            // Search for All ESOPs
            searchInputAllEsops.addEventListener('input', function () {
                let query = this.value.trim();

                if (query === '') {
                    tableBodyAllEsops.innerHTML = originalAllEsopsContent;
                    allEsopsPaginationContainer.innerHTML = originalAllEsopsPaginationContent;
                    return;
                }

                fetch(`/dashboard/search?query=${query}&table=all`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                    },
                })
                    .then((response) => response.json())
                    .then((result) => {
                        updateTable(result, tableBodyAllEsops, allEsopsPaginationContainer, query, 'SOP');
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        showError(tableBodyAllEsops, allEsopsPaginationContainer, error);
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
                                        ? `
                                    <div onclick="window.open('/storage/${esop.file_path}', '_blank')"
                                        class="cursor-pointer flex w-fit items-center space-x-2 rounded-sm bg-green-500 px-2 py-1 text-sm text-white shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p>Disahkan</p>
                                    </div>
                                `
                                        : `
                                        <div onclick="window.open('/esop/print/${esop.id}', '_blank')"
                                            class="cursor-pointer flex w-fit items-center space-x-2 rounded-sm bg-blue-500 px-2 py-1 text-sm text-white shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504-1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                            </svg>
                                            <p>Draft</p>
                                        </div>
                                `
                                }
                            </td>
                            <td class="p-4 py-5">
                                <div class="flex flex-row items-center space-x-2">
                                    <a href="/esop/print/${esop.id}">
                                        <button type="button" class="cursor-pointer rounded-sm bg-green-500 px-2 py-2 text-xs font-semibold text-white shadow-sm hover:bg-green-400 focus-visible:outline-offset-2 focus-visible:outline-green-600" title="Cetak SOP">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015-1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                            </svg>
                                        </button>
                                    </a>
                                    <a href="/esop/edit/${esop.id}">
                                        <button class="cursor-pointer rounded-sm bg-blue-500 px-2 py-2 text-xs font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline-offset-2 focus-visible:outline-blue-600" title="Edit SOP">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                    </a>
                                    <form action="/esop/delete/${esop.id}" method="POST" class="delete-esop-form" data-nama="${esop.nama_sop}" style="display: inline">
                                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" class="btn-delete-esop cursor-pointer rounded-sm bg-red-500 px-2 py-2 text-xs font-semibold text-white shadow-sm hover:bg-red-400" title="Hapus SOP">
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

            // Function untuk menutup modal
            function closeExportModal() {
                document.getElementById('exportModal').classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            // Event listener untuk tombol export
            document.getElementById('exportButton').addEventListener('click', function () {
                document.getElementById('exportModal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });

            // Event listener untuk menutup modal dengan tombol close
            document.getElementById('closeExportModal').addEventListener('click', function () {
                closeExportModal();
            });

            // Event listener untuk backdrop modal
            document.getElementById('exportModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    closeExportModal();
                }
            });

            // Event listener untuk tombol ESC
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    const modal = document.getElementById('exportModal');
                    if (!modal.classList.contains('hidden')) {
                        closeExportModal();
                    }
                }
            });

            // Event listeners untuk tombol export
            document.getElementById('exportAllBtn').addEventListener('click', function () {
                closeExportModal(); // Tutup modal terlebih dahulu
                setTimeout(function () {
                    window.location.href = '/export/sop?type=all';
                }, 100); // Delay sedikit untuk animasi modal close
            });

            document.getElementById('exportApprovedBtn').addEventListener('click', function () {
                closeExportModal(); // Tutup modal terlebih dahulu
                setTimeout(function () {
                    window.location.href = '/export/sop?type=approved';
                }, 100); // Delay sedikit untuk animasi modal close
            });

            document.getElementById('exportDraftBtn').addEventListener('click', function () {
                closeExportModal(); // Tutup modal terlebih dahulu
                setTimeout(function () {
                    window.location.href = '/export/sop?type=draft';
                }, 100); // Delay sedikit untuk animasi modal close
            });
        });
    </script>

    <!-- Export Modal -->
    <div id="exportModal" class="bg-opacity-80 fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-gray-900/80">
        <div class="relative top-72 mx-auto w-96 rounded-md border bg-white p-5 shadow-lg">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Pilih Jenis Export</h3>
                    <button id="closeExportModal" class="cursor-pointer text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            ></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="space-y-4">
                    <!-- Export All Button -->
                    <button
                        id="exportAllBtn"
                        class="flex w-full cursor-pointer items-center justify-center rounded-lg bg-blue-600 px-4 py-3 font-semibold text-white transition duration-200 hover:bg-blue-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="mr-2 h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                            />
                        </svg>
                        Export Semua SOP
                    </button>

                    <!-- Export Approved Button -->
                    <button
                        id="exportApprovedBtn"
                        class="flex w-full cursor-pointer items-center justify-center rounded-lg bg-green-600 px-4 py-3 font-semibold text-white transition duration-200 hover:bg-green-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="mr-2 h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                            />
                        </svg>
                        Export SOP Disahkan
                    </button>

                    <!-- Export Draft Button -->
                    <button
                        id="exportDraftBtn"
                        class="flex w-full cursor-pointer items-center justify-center rounded-lg bg-orange-600 px-4 py-3 font-semibold text-white transition duration-200 hover:bg-orange-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="mr-2 h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504-1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"
                            />
                        </svg>
                        Export SOP Draft
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('keydown', function (e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                e.preventDefault();
            }
        });
    </script>
</x-layout>

@php
    $jumlahPelaksana = $esop->pelaksanas->count();
@endphp

<x-layout>
    <style>
        @media print {
            html,
            body {
                width: 100%;
                height: 100%;
                margin: 0 !important;
                padding: 0 !important;
            }
            main,
            header,
            aside,
            footer {
                margin: 0 !important;
                padding: 0 !important;
            }
            header,
            .fixed {
                display: none !important;
                visibility: hidden !important;
                height: 0 !important;
                position: none !important;
            }
            .space-y-3,
            .rounded-sm,
            .bg-white,
            .p-4,
            .shadow-sm,
            .mt-4,
            .mb-4,
            .ml-4,
            .mr-4,
            .mt-20 {
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                background: none !important;
            }
            body * {
                visibility: hidden;
            }

            @page :first {
                size: 220mm 310mm;
            }

            @page {
                size: 310mm 220mm;
            }

            /* ---------------------------------------------------------- */
            /* ---------------------------------------------------------- */
            /* ---------------------------------------------------------- */
            /* Print Area 1 */

            .print-area,
            .print-area * {
                visibility: visible;
                font-size: 11px;
            }

            .print-area {
                width: 100%;
                min-height: 95vh;
                max-height: 97vh;
                margin: 0 !important;
                padding: 0 !important;
                box-sizing: border-box;
                page-break-inside: avoid !important;
                page-break-after: always !important;
            }

            .print-area tr:nth-child(-n + 4) {
                height: 35px !important;
            }

            .print-area tr:nth-child(5) {
                height: 100px !important;
            }

            .print-area tr:nth-child(6) {
                height: 50px !important;
            }

            .print-area tr:nth-child(7) {
                height: 25px !important;
            }

            .print-area tr:nth-child(8) {
                height: auto !important;
            }

            .print-area tr:nth-child(9) {
                height: 25px !important;
            }

            .print-area tr:nth-child(10) {
                height: 125px !important;
            }

            .print-area tr:nth-child(11) {
                height: 25px !important;
            }

            .print-area tr:nth-child(12) {
                height: 125px !important;
            }

            .print-area table {
                border-collapse: collapse !important;
            }

            .print-area td {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            /* ---------------------------------------------------------- */
            /* ---------------------------------------------------------- */
            /* ---------------------------------------------------------- */
            /* Print Area 2 */

            .print-area2,
            .print-area2 * {
                visibility: visible;
                font-size: 11px;
            }
            .print-area2 {
                height: 100vh;
                width: 100vh;
                margin: 0 !important;
                padding: 0 !important;
                box-sizing: border-box;
                page-break-inside: avoid !important;
            }

            .print-area2 table {
                height: 100%;
                table-layout: fixed;
            }

            .print-area table,
            .print-area2 table {
                border-collapse: collapse !important;
            }
            .print-area td,
            .print-area2 td {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            .print-area2 .symbol-preview,
            .print-area2 .symbol-preview * {
                display: block !important;
                visibility: visible !important;
                background: inherit !important;
                color: inherit !important;
            }
            .print-area2 .mx-auto {
                margin-left: auto !important;
                margin-right: auto !important;
            }
        }
    </style>

    <!-- Print Preview Controls -->
    <div class="mb-4 flex items-center justify-between">
        <div class="w-full text-left print:hidden">
            <span class="text-lg font-bold text-slate-700">
                {{ $esop->nama_sop }}
            </span>
        </div>

        <div class="flex space-x-2">
            <button
                onclick="window.print()"
                class="cursor-pointer rounded-sm bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-400 focus-visible:outline-offset-2 focus-visible:outline-green-600"
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
            <a href="{{ route('esop.edit', ['id' => $esop->id]) }}" class="print:hidden">
                <button
                    class="cursor-pointer rounded-sm bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
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
            <a id="backBtn" href="#" class="print:hidden">
                <button
                    class="cursor-pointer rounded-sm bg-gray-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-400 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
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
                            d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"
                        />
                    </svg>
                </button>
            </a>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var backBtn = document.getElementById('backBtn');
                    var ref = document.referrer;
                    if (ref.includes('/esop/dashboard')) {
                        backBtn.href = '{{ route('dashboard.tampil') }}';
                    } else if (ref.includes('/esop/esop')) {
                        backBtn.href = '{{ route('esop.tampil') }}';
                    } else if (ref.includes('/esop/edit')) {
                        backBtn.href = '{{ route('esop.tampil') }}';
                    } else {
                        backBtn.href = ref || '{{ route('dashboard.tampil') }}';
                    }
                });
            </script>
        </div>
    </div>

    <div class="space-y-3">
        <div class="rounded-sm bg-white p-4 shadow-sm">
            <table class="print-area h-1 w-full table-fixed border border-black text-sm">
                <tbody>
                    <!-- === Header === -->
                    <tr>
                        <td rowspan="5" colspan="2" class="border p-2">
                            <img class="mx-auto w-40" src="{{ asset('img/logo-kemenhub.png') }}" alt="" />
                        </td>
                        <td rowspan="5" colspan="3" class="border p-2 text-center">
                            <img class="mx-auto w-40" src="{{ asset('img/logo-djpu.png') }}" alt="" />
                            <div id="preview_judul_sop" class="text-center text-sm font-bold text-gray-800">
                                {{ $esop->judul_sop }}
                            </div>
                        </td>
                        <td colspan="2" class="border p-2 font-bold">Nomor SOP</td>
                        <td colspan="3" class="border p-2">
                            <div id="preview_no_sop" class="text-left text-sm text-gray-800">{{ $esop->no_sop }}</div>
                        </td>
                    </tr>

                    <!-- === Tgl. Ditetapkan === -->
                    <tr>
                        <td colspan="2" class="border p-2 font-bold">Tgl. Ditetapkan</td>
                        <td colspan="3" class="border p-2">
                            {{-- Input Tgl. Ditetapkan --}}
                            <div id="preview_tgl_ditetapkan" class="text-left text-sm text-gray-800">
                                {{ $esop->tgl_ditetapkan }}
                            </div>
                        </td>
                    </tr>

                    <!-- === Tgl. Revisi === -->
                    <tr>
                        <td colspan="2" class="border p-2 font-bold">Tgl. Revisi</td>
                        <td colspan="3" class="border p-2">
                            {{-- Input Tgl. Revisi --}}
                            <div id="preview_tgl_revisi" class="text-left text-sm text-gray-800">
                                {{ $esop->tgl_revisi }}
                            </div>
                        </td>
                    </tr>

                    <!-- === Tgl. Diberlakukan === -->
                    <tr>
                        <td colspan="2" class="border p-2 font-bold">Tgl. Diberlakukan</td>
                        <td colspan="3" class="border p-2">
                            {{-- Input Tgl. Diberlakukan --}}
                            <div id="preview_tgl_diberlakukan" class="text-left text-sm text-gray-800">
                                {{ $esop->tgl_diberlakukan }}
                            </div>
                        </td>
                    </tr>

                    <!-- === Ditetapkan Oleh === -->
                    <tr>
                        <td colspan="2" class="border p-2 font-bold">Ditetapkan Oleh</td>
                        <td colspan="3" class="border p-2 text-left">
                            <p>
                                <span style="margin-left: 1rem" class="spacing">${jabatan_pengirim}</span>
                                <br />
                                <br />
                                <br />
                                <br />
                                <span style="margin-left: 3rem" class="ttd-spacing">${ttd_pengirim}</span>
                                <br />
                                <br />
                                <br />
                                <br />
                                <span style="margin-left: 1rem" class="spacing">${nama_pengirim}</span>
                                <br />
                                <span style="margin-left: 1rem" class="spacing">${nip_pengirim}</span>
                            </p>
                        </td>
                    </tr>

                    <!-- === Input Nama SOP === -->
                    <tr>
                        <td colspan="10" class="border p-2 font-bold">
                            <div id="preview_nama_sop" class="text-center text-sm text-gray-800">
                                {{ $esop->nama_sop }}
                            </div>
                        </td>
                    </tr>

                    {{-- Judul Dasar Hukum - Cara Mengatasi Pelaksana --}}
                    <tr>
                        <td colspan="5" class="border p-2 font-bold">Dasar Hukum :</td>
                        <td colspan="5" class="border p-2 font-bold">Cara Mengatasi :</td>
                    </tr>

                    {{-- Input Dasar Hukum - Cara Mengatasi --}}
                    <tr>
                        <td colspan="5" class="border p-2 align-top">
                            <div
                                id="preview_dasar_hukum"
                                class="text-left text-sm text-gray-800"
                                data-source="{{ e($esop->dasar_hukum) }}"
                            ></div>
                        </td>
                        <td colspan="5" class="border p-2 align-top">
                            <div
                                id="preview_cara_mengatasi"
                                class="text-left text-sm text-gray-800"
                                data-source="{{ e($esop->cara_mengatasi) }}"
                            ></div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5" class="border p-2 font-bold">Keterkaitan :</td>
                        <td colspan="5" class="border p-2 font-bold">Peralatan :</td>
                    </tr>

                    <tr>
                        <td colspan="5" class="border p-2 align-top">
                            <div
                                id="preview_keterkaitan"
                                class="text-left text-sm text-gray-800"
                                data-source="{{ e($esop->keterkaitan) }}"
                            ></div>
                        </td>
                        <td colspan="5" rowspan="3" class="border p-2 align-top">
                            <div
                                id="preview_peralatan_perlengkapan"
                                class="text-left text-sm text-gray-800"
                                data-source="{{ e($esop->peralatan_perlengkapan) }}"
                            ></div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5" class="border p-2 font-bold">Peringatan :</td>
                    </tr>

                    <tr>
                        <td colspan="5" class="border p-2 align-top">
                            <div
                                id="preview_peringatan"
                                class="text-left text-sm text-gray-800"
                                data-source="{{ e($esop->peringatan) }}"
                            ></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="preview-area" class="mt-4">
        <div class="preview-wrapper" id="preview-wrapper">
            <div id="pages-container" class="pages-container">
                <div class="main-content rounded-sm bg-white p-4 shadow-sm">
                    <div class="table-container">
                        <table class="print-area2 flow-table border border-gray-400 text-sm text-gray-800">
                            <colgroup>
                                <col style="width: 2%" />
                                <!-- No -->
                                <col style="width: 13%" />
                                <!-- Uraian Kegiatan -->
                                @php
                                    // Hitung sisa persen untuk kolom pelaksana dan kolom lain
                                    $pelaksanaPersen = $jumlahPelaksana > 0 ? 30 / $jumlahPelaksana : 0;
                                @endphp

                                @for ($i = 0; $i < $jumlahPelaksana; $i++)
                                    <col style="width: {{ $pelaksanaPersen }}%" />
                                    <!-- Pelaksana -->
                                @endfor

                                <col style="width: 5%" />
                                <!-- Kelengkapan -->
                                <col style="width: 5%" />
                                <!-- Waktu -->
                                <col style="width: 5%" />
                                <!-- Output -->
                                <col style="width: 5%" />
                                <!-- Keterangan -->
                            </colgroup>
                            <thead>
                                <tr class="bg-gray-100 text-center font-semibold">
                                    <th rowspan="2" class="border border-gray-400 px-2 py-1 align-middle">No</th>
                                    <th rowspan="2" class="w-[300px] border border-gray-400 px-2 py-1 align-middle">
                                        Uraian Kegiatan
                                    </th>
                                    <th colspan="{{ $jumlahPelaksana }}" class="border border-gray-400 px-2 py-1">
                                        Pelaksana
                                    </th>
                                    <th colspan="3" class="border border-gray-400 px-2 py-1">Mutu Baku</th>
                                    <th rowspan="2" class="border border-gray-400 px-2 py-1">Keterangan</th>
                                </tr>
                                <tr class="bg-gray-100 text-center">
                                    @foreach ($esop->pelaksanas as $pelaksana)
                                        <th class="border border-gray-400 px-2 py-1">{{ $pelaksana->isi }}</th>
                                    @endforeach

                                    <th class="border border-gray-400 px-2 py-1">Kelengkapan</th>
                                    <th class="border border-gray-400 px-2 py-1">Waktu</th>
                                    <th class="border border-gray-400 px-2 py-1">Output</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-flow">
                                @php
                                    $jumlahBaris = max(4, $flows->max('no_urutan') ?? 0);
                                @endphp

                                @for ($i = 0; $i < $jumlahBaris; $i++)
                                    @php
                                        $flow = $flows[$i] ?? null;
                                    @endphp

                                    <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-white' }}">
                                        <td class="border border-gray-400 px-2 py-1 text-center">{{ $i + 1 }}</td>
                                        <td class="uraian-column border border-gray-400 px-2 py-1">
                                            {{ $flow->uraian_kegiatan ?? '' }}
                                        </td>
                                        @foreach ($esop->pelaksanas as $index => $pelaksana)
                                            @php
                                                $savedSymbol = '';
                                                $savedReturnTo = '';
                                                if ($flow && $flow->symbols && is_array($flow->symbols)) {
                                                    $savedSymbol = $flow->symbols[$index] ?? '';
                                                }
                                                if ($flow && $flow->return_to && is_array($flow->return_to)) {
                                                    $savedReturnTo = $flow->return_to[$index] ?? '';
                                                }
                                            @endphp

                                            <td
                                                class="border border-gray-400 px-2 py-1"
                                                data-flow="{{ $flow->id ?? '' }}"
                                                data-pelaksana="{{ $pelaksana->id }}"
                                            >
                                                <select
                                                    name="symbol_{{ $i }}_{{ $index }}"
                                                    onchange="updateSymbol(this)"
                                                    class="w-full text-sm"
                                                >
                                                    <option value="">Pilih</option>
                                                    <option
                                                        value="start"
                                                        {{ $savedSymbol == 'start' ? 'selected' : '' }}
                                                    >
                                                        Mulai
                                                    </option>
                                                    <option
                                                        value="process"
                                                        {{ $savedSymbol == 'process' ? 'selected' : '' }}
                                                    >
                                                        Proses
                                                    </option>
                                                    <option
                                                        value="decision"
                                                        {{ $savedSymbol == 'decision' ? 'selected' : '' }}
                                                    >
                                                        Pilihan
                                                    </option>
                                                </select>
                                                <div class="symbol-preview">
                                                    @if ($savedSymbol == 'start')
                                                        <div class="mx-auto h-6 w-15 rounded-xl bg-blue-500"></div>
                                                    @elseif ($savedSymbol == 'process')
                                                        <div class="mx-auto h-6 w-15 bg-green-500"></div>
                                                    @elseif ($savedSymbol == 'decision')
                                                        <div class="mx-auto h-8 w-8 rotate-45 bg-yellow-400"></div>
                                                    @else
                                                        <div
                                                            class="mx-auto h-6 w-15 border-2 border-dashed border-gray-300"
                                                        ></div>
                                                    @endif

                                                    @if ($savedSymbol && $savedSymbol != '')
                                                        <div class="symbol-number">
                                                            {{ ($i - 1) * $jumlahPelaksana + $index + 1 }}
                                                        </div>
                                                    @endif
                                                </div>

                                                @if ($savedSymbol == 'decision')
                                                    <div class="mt-2">
                                                        <input
                                                            type="number"
                                                            name="return_to_{{ $i }}_{{ $index }}"
                                                            placeholder="Kembali ke nomor"
                                                            min="1"
                                                            class="w-full rounded border border-gray-300 px-2 py-1 text-xs"
                                                            value="{{ $savedReturnTo }}"
                                                            onchange="syncPreviewTable()"
                                                        />
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach

                                        <td class="border border-gray-400 px-2 py-1">
                                            {{ $flow->kelengkapan ?? '' }}
                                        </td>
                                        <td class="border border-gray-400 px-2 py-1">
                                            {{ $flow->waktu ?? '' }}
                                        </td>
                                        <td class="border border-gray-400 px-2 py-1">
                                            {{ $flow->output ?? '' }}
                                        </td>

                                        <td class="border border-gray-400 px-2 py-1">
                                            {{ $flow->keterangan ?? '' }}
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.print();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const previewIds = ['dasar_hukum', 'cara_mengatasi', 'keterkaitan', 'peralatan_perlengkapan', 'peringatan'];
            previewIds.forEach(function (id) {
                const el = document.getElementById('preview_' + id);
                if (!el) return;
                const source = el.getAttribute('data-source') || '';
                const lines = source
                    .split(/\r?\n/)
                    .map((line) => line.trim())
                    .filter((line) => line !== '');
                if (lines.length) {
                    el.innerHTML =
                        '<ol class="list-decimal pl-4">' +
                        lines.map((line) => `<li>${line.replace(/^\d+\.\s*/, '')}</li>`).join('') +
                        '</ol>';
                } else {
                    el.innerHTML = '<em class="text-gray-400"></em>';
                }
            });
        });
    </script>
</x-layout>

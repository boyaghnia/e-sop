@php
    // Calculate pelaksana count for dynamic column width calculation
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

            /* Print Area 2 */
            .print-area2,
            .print-area2 * {
                visibility: visible;
                font-size: 10px;
            }
            .print-area2 {
                min-height: 0;
                height: auto;
                width: 100vh;
                margin: 0 !important;
                padding: 0 !important;
                box-sizing: border-box;
                page-break-inside: avoid !important;
            }

            .print-area2 {
                page-break-after: always;
            }
            .print-area2:last-child {
                page-break-after: auto;
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

            /* Force borders for print area 2 */
            .print-area2 table,
            .print-area2 th,
            .print-area2 td {
                border: 1px solid #000000 !important;
                background-color: transparent !important;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .print-area2 .flow-table {
                border: 1px solid #000000 !important;
            }

            .print-area2 .flow-table th,
            .print-area2 .flow-table td {
                border: 1px solid #000000 !important;
                border-collapse: collapse !important;
                background-color: transparent !important;
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

            /* Symbol styling untuk print */
            .print-area2 .symbol-preview {
                display: block !important;
                visibility: visible !important;
                position: relative;
            }

            .print-area2 .symbol-preview > div {
                display: block !important;
                visibility: visible !important;
                margin: 2px auto !important;
            }

            .print-area2 .symbol-preview .bg-blue-500 {
                background-color: #3b82f6 !important;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .print-area2 .symbol-preview .bg-green-500 {
                background-color: #10b981 !important;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .print-area2 .symbol-preview .bg-yellow-400 {
                background-color: #fbbf24 !important;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .print-area2 .symbol-preview .border-gray-300 {
                border-color: #d1d5db !important;
            }

            .print-area2 .mx-auto {
                margin-left: auto !important;
                margin-right: auto !important;
                display: block !important;
            }

            .print-area2 .rounded-xl {
                border-radius: 0.75rem !important;
            }

            /* Ensure red lines and text are visible in print */
            .print-area2 canvas,
            #flow-preview-canvas {
                visibility: visible !important;
                display: block !important;
                position: absolute !important;
                width: 100% !important;
                height: auto !important;
                pointer-events: none !important;
                z-index: 10 !important;
                background: transparent !important;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>

    <!-- CSS untuk symbol preview di layar -->
    <style>
        .symbol-preview {
            margin-top: 4px;
            display: flex;
            justify-content: center;
            position: relative;
        }

        /* Ensure all table cells have consistent black borders */
        .print-area2 td,
        .print-area2 th {
            border: 1px solid #000000 !important;
        }

        /* Row height settings for print-area2 */
        .print-area2 tbody tr:not(.header-row):not(.footer-row) {
            height: 70px !important;
            min-height: 70px !important;
        }

        .print-area2 thead tr {
            height: auto !important;
            min-height: 40px !important;
        }

        /* Canvas styling */
        #preview-container {
            position: relative;
            border: 1px solid #000000;
            outline: none;
        }

        #flow-preview-canvas {
            position: absolute;
            pointer-events: none;
            z-index: 10;
            border: 1px solid #000000;
            outline: none;
            background: transparent;
        }

        /* Footer row styling */
        .footer-row {
            background-color: transparent;
            height: 60px;
        }

        .footer-row td {
            background-color: transparent !important;
            border-color: #000000;
        }

        .footer-connector .connector-symbol-svg {
            opacity: 1;
        }

        .footer-connector .connector-symbol-svg polygon {
            fill: #6b7280 !important;
            stroke: #6b7280 !important;
            stroke-width: 2;
        }

        /* Header connector styling */
        .header-row {
            background-color: transparent;
            height: 60px;
        }

        .header-row td {
            background-color: transparent !important;
            border-color: #000000;
        }

        .header-connector .connector-symbol-svg {
            opacity: 1;
        }

        .header-connector .connector-symbol-svg polygon {
            fill: #6b7280 !important;
            stroke: #6b7280 !important;
            stroke-width: 2;
        }

        /* Page container styling */
        .page-container {
            margin-bottom: 20px;
        }

        /* Flow table border styling */
        .flow-table {
            border-collapse: collapse !important;
            border: 1px solid #000000 !important;
        }

        .flow-table th,
        .flow-table td {
            border: 1px solid #000000 !important;
            background-color: transparent !important;
        }

        /* Border utility classes */
        .border {
            border-width: 1px !important;
        }

        .border-gray-400,
        .border-black {
            border-color: #000000 !important;
        }

        /* Print styles for header and footer connectors */
        @media print {
            .footer-row,
            .header-row {
                background-color: transparent !important;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .footer-connector .connector-symbol-svg polygon,
            .header-connector .connector-symbol-svg polygon {
                fill: none !important;
                stroke: #000000 !important;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .page-container {
                margin-bottom: 0 !important;
            }

            /* Ensure all table borders are visible in print */
            .flow-table,
            .flow-table th,
            .flow-table td,
            table,
            thead,
            tbody,
            tfoot,
            tr,
            th,
            td {
                border: 1px solid #000000 !important;
                border-collapse: collapse !important;
                background-color: transparent !important;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* Row height settings for print */
            .print-area2 tbody tr:not(.header-row):not(.footer-row) {
                height: 70px !important;
                min-height: 70px !important;
            }

            .print-area2 thead tr {
                height: auto !important;
                min-height: 40px !important;
            }

            .print-area2 .header-row,
            .print-area2 .footer-row {
                height: 60px !important;
                min-height: 60px !important;
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
                <!-- Pages will be generated dynamically by JavaScript -->
            </div>
        </div>
    </div>

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

            // Prepare flow data from PHP
            const flowData = [
                @foreach($flows as $flow)
                {
                    id: {{ $flow->id ?? 'null' }},
                    no_urutan: {{ $flow->no_urutan ?? 0 }},
                    uraian_kegiatan: `{{ addslashes($flow->uraian_kegiatan ?? '') }}`,
                    symbols: @json($flow->symbols ?? []),
                    return_to: @json($flow->return_to ?? []),
                    kelengkapan: `{{ addslashes($flow->kelengkapan ?? '') }}`,
                    waktu: `{{ addslashes($flow->waktu ?? '') }}`,
                    output: `{{ addslashes($flow->output ?? '') }}`,
                    keterangan: `{{ addslashes($flow->keterangan ?? '') }}`
                },
                @endforeach
            ];

            const pelaksanaData = [
                @foreach($esop->pelaksanas as $pelaksana)
                {
                    id: {{ $pelaksana->id }},
                    isi: `{{ addslashes($pelaksana->isi) }}`
                },
                @endforeach
            ];

            const ROWS_PER_PAGE = 7; // Number of flow rows per page for optimal printing

            // Generate pages
            generateFlowPages(flowData, pelaksanaData, ROWS_PER_PAGE);

            // Draw connection lines after page generation
            setTimeout(() => {
                drawAllPageConnections();
            }, 100); // Reduced timeout for faster rendering
        });

        // Utility function to convert symbols data to array format
        function normalizeSymbolsArray(symbols) {
            if (Array.isArray(symbols)) {
                return symbols;
            } else if (typeof symbols === 'object' && symbols !== null) {
                const maxIndex = Math.max(...Object.keys(symbols).map(k => parseInt(k)));
                const symbolsArray = new Array(maxIndex + 1).fill('');
                Object.keys(symbols).forEach(key => {
                    symbolsArray[parseInt(key)] = symbols[key];
                });
                return symbolsArray;
            }
            return [];
        }

        function generateFlowPages(flowData, pelaksanaData, rowsPerPage) {
            // Store flow data globally for header connector logic
            window.globalFlowData = flowData;

            const pagesContainer = document.getElementById('pages-container');
            pagesContainer.innerHTML = '';

            const totalRows = Math.max(4, flowData.length);
            const totalPages = Math.ceil(totalRows / rowsPerPage);

            for (let pageNum = 1; pageNum <= totalPages; pageNum++) {
                const startIndex = (pageNum - 1) * rowsPerPage;
                const endIndex = Math.min(startIndex + rowsPerPage, totalRows);
                const pageFlows = [];

                for (let i = startIndex; i < endIndex; i++) {
                    pageFlows.push(flowData[i] || null);
                }

                const pageDiv = createPageDiv(pageNum, pageFlows, pelaksanaData, totalPages);
                pagesContainer.appendChild(pageDiv);
            }
        }

        function createPageDiv(pageNum, flows, pelaksanas, totalPages) {
            const pageDiv = document.createElement('div');
            pageDiv.className = 'page-container print-area2';
            pageDiv.id = `page-${pageNum}`;

            // Calculate pelaksana column width
            const pelaksanaPersen = pelaksanas.length > 0 ? 30 / pelaksanas.length : 0;

            let colGroupHTML = `
                <colgroup>
                    <col style="width: 2%" />
                    <col style="width: 13%" />
                    ${pelaksanas.map(() => `<col style="width: ${pelaksanaPersen}%" />`).join('')}
                    <col style="width: 5%" />
                    <col style="width: 5%" />
                    <col style="width: 5%" />
                    <col style="width: 5%" />
                </colgroup>
            `;

            let headerHTML = `
                <thead>
                    <tr class="text-center font-semibold">
                        <th rowspan="2" class="border border-black px-2 py-1 align-middle">No</th>
                        <th rowspan="2" class="border border-black px-2 py-1 align-middle">Uraian Kegiatan</th>
                        <th colspan="${pelaksanas.length}" class="border border-black px-2 py-1">Pelaksana</th>
                        <th colspan="3" class="border border-black px-2 py-1">Mutu Baku</th>
                        <th rowspan="2" class="border border-black px-2 py-1">Keterangan</th>
                    </tr>
                    <tr class="text-center">
                        ${pelaksanas.map(p => `<th class="border border-black px-2 py-1">${p.isi}</th>`).join('')}
                        <th class="border border-black px-2 py-1">Kelengkapan</th>
                        <th class="border border-black px-2 py-1">Waktu</th>
                        <th class="border border-black px-2 py-1">Output</th>
                    </tr>
                </thead>
            `;

            let bodyHTML = '<tbody>';

            // Add header connector for page > 1
            if (pageNum > 1) {
                bodyHTML += createHeaderConnectorRow(flows, pelaksanas, pageNum, window.globalFlowData || []);
            }

            // Add flow rows
            flows.forEach((flow, index) => {
                const actualRowNum = (pageNum - 1) * 6 + index + 1;
                bodyHTML += createFlowRow(flow, actualRowNum, pelaksanas);
            });

            // Add footer connector (only if not the last page)
            if (pageNum < totalPages) {
                bodyHTML += createFooterConnectorRow(flows, pelaksanas);
            }

            bodyHTML += '</tbody>';

            pageDiv.innerHTML = `
                <div class="main-content rounded-sm bg-white p-4 shadow-sm">
                    <div class="table-container" style="position: relative;">
                        <canvas class="page-canvas pointer-events-none absolute top-0 left-0 z-10" id="canvas-page-${pageNum}"></canvas>
                        <table class="flow-table border border-gray-400 text-sm text-gray-800" style="width: 100%;">
                            ${colGroupHTML}
                            ${headerHTML}
                            ${bodyHTML}
                        </table>
                    </div>
                </div>
            `;

            return pageDiv;
        }

        function createHeaderConnectorRow(flows, pelaksanas, pageNum, allFlowData) {
            // Find the column where connector should be placed (same as last active from previous page)
            let connectorColumn = 0;

            // Calculate which flows belong to previous pages
            const rowsPerPage = 7;
            const previousPageLastRowIndex = (pageNum - 1) * rowsPerPage - 1;

            // Find the last active symbol from previous pages
            for (let rowIndex = previousPageLastRowIndex; rowIndex >= 0; rowIndex--) {
                if (allFlowData[rowIndex] && allFlowData[rowIndex].symbols) {
                    const symbolsArray = normalizeSymbolsArray(allFlowData[rowIndex].symbols);

                    for (let i = symbolsArray.length - 1; i >= 0; i--) {
                        if (symbolsArray[i] && symbolsArray[i] !== '') {
                            connectorColumn = i;
                            break;
                        }
                    }
                    if (connectorColumn > 0 || (symbolsArray[0] && symbolsArray[0] !== '')) {
                        break;
                    }
                }
            }

            let pelaksanaHTML = '';
            pelaksanas.forEach((pelaksana, index) => {
                if (index === connectorColumn) {
                    pelaksanaHTML += `
                        <td class="border border-black px-2 py-1">
                            <div class="symbol-preview header-connector">
                                <svg class="connector-symbol-svg mx-auto" width="40" height="40" viewBox="0 0 40 40">
                                    <polygon points="0,0 40,0 40,20 20,40 0,20"
                                             fill="none"
                                             stroke="#000"
                                             stroke-width="2"/>
                                </svg>
                            </div>
                        </td>
                    `;
                } else {
                    pelaksanaHTML += `<td class="border border-black px-2 py-1"></td>`;
                }
            });

            return `
                <tr class="header-row">
                    <td class="border border-black px-2 py-1"></td>
                    <td class="border border-black px-2 py-1"></td>
                    ${pelaksanaHTML}
                    <td class="border border-black px-2 py-1"></td>
                    <td class="border border-black px-2 py-1"></td>
                    <td class="border border-black px-2 py-1"></td>
                    <td class="border border-black px-2 py-1"></td>
                </tr>
            `;
        }

        function createFooterConnectorRow(flows, pelaksanas) {
            // Find the last active column in current page flows
            let connectorColumn = 0;

            // Find the last active symbol from current page
            for (let rowIndex = flows.length - 1; rowIndex >= 0; rowIndex--) {
                const rowData = flows[rowIndex];
                if (rowData && rowData.symbols) {
                    const symbolsArray = normalizeSymbolsArray(rowData.symbols);

                    for (let i = symbolsArray.length - 1; i >= 0; i--) {
                        if (symbolsArray[i] && symbolsArray[i] !== '') {
                            connectorColumn = i;
                            break;
                        }
                    }
                    if (connectorColumn > 0 || (symbolsArray[0] && symbolsArray[0] !== '')) {
                        break;
                    }
                }
            }

            let pelaksanaHTML = '';
            pelaksanas.forEach((pelaksana, index) => {
                if (index === connectorColumn) {
                    pelaksanaHTML += `
                        <td class="border border-black px-2 py-1">
                            <div class="symbol-preview footer-connector">
                                <svg class="connector-symbol-svg mx-auto" width="40" height="40" viewBox="0 0 40 40">
                                    <polygon points="0,0 40,0 40,20 20,40 0,20"
                                             fill="none"
                                             stroke="#000"
                                             stroke-width="2"/>
                                </svg>
                            </div>
                        </td>
                    `;
                } else {
                    pelaksanaHTML += `<td class="border border-black px-2 py-1"></td>`;
                }
            });

            return `
                <tr class="footer-row">
                    <td class="border border-black px-2 py-1"></td>
                    <td class="border border-black px-2 py-1"></td>
                    ${pelaksanaHTML}
                    <td class="border border-black px-2 py-1"></td>
                    <td class="border border-black px-2 py-1"></td>
                    <td class="border border-black px-2 py-1"></td>
                    <td class="border border-black px-2 py-1"></td>
                </tr>
            `;
        }

        function createFlowRow(flow, rowNumber, pelaksanas) {
            let pelaksanaHTML = '';
            pelaksanas.forEach((pelaksana, index) => {
                const savedSymbol = flow && flow.symbols ? flow.symbols[index] || '' : '';
                const savedReturnTo = flow && flow.return_to ? flow.return_to[index] || '' : '';

                let symbolHTML = '';
                if (savedSymbol === 'start') {
                    symbolHTML = '<div class="mx-auto h-6 w-15 rounded-xl bg-blue-500"></div>';
                } else if (savedSymbol === 'process') {
                    symbolHTML = '<div class="mx-auto h-6 w-15 bg-green-500"></div>';
                } else if (savedSymbol === 'decision') {
                    symbolHTML = '<div class="mx-auto h-8 w-8 rotate-45 bg-yellow-400"></div>';
                }

                pelaksanaHTML += `
                    <td class="border border-black px-2 py-1" data-flow="${flow ? flow.id : ''}" data-pelaksana="${pelaksana.id}" data-return-to="${savedReturnTo}">
                        <div class="symbol-preview">
                            ${symbolHTML}
                        </div>
                    </td>
                `;
            });

            return `
                <tr>
                    <td class="border border-gray-400 px-2 py-1 text-center">${rowNumber}</td>
                    <td class="border border-gray-400 px-2 py-1">${flow ? flow.uraian_kegiatan : ''}</td>
                    ${pelaksanaHTML}
                    <td class="border border-gray-400 px-2 py-1">${flow ? flow.kelengkapan : ''}</td>
                    <td class="border border-gray-400 px-2 py-1">${flow ? flow.waktu : ''}</td>
                    <td class="border border-gray-400 px-2 py-1">${flow ? flow.output : ''}</td>
                    <td class="border border-gray-400 px-2 py-1">${flow ? flow.keterangan : ''}</td>
                </tr>
            `;
        }

        function drawAllPageConnections() {
            const pages = document.querySelectorAll('.page-container');
            pages.forEach((page, pageIndex) => {
                const canvas = page.querySelector('.page-canvas');
                if (canvas) {
                    drawPageConnections(canvas, page, pageIndex + 1);
                }
            });
        }

        function drawPageConnections(canvas, pageElement, pageNumber) {
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            const table = pageElement.querySelector('.flow-table');
            if (!table) return;

            // Set canvas size to match table
            const rect = table.getBoundingClientRect();
            canvas.width = rect.width;
            canvas.height = rect.height;
            canvas.style.width = rect.width + 'px';
            canvas.style.height = rect.height + 'px';

            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Get all symbols in this page
            const symbols = [];
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach((row, rowIndex) => {
                const cells = row.querySelectorAll('td');
                cells.forEach((cell, cellIndex) => {
                    const symbolPreview = cell.querySelector('.symbol-preview > div, .symbol-preview > svg');
                    if (symbolPreview && !symbolPreview.classList.contains('border-dashed')) {
                        const cellRect = cell.getBoundingClientRect();
                        const tableRect = table.getBoundingClientRect();

                        symbols.push({
                            x: cellRect.left - tableRect.left + cellRect.width / 2,
                            y: cellRect.top - tableRect.top + cellRect.height / 2,
                            type: getSymbolType(symbolPreview),
                            row: rowIndex,
                            col: cellIndex,
                            rowIndex: rowIndex,
                            colIndex: cellIndex,
                            element: symbolPreview,
                            returnTo: getReturnTo(cell),
                            isHeader: row.classList.contains('header-row'),
                            isFooter: row.classList.contains('footer-row'),
                        });
                    }
                });
            });

            // Separate symbols by type
            const headerSymbols = symbols.filter(s => s.isHeader);
            const footerSymbols = symbols.filter(s => s.isFooter);
            const regularSymbols = symbols.filter(s => !s.isHeader && !s.isFooter);

            // Draw connections
            const allFlowSymbols = [...headerSymbols, ...regularSymbols, ...footerSymbols];

            // Draw main flow connections
            for (let i = 0; i < allFlowSymbols.length - 1; i++) {
                const current = allFlowSymbols[i];
                const next = allFlowSymbols[i + 1];
                drawConnectionLine(ctx, current, next);
            }

            // Draw decision return lines
            regularSymbols.forEach((symbol) => {
                if (symbol.type === 'decision' && symbol.returnTo) {
                    const targetNumber = parseInt(symbol.returnTo);
                    const target = regularSymbols.find((s) => s.rowIndex + 1 === targetNumber);
                    if (target) {
                        drawDecisionLineWithCollisionDetection(ctx, symbol, target, regularSymbols);
                    }
                }
            });
        }

        function getSymbolType(element) {
            if (element.classList.contains('bg-blue-500')) return 'start';
            if (element.classList.contains('bg-green-500')) return 'process';
            if (element.classList.contains('bg-yellow-400')) return 'decision';
            if (element.classList.contains('connector-symbol-svg') || element.tagName === 'svg') return 'connector';
            return 'unknown';
        }

        function getReturnTo(cell) {
            const returnTo = cell.getAttribute('data-return-to');
            return returnTo || null;
        }

        function drawConnectionLine(ctx, from, to) {
            // Get symbol types and dimensions
            const fromType = getSymbolType(from.element);
            const toType = getSymbolType(to.element);
            const fromDim = getSymbolDimensions(from.element, fromType);
            const toDim = getSymbolDimensions(to.element, toType);

            // Calculate dynamic padding based on symbol height
            const fromPadding = fromDim.height / 2 + 8;
            const toPadding = toDim.height / 2 + 8;

            let startX = from.x;
            let startY = from.y + fromPadding;
            let endX = to.x;
            let endY = to.y - toPadding;

            // Save context state
            ctx.save();

            // Set clean stroke style
            ctx.strokeStyle = '#000000';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            ctx.beginPath();
            ctx.moveTo(startX, startY);

            // Check if symbols are on the same row (horizontal alignment)
            const isSameRow = Math.abs(from.row - to.row) === 0;

            if (isSameRow) {
                // Same row: draw straight horizontal line from right side of 'from' to left side of 'to'
                const isFromLeftToRight = from.x < to.x;

                let lineStartX, lineEndX, horizontalY;

                if (isFromLeftToRight) {
                    // From left to right: arrow points right (→)
                    lineStartX = from.x + fromDim.width / 2 + 8;
                    lineEndX = to.x - toDim.width / 2 - 8;
                    horizontalY = from.y;
                } else {
                    // From right to left: arrow points left (←)
                    lineStartX = from.x - fromDim.width / 2 - 8;
                    lineEndX = to.x + toDim.width / 2 + 8;
                    horizontalY = from.y;
                }

                // Draw straight horizontal line
                ctx.moveTo(lineStartX, horizontalY);
                ctx.lineTo(lineEndX, horizontalY);
                ctx.stroke();

                // Draw arrow pointing in the correct direction
                drawPreviewArrow(ctx, lineStartX, horizontalY, lineEndX, horizontalY, 1, true);
            } else {
                // Different rows: use L-shaped connection
                ctx.lineTo(startX, (startY + endY) / 2);
                ctx.lineTo(endX, (startY + endY) / 2);
                ctx.lineTo(endX, endY);
                ctx.stroke();

                // Draw arrow at the end
                drawPreviewArrow(ctx, endX, (startY + endY) / 2, endX, endY, 1, true);
            }

            // Restore context state
            ctx.restore();
        }

        function drawDecisionLineWithCollisionDetection(ctx, decisionCenter, targetSymbol, allCenters) {
            const decisionType = getSymbolType(decisionCenter.element);
            const targetType = getSymbolType(targetSymbol.element);
            const decisionDim = getSymbolDimensions(decisionCenter.element, decisionType);
            const targetDim = getSymbolDimensions(targetSymbol.element, targetType);

            const horizontalOffset = Math.max(decisionDim.width / 2 + 10, 25);
            const curveOffset = Math.max(horizontalOffset + 15, 40);

            // Check for potential collision with main flow lines (black lines)
            const useRightSide = shouldUseRightSideForDecisionLine(decisionCenter, targetSymbol, allCenters);

            ctx.save();
            ctx.strokeStyle = '#ef4444';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            let startX, startY, endX, endY, midX;

            if (useRightSide) {
                // Draw on the right side to avoid collision
                startX = decisionCenter.x + (decisionDim.width / 2 + 8);
                startY = decisionCenter.y;
                endX = targetSymbol.x + (targetDim.width / 2 + 8);
                endY = targetSymbol.y;
                midX = startX + curveOffset;
            } else {
                // Draw on the left side (original behavior)
                startX = decisionCenter.x - (decisionDim.width / 2 + 8);
                startY = decisionCenter.y;
                endX = targetSymbol.x - (targetDim.width / 2 + 8);
                endY = targetSymbol.y;
                midX = startX - curveOffset;
            }

            ctx.beginPath();
            ctx.moveTo(startX, startY);
            ctx.lineTo(midX, startY);
            ctx.lineTo(midX, endY);
            ctx.lineTo(endX, endY);
            ctx.stroke();

            drawPreviewArrow(ctx, midX, endY, endX, endY, 1, true);

            // Add "Tidak" text
            const labelText = 'Tidak';
            ctx.fillStyle = '#ef4444';
            ctx.font = '12px Arial';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            const textX = midX;
            const textY = startY + (endY - startY) * 0.3;

            // White background for text
            const textMetrics = ctx.measureText(labelText);
            const textWidth = textMetrics.width;
            const textHeight = 15;

            ctx.fillStyle = 'white';
            ctx.fillRect(textX - textWidth / 2 - 2, textY - textHeight / 2 - 1, textWidth + 4, textHeight + 2);

            ctx.fillStyle = '#ef4444';
            ctx.fillText(labelText, textX, textY);

            ctx.restore();
        }

        function shouldUseRightSideForDecisionLine(decisionCenter, targetSymbol, allCenters) {
            // Logic for decision line direction:
            // If target symbol is to the RIGHT of decision symbol, line exits from LEFT side
            // If target symbol is to the LEFT of decision symbol, line exits from RIGHT side
            if (targetSymbol.colIndex > decisionCenter.colIndex) {
                return false; // Use left side
            } else if (targetSymbol.colIndex < decisionCenter.colIndex) {
                return true; // Use right side
            } else {
                return false; // Same column, use left side as default
            }
        }

        function getSymbolDimensions(element, symbolType) {
            const actualWidth = element.offsetWidth;
            const actualHeight = element.offsetHeight;

            let expectedWidth, expectedHeight;
            switch (symbolType) {
                case 'start':
                case 'process':
                    expectedWidth = 40;
                    expectedHeight = 24;
                    break;
                case 'decision':
                    expectedWidth = 32;
                    expectedHeight = 32;
                    break;
                case 'connector':
                    expectedWidth = 40;
                    expectedHeight = 40;
                    break;
                default:
                    expectedWidth = 40;
                    expectedHeight = 24;
                    break;
            }

            return {
                width: actualWidth || expectedWidth,
                height: actualHeight || expectedHeight,
            };
        }

        function drawPreviewArrow(ctx, fromX, fromY, toX, toY, scaleX = 1, isPrintMode = false) {
            ctx.save();

            // Arrow size configuration
            const baseHeadlen = 8;
            const headlen = isPrintMode ? baseHeadlen : Math.max(baseHeadlen * scaleX, 6);
            const angle = Math.atan2(toY - fromY, toX - fromX);

            // Set arrow style
            ctx.strokeStyle = '#000000';
            ctx.lineWidth = isPrintMode ? 2 : Math.max(2 * scaleX, 2);
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            // Draw arrow head
            ctx.beginPath();
            ctx.moveTo(toX, toY);
            ctx.lineTo(toX - headlen * Math.cos(angle - Math.PI / 6), toY - headlen * Math.sin(angle - Math.PI / 6));
            ctx.moveTo(toX, toY);
            ctx.lineTo(toX - headlen * Math.cos(angle + Math.PI / 6), toY - headlen * Math.sin(angle + Math.PI / 6));
            ctx.stroke();

            ctx.restore();
        }
    </script>
</x-layout>

@php
    $jumlahPelaksana = $esop->pelaksanas->count();
@endphp

<x-layout>
    <style>
        @media print {
            /* Hide everything by default */
            body * {
                visibility: hidden;
            }

            /* Show only preview area */
            #preview-area,
            #preview-area * {
                visibility: visible;
            }

            /* Position preview area for print */
            #preview-area {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                max-width: 100%;
            }

            /* Show print header only when printing */
            .print-only {
                display: block !important;
            }

            /* Hide elements that shouldn't be printed */
            no-print,
            .debug-button,
            h3 {
                display: none !important;
            }

            /* Hide canvas during print */
            /* #flow-preview-canvas {
                display: none !important;
            } */

            /* Ensure canvas is visible during print */
            #flow-preview-canvas {
                display: block !important;
                position: absolute;
                top: 0;
                left: 0;
                pointer-events: none;
                z-index: 10;
                border: none !important;
                background: transparent !important;
            }

            /* Optimize table for print */
            #preview-tabel table {
                width: 100%;
                border-collapse: collapse;
                font-size: 10px;
                table-layout: fixed;
                min-width: 1000px;
            }

            #preview-tabel th,
            #preview-tabel td {
                border: 1px solid #000;
                padding: 4px 3px;
                font-size: 8px;
            }

            /* Set print column widths */
            #preview-tabel col:nth-child(1) {
                width: 50px;
            }
            #preview-tabel col:nth-child(2) {
                width: 250px;
            }
            #preview-tabel col:nth-child(3) {
                width: 100px;
            }
            #preview-tabel col:nth-child(4) {
                width: 100px;
            }
            #preview-tabel col:nth-child(5) {
                width: 100px;
            }
            #preview-tabel col:nth-child(6) {
                width: 150px;
            }
            #preview-tabel col:nth-child(7) {
                width: 100px;
            }
            #preview-tabel col:nth-child(8) {
                width: 120px;
            }
            #preview-tabel col:nth-child(9) {
                width: 100px;
            }

            /* Print container should allow horizontal overflow */
            .table-container {
                overflow-x: visible !important;
            }

            /* Ensure symbols are visible in print */
            .symbol-preview > div {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Better spacing for print */
            .symbol-preview {
                padding: 4px;
                text-align: center;
            }

            /* Page break controls */
            .page-break-before {
                page-break-before: always !important;
                break-before: page !important;
            }

            .page-break-avoid {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            /* Connector row styling for page breaks */
            .connector-row {
                height: 60px !important;
                background: transparent !important;
            }

            .connector-row td {
                border: none !important;
                padding: 0 !important;
                position: relative !important;
            }

            /* Buffer row styling - same as regular table rows */
            .buffer-row {
                height: 50px !important;
                background-color: white !important; /* Same as regular rows */
            }

            .buffer-row td {
                border: 1px solid #9ca3af !important; /* Same border as regular table */
                padding: 8px !important; /* Same padding as regular cells */
                vertical-align: middle !important;
                background-color: white !important;
            }

            /* Buffer row connector symbol styling */
            .buffer-row .symbol-preview {
                padding: 4px;
                text-align: center;
            }

            .buffer-row .symbol-preview > div {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Repeat table header on each page */
            #preview-tabel thead {
                display: table-header-group;
            }

            #preview-tabel tbody {
                display: table-row-group;
            }

            @page {
                size: A4 landscape;
                margin: 1cm;
            }

            /* Print styles for page preview */
            .page-preview {
                page-break-after: always !important;
                break-after: page !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                max-width: none !important;
                min-height: auto !important;
            }

            .page-preview:last-child {
                page-break-after: auto !important;
                break-after: auto !important;
            }

            .page-number {
                display: none !important;
            }

            .pages-container {
                transform: none !important;
            }
        }

        textarea {
            resize: none;
            overflow: auto;
            border: none;
            outline: none;
            min-height: 60px;
            max-height: 120px;
        }

        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            min-width: 1200px; /* Minimum width to ensure readability */
        }

        /* Container for horizontal scroll */
        .table-container {
            width: 100%;
            overflow-x: auto;
            overflow-y: visible;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            position: relative;
        }

        /* Canvas positioning for preview */
        #preview-container {
            position: relative;
            border: none;
            outline: none;
        }

        #flow-preview-canvas {
            position: absolute;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 10;
            border: none;
            outline: none;
            background: transparent;
        }

        /* Set specific column widths with better proportions */
        .flow-table col:nth-child(1) {
            width: 60px;
        } /* No */
        .flow-table col:nth-child(2) {
            width: 300px;
        } /* Uraian Kegiatan */
        .flow-table col:nth-child(3) {
            width: 120px;
        } /* Pelaksana columns */
        .flow-table col:nth-child(4) {
            width: 120px;
        }
        .flow-table col:nth-child(5) {
            width: 120px;
        }
        .flow-table col:nth-child(6) {
            width: 120px;
        } /* Kelengkapan */
        .flow-table col:nth-child(7) {
            width: 120px;
        } /* Waktu */
        .flow-table col:nth-child(8) {
            width: 120px;
        } /* Output */
        .flow-table col:nth-child(9) {
            width: 120px;
        } /* Keterangan */

        /* Ensure consistent row height */
        .flow-table tbody tr {
            height: 80px;
        }

        .flow-table tbody td {
            padding: 8px 6px;
        }

        .flow-table thead th {
            padding: 8px 6px;
            font-size: 13px;
            font-weight: 600;
        }

        /* Uraian kegiatan column specific styling */
        .uraian-column {
            width: 100% !important;
        }

        .uraian-column textarea {
            width: 100%;
            height: 60px;
            max-height: 60px;
            overflow-y: auto;
            padding: 6px;
            font-size: 13px;
            line-height: 1.4;
        }

        /* General textarea styling for consistent height */
        .flow-table textarea {
            height: 60px;
            max-height: 60px;
            min-height: 60px;
            overflow-y: auto;
            font-size: 13px;
            line-height: 1.4;
            padding: 6px;
        }

        /* Select styling for pelaksana columns */
        .flow-table select {
            font-size: 12px;
            padding: 4px;
        }

        /* Symbol preview styling */
        .symbol-preview {
            margin-top: 4px;
            display: flex;
            justify-content: center;
            position: relative;
        }

        /* Symbol numbering */
        .symbol-number {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #1f2937;
            color: white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
            z-index: 20;
        }

        /* Scalable preview container */
        .preview-wrapper {
            width: 100%;
            height: auto;
            overflow: visible;
            transform-origin: top left;
            border: none;
            outline: none;
            display: inline-block;
            min-width: min-content;
        }

        /* Preview container - direct display */
        #preview-container {
            overflow: visible !important;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            position: relative;
        }

        /* Ensure preview table auto-scales */
        .preview-wrapper .flow-table {
            min-width: auto;
            width: 100%;
            table-layout: fixed;
        }

        /* Clean preview area - remove any unwanted lines */
        #preview-area {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            overflow-x: hidden !important;
            width: 100%;
            box-sizing: border-box;
        }

        #preview-wrapper,
        #preview-container,
        #preview-tabel {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Page preview styling */
        .page-preview {
            background: white;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            page-break-after: always;
            position: relative;
            padding: 20px;
            min-height: 800px; /* Approximate A4 landscape height */
            width: 100%;
            max-width: none;
            box-sizing: border-box;
            overflow: visible;
        }

        .page-preview:last-child {
            margin-bottom: 0;
        }

        .page-number {
            position: absolute;
            bottom: 10px;
            right: 20px;
            font-size: 12px;
            color: #666;
            background: white;
            padding: 2px 6px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        /* Scale pages to fit container */
        .pages-container {
            width: 100%;
            overflow: visible;
        }

        .page-preview .flow-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            min-width: 1200px; /* Minimum width to ensure proper layout */
        }

        .page-canvas {
            position: absolute;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 10;
        }
            position: absolute;
            bottom: 10px;
            right: 20px;
            font-size: 12px;
            color: #666;
            background: white;
            padding: 2px 6px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        /* Scale pages to fit container */
        .pages-container {
            transform-origin: top left;
            transition: transform 0.3s ease;
        }

        .page-preview .flow-table {
            width: 100%;
            border-collapse: collapse;
        }

        .page-canvas {
            position: absolute;
            top: 20px;
            left: 20px;
            pointer-events: none;
            z-index: 10;
            border: none;
            outline: none;
            background: transparent;
        }
    </style>

    <div id="editor-tabel">
        <form id="esopForm" action="{{ route('flow.update', $esop->id) }}" method="POST">
            @csrf
            <div class="main-content rounded-sm bg-white p-4 shadow-sm">
                <a
                    href="{{ route('esop.edit', ['id' => $esop->id]) }}"
                    class="no-print mb-3 inline-block rounded-sm bg-gray-500 px-3 py-2 text-sm font-semibold text-white hover:bg-gray-400"
                >
                    Kembali
                </a>

                <button
                    type="button"
                    class="no-print mb-3 cursor-pointer rounded-sm bg-green-600 px-3 py-2 text-sm font-semibold text-white hover:bg-green-500"
                    onclick="printPreview()"
                >
                    Cetak
                </button>

                <div class="table-container">
                    <table class="flow-table border border-gray-400 text-sm text-gray-800">
                        <colgroup>
                            <col style="width: 60px" />
                            <!-- No -->
                            <col style="width: 300px" />
                            <!-- Uraian Kegiatan -->
                            @for ($i = 0; $i < $jumlahPelaksana; $i++)
                                <col style="width: 120px" />
                                <!-- Pelaksana columns -->
                            @endfor

                            <col style="width: 180px" />
                            <!-- Kelengkapan -->
                            <col style="width: 120px" />
                            <!-- Waktu -->
                            <col style="width: 150px" />
                            <!-- Output -->
                            <col style="width: 120px" />
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
                                <th colspan="4" class="border border-gray-400 px-2 py-1">Mutu Baku</th>
                            </tr>
                            <tr class="bg-gray-100 text-center">
                                @foreach ($esop->pelaksanas as $pelaksana)
                                    <th class="border border-gray-400 px-2 py-1">{{ $pelaksana->isi }}</th>
                                @endforeach

                                <th class="border border-gray-400 px-2 py-1">Kelengkapan</th>
                                <th class="border border-gray-400 px-2 py-1">Waktu</th>
                                <th class="border border-gray-400 px-2 py-1">Output</th>
                                <th class="border border-gray-400 px-2 py-1">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-flow">
                            @php
                                $jumlahBaris = max(4, $flows->max('no_urutan') ?? 0);
                            @endphp

                            @for ($i = 1; $i <= $jumlahBaris; $i++)
                                @php
                                    $flow = $flows[$i] ?? null;
                                @endphp

                                <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-white' }}">
                                    <td class="border border-gray-400 px-2 py-1 text-center">{{ $i }}</td>
                                    <td class="uraian-column border border-gray-400 px-2 py-1">
                                        <textarea
                                            type="text"
                                            name="uraian_kegiatan_{{ $i }}"
                                            id="uraian_kegiatan_{{ $i }}"
                                            placeholder="Uraian Kegiatan {{ $i }}"
                                            class="form-control block w-full resize-none rounded-md bg-white px-3 py-2 text-sm text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600"
                                        >
{{ $flow->uraian_kegiatan ?? '' }}</textarea
                                        >
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
                                                <option value="start" {{ $savedSymbol == 'start' ? 'selected' : '' }}>
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
                                                <div class="symbol-number">
                                                    {{ ($i - 1) * $jumlahPelaksana + $index + 1 }}
                                                </div>
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
                                        <textarea
                                            type="text"
                                            name="kelengkapan_{{ $i }}"
                                            id="kelengkapan_{{ $i }}"
                                            placeholder="Kelengkapan {{ $i }}"
                                            class="form-control block w-full resize-none rounded-md bg-white px-3 py-2 text-sm text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600"
                                        >
{{ $flow->kelengkapan ?? '' }}</textarea
                                        >
                                    </td>
                                    <td class="border border-gray-400 px-2 py-1">
                                        <textarea
                                            type="text"
                                            name="waktu_{{ $i }}"
                                            id="waktu_{{ $i }}"
                                            placeholder="Waktu {{ $i }}"
                                            class="form-control block w-full resize-none rounded-md bg-white px-3 py-2 text-sm text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600"
                                        >
{{ $flow->waktu ?? '' }}</textarea
                                        >
                                    </td>
                                    <td class="border border-gray-400 px-2 py-1">
                                        <textarea
                                            type="text"
                                            name="output_{{ $i }}"
                                            id="output_{{ $i }}"
                                            placeholder="Output {{ $i }}"
                                            class="form-control block w-full resize-none rounded-md bg-white px-3 py-2 text-sm text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600"
                                        >
{{ $flow->output ?? '' }}</textarea
                                        >
                                    </td>
                                    <td class="border border-gray-400 px-2 py-1">
                                        <textarea
                                            type="text"
                                            name="keterangan_{{ $i }}"
                                            id="keterangan_{{ $i }}"
                                            placeholder="Keterangan {{ $i }}"
                                            class="form-control block w-full resize-none rounded-md bg-white px-3 py-2 text-sm text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600"
                                        >
{{ $flow->keterangan ?? '' }}</textarea
                                        >
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <div class="flex justify-start space-x-2">
                        <button
                            type="button"
                            onclick="removeRow()"
                            class="rounded-md border border-blue-500 px-3 py-2 text-sm text-blue-500 hover:bg-indigo-50"
                        >
                            - Hapus Baris
                        </button>
                        <button
                            type="button"
                            onclick="addRow()"
                            class="rounded-md border border-blue-500 px-3 py-2 text-sm text-blue-500 hover:bg-indigo-50"
                        >
                            + Tambah Baris
                        </button>
                    </div>
                    <button
                        type="submit"
                        id="simpanButton"
                        onclick="showSuccessAlert()"
                        class="rounded-sm bg-blue-500 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-400"
                    >
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="main-content mt-4 rounded-sm bg-white p-4 shadow-sm">
        <div class="mb-4 flex items-center justify-between">
            <h3 class="text-xl font-semibold">Preview Print</h3>
            <button
                onclick="printPreview()"
                class="rounded-sm bg-green-500 px-3 py-2 text-sm font-semibold text-white hover:bg-green-400"
            >
                Print Preview
            </button>
        </div>

        <div id="preview-area">
            <div class="preview-wrapper" id="preview-wrapper">
                <div id="pages-container" class="pages-container">
                    <!-- Pages will be dynamically generated here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        let rowCount = {{ $flows->keys()->max() ?? 0 }};
        const jumlahPelaksana = {{ $esop->pelaksanas->count() }};
        const pelaksanaIds = @json($esop->pelaksanas->pluck('id'));

        // Debounce function to prevent excessive auto-scaling calls
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Auto-scale preview to fit screen
        function autoScalePreview() {
            const previewArea = document.getElementById('preview-area');
            const previewWrapper = document.getElementById('preview-wrapper');
            const pagesContainer = document.getElementById('pages-container');

            if (previewArea && previewWrapper && pagesContainer) {
                // Reset scale first
                previewWrapper.style.transform = 'scale(1)';

                // Force layout recalculation
                previewWrapper.offsetHeight;

                // Get dimensions for auto-scaling
                const containerWidth = previewArea.clientWidth - 40; // Padding for pages
                const firstPage = pagesContainer.querySelector('.page-preview');

                if (firstPage) {
                    // Wait for layout to settle
                    setTimeout(() => {
                        const pageWidth = firstPage.scrollWidth;
                        const pageHeight = firstPage.scrollHeight;

                        if (pageWidth > 0) {
                            // Calculate scale to fit screen with maximum scale of 1
                            const scale = Math.min(1, containerWidth / pageWidth);

                            // Apply scale with proper transform origin
                            previewWrapper.style.transform = `scale(${scale})`;
                            previewWrapper.style.transformOrigin = 'top left';

                            // Redraw connections after scaling
                            setTimeout(() => {
                                drawAllPageConnections();
                            }, 100);
                        }
                    }, 50);
                }
            }
        }

        // Debounced version of autoScalePreview
        const debouncedAutoScale = debounce(autoScalePreview, 150);

        function addRow() {
            rowCount++;
            const tbody = document.getElementById('tbody-flow');
            const row = document.createElement('tr');
            row.className = 'bg-white';

            let html = `
                <td class="border border-gray-400 px-2 py-1 text-center">${rowCount}</td>
                <td class="border border-gray-400 px-2 py-1 uraian-column">
                    <textarea name="uraian_kegiatan_${rowCount}" placeholder="Uraian Kegiatan ${rowCount}" class="form-control block w-full resize-none rounded-md bg-white px-3 py-2 text-sm text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600"></textarea>
                </td>
            `;

            for (let i = 0; i < jumlahPelaksana; i++) {
                html += `
                    <td class="border border-gray-400 px-2 py-1" data-pelaksana="${pelaksanaIds[i]}">
                        <select name="symbol_${rowCount}_${i}" onchange="updateSymbol(this)" class="w-full text-sm">
                            <option value="">Pilih</option>
                            <option value="start">Mulai</option>
                            <option value="process">Proses</option>
                            <option value="decision">Pilihan</option>
                        </select>
                        <div class="symbol-preview">
                            <div class="w-15 h-6 border-2 border-gray-300 border-dashed mx-auto"></div>
                            <div class="symbol-number">${(rowCount - 1) * jumlahPelaksana + i + 1}</div>
                        </div>
                    </td>`;
            }

            html += `
                <td class="border border-gray-400 px-2 py-1"><textarea name="kelengkapan_${rowCount}" placeholder="Kelengkapan ${rowCount}" class="form-control block w-full resize-none rounded-md bg-white px-3 py-2 text-sm text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600"></textarea></td>
                <td class="border border-gray-400 px-2 py-1"><textarea name="waktu_${rowCount}" placeholder="Waktu ${rowCount}" class="form-control block w-full resize-none rounded-md bg-white px-3 py-2 text-sm text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600"></textarea></td>
                <td class="border border-gray-400 px-2 py-1"><textarea name="output_${rowCount}" placeholder="Output ${rowCount}" class="form-control block w-full resize-none rounded-md bg-white px-3 py-2 text-sm text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600"></textarea></td>
                <td class="border border-gray-400 px-2 py-1"><textarea name="keterangan_${rowCount}" placeholder="Keterangan ${rowCount}" class="form-control block w-full resize-none rounded-md bg-white px-3 py-2 text-sm text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600"></textarea></td>
            `;

            row.innerHTML = html;
            tbody.appendChild(row);

            addEventListenersToRow(row);
            syncPreviewTable();
            setTimeout(debouncedAutoScale, 300);
        }

        function removeRow() {
            const tbody = document.getElementById('tbody-flow');
            if (tbody.lastElementChild) {
                tbody.removeChild(tbody.lastElementChild);
                rowCount--;
                syncPreviewTable();
                setTimeout(debouncedAutoScale, 300);
            }
        }

        function addEventListenersToRow(row) {
            row.querySelectorAll('textarea, input[name^="return_to_"], select').forEach((element) => {
                const eventType = element.tagName === 'SELECT' ? 'change' : 'input';
                element.addEventListener(eventType, syncPreviewTable);
            });
        }

        function updateSymbol(selectElement) {
            const symbolPreview = selectElement.nextElementSibling;
            const value = selectElement.value;
            const nameAttr = selectElement.getAttribute('name');
            const match = nameAttr.match(/symbol_(\d+)_(\d+)/);
            const rowNumber = match ? parseInt(match[1]) : 1;
            const colIndex = match ? parseInt(match[2]) : 0;
            const globalNumber = (rowNumber - 1) * jumlahPelaksana + colIndex + 1;

            let symbolHtml = '';
            switch (value) {
                case 'start':
                    symbolHtml = `<div class="w-15 h-6 bg-blue-500 rounded-xl mx-auto"></div>`;
                    break;
                case 'process':
                    symbolHtml = `<div class="w-15 h-6 bg-green-500 mx-auto"></div>`;
                    break;
                case 'decision':
                    symbolHtml = `<div class="w-8 h-8 bg-yellow-400 rotate-45 mx-auto"></div>`;
                    break;
                default:
                    symbolHtml = `<div class="w-15 h-6 border-2 border-gray-300 border-dashed mx-auto"></div>`;
            }

            symbolHtml += `<div class="symbol-number">${globalNumber}</div>`;
            symbolPreview.innerHTML = symbolHtml;

            const cell = selectElement.closest('td');
            let returnInput = cell.querySelector('input[name^="return_to_"]');

            if (value === 'decision') {
                if (!returnInput) {
                    const inputDiv = document.createElement('div');
                    inputDiv.className = 'mt-2';
                    inputDiv.innerHTML = `
                        <input type="number" name="return_to_${rowNumber}_${colIndex}" placeholder="Kembali ke nomor" min="1" class="w-full text-xs px-2 py-1 border border-gray-300 rounded" onchange="syncPreviewTable()">
                    `;
                    cell.appendChild(inputDiv);
                }
            } else if (returnInput) {
                returnInput.closest('div').remove();
            }

            syncPreviewTable();
        }

        function syncPreviewTable() {
            const editorRows = document.querySelectorAll('#editor-tabel tbody tr');
            const pagesContainer = document.getElementById('pages-container');
            pagesContainer.innerHTML = '';

            const rowsPerPage = 8;
            const processedRowsData = [];

            editorRows.forEach((row, rowIndex) => {
                const cells = row.querySelectorAll('td');
                const rowData = {
                    number: rowIndex + 1,
                    uraianKegiatan: '',
                    pelaksanas: [],
                    kelengkapan: '',
                    waktu: '',
                    output: '',
                    keterangan: '',
                };

                cells.forEach((cell, cellIndex) => {
                    const select = cell.querySelector('select');
                    const textarea = cell.querySelector('textarea');
                    const returnInput = cell.querySelector('input[name^="return_to_"]');

                    if (cellIndex === 1) {
                        rowData.uraianKegiatan = textarea ? textarea.value : '';
                    } else if (cellIndex >= 2 && cellIndex < 2 + jumlahPelaksana) {
                        const pelaksanaIndex = cellIndex - 2;
                        const globalNumber = rowIndex * jumlahPelaksana + pelaksanaIndex + 1;
                        rowData.pelaksanas[pelaksanaIndex] = {
                            value: select ? select.value : '',
                            returnTo: returnInput ? returnInput.value : '',
                            globalNumber: globalNumber,
                        };
                    } else if (cellIndex === 2 + jumlahPelaksana) {
                        rowData.kelengkapan = textarea ? textarea.value : '';
                    } else if (cellIndex === 3 + jumlahPelaksana) {
                        rowData.waktu = textarea ? textarea.value : '';
                    } else if (cellIndex === 4 + jumlahPelaksana) {
                        rowData.output = textarea ? textarea.value : '';
                    } else if (cellIndex === 5 + jumlahPelaksana) {
                        rowData.keterangan = textarea ? textarea.value : '';
                    }
                });

                processedRowsData.push(rowData);
            });

            const pages = [];
            for (let i = 0; i < processedRowsData.length; i += rowsPerPage) {
                const pageRows = processedRowsData.slice(i, i + rowsPerPage);
                pages.push({
                    number: Math.floor(i / rowsPerPage) + 1,
                    rows: pageRows,
                    needsConnector: i + rowsPerPage < processedRowsData.length,
                });
            }

            pages.forEach((page, pageIndex) => {
                const pageDiv = createPageElement(page, pageIndex === pages.length - 1);
                pagesContainer.appendChild(pageDiv);
            });

            setTimeout(() => {
                drawAllPageConnections();
                debouncedAutoScale();
            }, 200);
        }

        function createPageElement(page, isLastPage) {
            const pageDiv = document.createElement('div');
            pageDiv.className = 'page-preview';
            pageDiv.id = `page-${page.number}`;

            // Create table header
            const tableHeader = `
                <colgroup>
                    <col style="width: 60px" />
                    <col style="width: 300px" />
                    ${Array(jumlahPelaksana).fill('<col style="width: 120px" />').join('')}
                    <col style="width: 180px" />
                    <col style="width: 120px" />
                    <col style="width: 150px" />
                    <col style="width: 120px" />
                </colgroup>
                <thead>
                    <tr class="bg-gray-100 text-center font-semibold">
                        <th rowspan="2" class="border border-gray-400 px-2 py-1 align-middle">No</th>
                        <th rowspan="2" class="border border-gray-400 px-2 py-1 align-middle">Uraian Kegiatan</th>
                        <th colspan="${jumlahPelaksana}" class="border border-gray-400 px-2 py-1">Pelaksana</th>
                        <th colspan="4" class="border border-gray-400 px-2 py-1">Mutu Baku</th>
                    </tr>
                    <tr class="bg-gray-100 text-center">
                        ${(() => {
                            const pelaksanas = @json($esop->pelaksanas);
                            return pelaksanas
                                .map(
                                    (pelaksana) => `<th class="border border-gray-400 px-2 py-1">${pelaksana.isi}</th>`,
                                )
                                .join('');
                        })()}
                        <th class="border border-gray-400 px-2 py-1">Kelengkapan</th>
                        <th class="border border-gray-400 px-2 py-1">Waktu</th>
                        <th class="border border-gray-400 px-2 py-1">Output</th>
                        <th class="border border-gray-400 px-2 py-1">Keterangan</th>
                    </tr>
                </thead>
            `;

            // Create table body
            let tableBody = '<tbody>';

            // Add connector row for continuation pages
            if (page.number > 1) {
                // Get all processed data to find the last active symbol from previous pages
                const allRowsData = [];
                const editorRows = document.querySelectorAll('#editor-tabel tbody tr');
                editorRows.forEach((row, rowIndex) => {
                    const cells = row.querySelectorAll('td');
                    const rowData = { pelaksanas: [] };

                    cells.forEach((cell, cellIndex) => {
                        const select = cell.querySelector('select');
                        if (cellIndex >= 2 && cellIndex < 2 + jumlahPelaksana) {
                            const pelaksanaIndex = cellIndex - 2;
                            rowData.pelaksanas[pelaksanaIndex] = {
                                value: select ? select.value : '',
                            };
                        }
                    });
                    allRowsData.push(rowData);
                });

                const rowsPerPage = 8;
                const previousPageLastRowIndex = (page.number - 1) * rowsPerPage - 1;
                let connectorColumn = 0;

                // Find the last active symbol from previous pages
                for (let rowIndex = previousPageLastRowIndex; rowIndex >= 0; rowIndex--) {
                    if (allRowsData[rowIndex] && allRowsData[rowIndex].pelaksanas) {
                        for (let i = allRowsData[rowIndex].pelaksanas.length - 1; i >= 0; i--) {
                            if (allRowsData[rowIndex].pelaksanas[i] && allRowsData[rowIndex].pelaksanas[i].value) {
                                connectorColumn = i;
                                break;
                            }
                        }
                        if (
                            connectorColumn > 0 ||
                            (allRowsData[rowIndex].pelaksanas[0] && allRowsData[rowIndex].pelaksanas[0].value)
                        ) {
                            break;
                        }
                    }
                }

                tableBody += createConnectorRowHTML(connectorColumn);
            }

            // Add regular rows
            page.rows.forEach((rowData) => {
                tableBody += createRowHTML(rowData);
            });

            // Add connector row for pages that continue to next page
            if (page.needsConnector && !isLastPage) {
                // Find the last active symbol from current page
                let connectorColumn = 0;
                for (let rowIndex = page.rows.length - 1; rowIndex >= 0; rowIndex--) {
                    const rowData = page.rows[rowIndex];
                    if (rowData && rowData.pelaksanas) {
                        for (let i = rowData.pelaksanas.length - 1; i >= 0; i--) {
                            if (rowData.pelaksanas[i] && rowData.pelaksanas[i].value) {
                                connectorColumn = i;
                                break;
                            }
                        }
                        if (connectorColumn > 0 || (rowData.pelaksanas[0] && rowData.pelaksanas[0].value)) {
                            break;
                        }
                    }
                }

                tableBody += createConnectorRowHTML(connectorColumn);
            }

            tableBody += '</tbody>';

            pageDiv.innerHTML = `
                <table class="flow-table border border-gray-400 text-sm text-gray-800">
                    ${tableHeader}
                    ${tableBody}
                </table>
                <canvas class="page-canvas" id="canvas-page-${page.number}"></canvas>
                <div class="page-number">Halaman ${page.number}</div>
            `;

            return pageDiv;
        }

        function createRowHTML(rowData) {
            let pelaksanaHTML = '';
            rowData.pelaksanas.forEach((pelaksana, index) => {
                let symbolHTML = '';
                if (pelaksana.value === 'start') {
                    symbolHTML = `<div class="w-15 h-6 bg-blue-500 rounded-xl mx-auto"></div>`;
                } else if (pelaksana.value === 'process') {
                    symbolHTML = `<div class="w-15 h-6 bg-green-500 mx-auto"></div>`;
                } else if (pelaksana.value === 'decision') {
                    symbolHTML = `<div class="w-8 h-8 bg-yellow-400 rotate-45 mx-auto"></div>`;
                } else {
                    symbolHTML = '';
                }

                // Add symbol number if symbol exists
                if (symbolHTML) {
                    symbolHTML += `<div class="symbol-number">${pelaksana.globalNumber}</div>`;
                }

                pelaksanaHTML += `
                    <td class="border border-gray-400 px-2 py-1">
                        ${symbolHTML ? `<div class="symbol-preview relative px-2 py-1">${symbolHTML}</div>` : '<div class="px-2 py-1"></div>'}
                    </td>
                `;
            });

            return `
                <tr class="page-break-avoid">
                    <td class="border border-gray-400 px-2 py-1 text-center">${rowData.number}</td>
                    <td class="border border-gray-400 px-2 py-1">
                        <div class="px-2 py-1 text-sm min-h-[3rem] whitespace-pre-wrap">${rowData.uraianKegiatan}</div>
                    </td>
                    ${pelaksanaHTML}
                    <td class="border border-gray-400 px-2 py-1">
                        <div class="px-2 py-1 text-sm min-h-[3rem] whitespace-pre-wrap">${rowData.kelengkapan}</div>
                    </td>
                    <td class="border border-gray-400 px-2 py-1">
                        <div class="px-2 py-1 text-sm min-h-[3rem] whitespace-pre-wrap">${rowData.waktu}</div>
                    </td>
                    <td class="border border-gray-400 px-2 py-1">
                        <div class="px-2 py-1 text-sm min-h-[3rem] whitespace-pre-wrap">${rowData.output}</div>
                    </td>
                    <td class="border border-gray-400 px-2 py-1">
                        <div class="px-2 py-1 text-sm min-h-[3rem] whitespace-pre-wrap">${rowData.keterangan}</div>
                    </td>
                </tr>
            `;
        }

        function createConnectorRowHTML(connectorColumn = 0) {
            let pelaksanaHTML = '';
            for (let i = 0; i < jumlahPelaksana; i++) {
                if (i === connectorColumn) {
                    pelaksanaHTML += `
                        <td class="border border-gray-400 px-2 py-1">
                            <div class="symbol-preview">
                                <div class="w-10 h-10 bg-gray-500 [clip-path:polygon(0%_0%,100%_0%,100%_50%,50%_100%,0%_50%)] mx-auto"></div>
                            </div>
                        </td>
                    `;
                } else {
                    pelaksanaHTML += `<td class="border border-gray-400 px-2 py-1"></td>`;
                }
            }

            return `
                <tr class="buffer-row">
                    <td class="border border-gray-400 px-2 py-1"></td>
                    <td class="border border-gray-400 px-2 py-1"></td>
                    ${pelaksanaHTML}
                    <td class="border border-gray-400 px-2 py-1"></td>
                    <td class="border border-gray-400 px-2 py-1"></td>
                    <td class="border border-gray-400 px-2 py-1"></td>
                    <td class="border border-gray-400 px-2 py-1"></td>
                </tr>
            `;
        }

        function getLastActiveSymbolColumnFromData(rowData, allRowsData, currentRowIndex) {
            // First check the current row for any active symbols
            for (let i = rowData.pelaksanas.length - 1; i >= 0; i--) {
                if (rowData.pelaksanas[i] && rowData.pelaksanas[i].value) {
                    return i;
                }
            }

            // If no active symbol in current row, look backwards through all previous rows
            for (let rowIndex = currentRowIndex - 1; rowIndex >= 0; rowIndex--) {
                const previousRowData = allRowsData[rowIndex];
                if (previousRowData && previousRowData.pelaksanas) {
                    // Check from right to left to find the last active symbol
                    for (let i = previousRowData.pelaksanas.length - 1; i >= 0; i--) {
                        if (previousRowData.pelaksanas[i] && previousRowData.pelaksanas[i].value) {
                            return i;
                        }
                    }
                }
            }

            return 0;
        }

        function createPageBreakRow() {
            const row = document.createElement('tr');
            row.className = 'page-break-before';
            row.style.height = '0px';
            row.style.pageBreakBefore = 'always';

            // Create a single cell that spans all columns
            const totalColumns = 2 + jumlahPelaksana + 4; // No + Uraian + Pelaksana + Mutu Baku (4 cols)
            row.innerHTML = `<td colspan="${totalColumns}" style="height: 0px; border: none; padding: 0;"></td>`;

            return row;
        }

        function getLastActiveSymbolColumn(editorRows, currentRowIndex) {
            // Look backwards from current row to find the last active symbol
            for (let rowIndex = currentRowIndex - 1; rowIndex >= 0; rowIndex--) {
                const row = editorRows[rowIndex];
                const cells = row.querySelectorAll('td');

                // Check pelaksana columns from right to left (starting from column index 2)
                for (let cellIndex = 2 + jumlahPelaksana - 1; cellIndex >= 2; cellIndex--) {
                    const cell = cells[cellIndex];
                    if (cell) {
                        const select = cell.querySelector('select');
                        if (select && select.value && select.value !== '') {
                            // Found an active symbol, return the column index relative to pelaksana columns (0-based)
                            return cellIndex - 2; // Convert to 0-based pelaksana column index
                        }
                    }
                }
            }

            // If no active symbol found, default to first column
            return 0;
        }

        function createBufferRow(connectorColumn = 0) {
            const row = document.createElement('tr');
            row.className = 'buffer-row';

            // Create cells matching the table structure with proper borders
            let html = `
                <td class="border border-gray-400 px-2 py-1"></td> <!-- No column -->
                <td class="border border-gray-400 px-2 py-1"></td> <!-- Uraian Kegiatan column -->
            `;

            // Add pelaksana columns with borders and add connector symbol to the specified column
            for (let i = 0; i < jumlahPelaksana; i++) {
                if (i === connectorColumn) {
                    // Add connector symbol to the specified pelaksana column
                    html += `
                        <td class="border border-gray-400 px-2 py-1">
                            <div class="symbol-preview">
                                <div class="w-10 h-10 bg-gray-500 [clip-path:polygon(0%_0%,100%_0%,100%_50%,50%_100%,0%_50%)]"></div>
                            </div>
                        </td>`;
                } else {
                    html += `<td class="border border-gray-400 px-2 py-1"></td>`;
                }
            }

            // Add remaining columns with borders
            html += `
                <td class="border border-gray-400 px-2 py-1"></td> <!-- Kelengkapan -->
                <td class="border border-gray-400 px-2 py-1"></td> <!-- Waktu -->
                <td class="border border-gray-400 px-2 py-1"></td> <!-- Output -->
                <td class="border border-gray-400 px-2 py-1"></td> <!-- Keterangan -->
            `;

            row.innerHTML = html;
            return row;
        }

        function getSymbolCenters() {
            const boxes = document.querySelectorAll('.symbol-preview > div'); // hanya ambil kotaknya
            const centers = [];

            boxes.forEach((box) => {
                const rect = box.getBoundingClientRect();
                const scrollX = window.scrollX;
                const scrollY = window.scrollY;
                centers.push({
                    element: box,
                    x: rect.left + rect.width / 2 + scrollX,
                    y: rect.top + rect.height / 2 + scrollY,
                });
            });

            return centers;
        }

        function drawAllPageConnections() {
            const pages = document.querySelectorAll('.page-preview');
            pages.forEach((page, pageIndex) => {
                const canvas = page.querySelector('.page-canvas');
                if (canvas) {
                    drawPageConnections(canvas, page, pageIndex + 1);
                }
            });
        }

        function drawPageConnections(canvas, pageElement, pageNumber) {
            if (!canvas) {
                return;
            }

            const ctx = canvas.getContext('2d');
            const table = pageElement.querySelector('.flow-table');

            if (!table) {
                return;
            }

            // Get current scale factor from preview wrapper
            const previewWrapper = document.getElementById('preview-wrapper');
            let scaleFactor = 1;
            if (previewWrapper) {
                const transform = previewWrapper.style.transform;
                const scaleMatch = transform.match(/scale\(([\d.]+)\)/);
                if (scaleMatch) {
                    scaleFactor = parseFloat(scaleMatch[1]);
                }
            }
            console.log('Scale factor detected:', scaleFactor);

            // Dapatkan semua simbol dari halaman ini
            const symbols = table.querySelectorAll('.symbol-preview > div:first-child');

            if (symbols.length === 0) {
                canvas.width = table.offsetWidth / scaleFactor;
                canvas.height = table.offsetHeight / scaleFactor;
                canvas.style.width = table.offsetWidth + 'px';
                canvas.style.height = table.offsetHeight + 'px';
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                return;
            }

            const centers = [];
            const tableRect = table.getBoundingClientRect();
            const pageRect = pageElement.getBoundingClientRect();

            symbols.forEach((el, index) => {
                const rect = el.getBoundingClientRect();
                const symbolPreview = el.parentElement;
                const cell = symbolPreview.parentElement;
                const row = cell.parentElement;
                const rowIndex = Array.from(row.parentElement.children).indexOf(row);
                const cellIndex = Array.from(row.children).indexOf(cell);

                // Check if this is a buffer row (connector symbol)
                const isBufferRow = row.classList.contains('buffer-row');
                let globalNumber = 0;
                let isConnector = false;

                if (isBufferRow) {
                    isConnector = true;
                    globalNumber = -1;
                } else {
                    // Calculate global number for regular symbols
                    const pageRows = table.querySelectorAll('tbody tr:not(.buffer-row)');
                    const rowInPage = Array.from(pageRows).indexOf(row);
                    const rowsPerPage = 8; // Should match the value in syncPreviewTable
                    const baseRowNumber = (pageNumber - 1) * rowsPerPage + rowInPage;
                    globalNumber = baseRowNumber * jumlahPelaksana + (cellIndex - 2) + 1;
                }

                // Calculate coordinates relative to the table and adjust for scale
                const center = {
                    element: el,
                    x: (rect.left - tableRect.left + rect.width / 2) / scaleFactor,
                    y: (rect.top - tableRect.top + rect.height / 2) / scaleFactor,
                    rowIndex: rowIndex,
                    cellIndex: cellIndex,
                    globalNumber: globalNumber,
                    symbolType: getSymbolType(el),
                    isConnector: isConnector,
                };
                centers.push(center);
            });

            // Sesuaikan ukuran canvas dengan table
            canvas.width = table.offsetWidth;
            canvas.height = table.offsetHeight;
            canvas.style.width = table.offsetWidth + 'px';
            canvas.style.height = table.offsetHeight + 'px';

            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Set drawing styles
            ctx.strokeStyle = '#000000';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            // Filter active symbols (exclude empty but include connectors)
            const activeSymbols = centers.filter((center) => center.symbolType !== 'empty');

            // Sort symbols by their visual order
            activeSymbols.sort((a, b) => {
                if (a.rowIndex !== b.rowIndex) {
                    return a.rowIndex - b.rowIndex;
                }
                return a.cellIndex - b.cellIndex;
            });

            // Draw connections between sequential symbols
            for (let i = 0; i < activeSymbols.length - 1; i++) {
                const from = activeSymbols[i];
                const to = activeSymbols[i + 1];

                drawConnectionLine(ctx, from, to, 1);
            }

            // Draw decision lines
            centers.forEach((center) => {
                if (center.symbolType === 'decision') {
                    drawDecisionLineInPage(ctx, center, centers, pageNumber);
                }
            });
        }

        function drawDecisionLineInPage(ctx, decisionCenter, allCenters, pageNumber) {
            // For now, only draw decision lines within the same page
            // You can extend this to handle cross-page decision lines if needed

            // Find the original input field to get return_to value
            // This is simplified - you might need to adapt based on your data structure
            const editorRows = document.querySelectorAll('#editor-tabel tbody tr');

            // Calculate which editor row this decision symbol corresponds to
            const rowsPerPage = 8;
            const pageRows = document.querySelectorAll(
                `.page-preview:nth-child(${pageNumber}) tbody tr:not(.buffer-row)`,
            );
            const rowInPage = Array.from(pageRows).indexOf(decisionCenter.element.closest('tr'));
            const globalRowIndex = (pageNumber - 1) * rowsPerPage + rowInPage;

            if (globalRowIndex < editorRows.length) {
                const originalRow = editorRows[globalRowIndex];
                const originalCell = originalRow ? originalRow.children[decisionCenter.cellIndex] : null;
                const returnInput = originalCell ? originalCell.querySelector('input[name^="return_to_"]') : null;

                if (returnInput && returnInput.value) {
                    const targetNumber = parseInt(returnInput.value);
                    let targetSymbol = allCenters.find((center) => center.globalNumber === targetNumber);

                    if (targetSymbol) {
                        // Draw decision line within this page
                        const decisionType = getSymbolType(decisionCenter.element);
                        const targetType = getSymbolType(targetSymbol.element);
                        const decisionDim = getSymbolDimensions(decisionCenter.element, decisionType);
                        const targetDim = getSymbolDimensions(targetSymbol.element, targetType);

                        const horizontalOffset = Math.max(decisionDim.width / 2 + 10, 25);
                        const curveOffset = Math.max(horizontalOffset + 15, 40);

                        ctx.save();
                        ctx.strokeStyle = '#ef4444';
                        ctx.lineWidth = 2;
                        ctx.lineCap = 'round';
                        ctx.lineJoin = 'round';

                        let startX = decisionCenter.x - (decisionDim.width / 2 + 8);
                        let startY = decisionCenter.y;
                        let endX = targetSymbol.x - (targetDim.width / 2 + 8);
                        let endY = targetSymbol.y;

                        ctx.beginPath();
                        ctx.moveTo(startX, startY);

                        const midX = startX - curveOffset;
                        ctx.lineTo(midX, startY);
                        ctx.lineTo(midX, endY);
                        ctx.lineTo(endX, endY);
                        ctx.stroke();

                        drawPreviewArrow(ctx, midX, endY, endX, endY, 1);

                        // Add "Tidak" text
                        ctx.fillStyle = '#ef4444';
                        ctx.font = '12px Arial';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';

                        const textX = midX;
                        const textY = startY + (endY - startY) * 0.3;

                        // White background for text
                        const textMetrics = ctx.measureText('Tidak');
                        const textWidth = textMetrics.width;
                        const textHeight = 15;

                        ctx.fillStyle = 'white';
                        ctx.fillRect(
                            textX - textWidth / 2 - 2,
                            textY - textHeight / 2 - 1,
                            textWidth + 4,
                            textHeight + 2,
                        );

                        ctx.fillStyle = '#ef4444';
                        ctx.fillText('Tidak', textX, textY);

                        ctx.restore();
                    }
                }
            }
        }

        function isOnDifferentPages(symbolA, symbolB) {
            // Get the rows containing both symbols
            const rowA = symbolA.element.closest('tr');
            const rowB = symbolB.element.closest('tr');

            if (!rowA || !rowB) return false;

            // Get all rows in the table
            const allRows = Array.from(rowA.parentElement.children);
            const rowIndexA = allRows.indexOf(rowA);
            const rowIndexB = allRows.indexOf(rowB);

            // Check if there's a page break row between them
            const startIndex = Math.min(rowIndexA, rowIndexB);
            const endIndex = Math.max(rowIndexA, rowIndexB);

            for (let i = startIndex + 1; i < endIndex; i++) {
                const row = allRows[i];
                if (row.classList.contains('page-break-before')) {
                    return true;
                }
            }

            return false;
        }

        function hasConnectorBetween(symbolA, symbolB, allSymbols) {
            // Check if there are connector symbols between two regular symbols
            const rowA = symbolA.element.closest('tr');
            const rowB = symbolB.element.closest('tr');

            if (!rowA || !rowB) return false;

            const allRows = Array.from(rowA.parentElement.children);
            const rowIndexA = allRows.indexOf(rowA);
            const rowIndexB = allRows.indexOf(rowB);

            const startIndex = Math.min(rowIndexA, rowIndexB);
            const endIndex = Math.max(rowIndexA, rowIndexB);

            // Look for connector symbols (buffer rows) between the two symbols
            for (let i = startIndex + 1; i < endIndex; i++) {
                const row = allRows[i];
                if (row.classList.contains('buffer-row')) {
                    return true;
                }
            }

            return false;
        }

        function getSymbolType(element) {
            if (element.classList.contains('bg-blue-500')) return 'start';
            if (element.classList.contains('bg-green-500')) return 'process';
            if (element.classList.contains('bg-yellow-400')) return 'decision';
            if (element.classList.contains('bg-gray-500')) return 'connector'; // Connector symbol in buffer row
            if (element.classList.contains('border-dashed')) return 'empty';
            return 'unknown';
        }

        function getSymbolDimensions(element, symbolType) {
            // Get actual dimensions or fallback to expected dimensions based on type
            const actualWidth = element.offsetWidth;
            const actualHeight = element.offsetHeight;

            // Fallback dimensions based on CSS classes
            let expectedWidth, expectedHeight;
            switch (symbolType) {
                case 'start':
                case 'process':
                case 'empty':
                    expectedWidth = 60; // w-15 = 3.75rem = 60px
                    expectedHeight = 24; // h-6 = 1.5rem = 24px
                    break;
                case 'decision':
                    expectedWidth = 32; // w-8 = 2rem = 32px
                    expectedHeight = 32; // h-8 = 2rem = 32px
                    break;
                case 'connector':
                    expectedWidth = 60; // w-15 = 3.75rem = 60px
                    expectedHeight = 24; // h-6 = 1.5rem = 24px
                    break;
                default:
                    expectedWidth = 60; // Default to w-15
                    expectedHeight = 24; // Default to h-6
            }

            return {
                width: actualWidth || expectedWidth,
                height: actualHeight || expectedHeight,
            };
        }

        function drawConnectionLine(ctx, from, to, scaleX) {
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

            // Enhanced logging for connectors
            const fromLabel = from.isConnector ? 'connector' : `symbol ${from.globalNumber}`;
            const toLabel = to.isConnector ? 'connector' : `symbol ${to.globalNumber}`;
            console.log(`Menggambar garis dari ${fromLabel} (row ${from.rowIndex}) ke ${toLabel} (row ${to.rowIndex})`);

            // Save context state
            ctx.save();

            // Set clean stroke style
            ctx.strokeStyle = '#000000';
            ctx.lineWidth = Math.max(2 * scaleX, 2);
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            ctx.beginPath();
            ctx.moveTo(startX, startY);
            ctx.lineTo(startX, (startY + endY) / 2);
            ctx.lineTo(endX, (startY + endY) / 2);
            ctx.lineTo(endX, endY);
            ctx.stroke();

            // Gambar panah di ujung garis
            drawPreviewArrow(ctx, endX, (startY + endY) / 2, endX, endY, scaleX);

            // Restore context state
            ctx.restore();
        }

        function drawDecisionLineByInput(ctx, decisionCenter, allCenters, scaleX) {
            // Cari input field untuk return_to
            const symbolPreview = decisionCenter.element.parentElement;
            const cell = symbolPreview.parentElement;
            const row = cell.parentElement;

            // Calculate logical row index (excluding buffer rows)
            let logicalRowIndex = 0;
            const allRows = Array.from(row.parentElement.children);
            for (let i = 0; i < allRows.indexOf(row); i++) {
                if (!allRows[i].classList.contains('buffer-row')) {
                    logicalRowIndex++;
                }
            }

            const originalRow = document.querySelector(`#editor-tabel tbody tr:nth-child(${logicalRowIndex + 1})`);
            const originalCell = originalRow ? originalRow.children[decisionCenter.cellIndex] : null;
            const returnInput = originalCell ? originalCell.querySelector('input[name^="return_to_"]') : null;

            if (returnInput && returnInput.value) {
                const targetNumber = parseInt(returnInput.value);
                let targetSymbol = allCenters.find((center) => center.globalNumber === targetNumber);

                if (targetSymbol) {
                    // Check if decision symbol and target are on different pages or separated by connectors
                    if (isOnDifferentPages(decisionCenter, targetSymbol)) {
                        return;
                    }

                    // Get symbol types and dimensions
                    const decisionType = getSymbolType(decisionCenter.element);
                    const targetType = getSymbolType(targetSymbol.element);
                    const decisionDim = getSymbolDimensions(decisionCenter.element, decisionType);
                    const targetDim = getSymbolDimensions(targetSymbol.element, targetType);

                    // Calculate dynamic padding and offset based on symbol dimensions
                    const horizontalOffset = Math.max(decisionDim.width / 2 + 10, 25);
                    const verticalPadding = Math.max(decisionDim.height / 2 + 5, 15);
                    const targetPadding = Math.max(targetDim.height / 2 + 8, 15);
                    const curveOffset = Math.max(horizontalOffset + 15, 40);

                    // Save current line style
                    ctx.save();

                    // Set clean decision line style
                    ctx.strokeStyle = '#ef4444'; // Merah untuk garis decision
                    ctx.lineWidth = Math.max(2 * scaleX, 2);
                    ctx.lineCap = 'round';
                    ctx.lineJoin = 'round';

                    // Start from the left edge of the decision diamond with proper spacing
                    let startX = decisionCenter.x - (decisionDim.width / 2 + 8);
                    let startY = decisionCenter.y;
                    let endX = targetSymbol.x - (targetDim.width / 2 + 8);
                    let endY = targetSymbol.y;

                    ctx.beginPath();
                    ctx.moveTo(startX, startY);

                    // Create a curved path with proper spacing
                    const midX = startX - curveOffset;
                    ctx.lineTo(midX, startY);
                    ctx.lineTo(midX, endY);
                    ctx.lineTo(endX, endY);
                    ctx.stroke();

                    // Draw arrow
                    drawPreviewArrow(ctx, midX, endY, endX, endY, scaleX);

                    // Add "Tidak" text
                    ctx.fillStyle = '#ef4444';
                    ctx.font = `${Math.max(12 * scaleX, 8)}px Arial`;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    const textX = midX;
                    const textY = startY + (endY - startY) * 0.3;

                    // White background for text
                    const textMetrics = ctx.measureText('Tidak');
                    const textWidth = textMetrics.width;
                    const textHeight = 15 * scaleX;

                    ctx.fillStyle = 'white';
                    ctx.fillRect(textX - textWidth / 2 - 2, textY - textHeight / 2 - 1, textWidth + 4, textHeight + 2);

                    ctx.fillStyle = '#ef4444';
                    ctx.fillText('Tidak', textX, textY);

                    // Restore context state
                    ctx.restore();
                }
            }
        }

        function drawPreviewArrow(ctx, fromX, fromY, toX, toY, scaleX = 1) {
            // Save context state
            ctx.save();

            // Dynamic arrow size based on scale and minimum size
            const baseHeadlen = 8;
            const headlen = Math.max(baseHeadlen * scaleX, 6); // Minimum 6px, scales with zoom
            const angle = Math.atan2(toY - fromY, toX - fromX);

            // Set clean stroke style for arrow
            ctx.strokeStyle = '#000000';
            ctx.lineWidth = Math.max(2 * scaleX, 2);
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            ctx.beginPath();
            ctx.moveTo(toX, toY);
            ctx.lineTo(toX - headlen * Math.cos(angle - Math.PI / 6), toY - headlen * Math.sin(angle - Math.PI / 6));
            ctx.moveTo(toX, toY);
            ctx.lineTo(toX - headlen * Math.cos(angle + Math.PI / 6), toY - headlen * Math.sin(angle + Math.PI / 6));
            ctx.stroke();

            // Restore context state
            ctx.restore();
        }

        function showSuccessAlert() {
            // You can add success alert functionality here
            console.log('Form submitted successfully');
        }

        function printPreview() {
            // Pastikan preview table sudah ter-sync dengan page breaks
            syncPreviewTable();

            // Tunggu sebentar untuk memastikan sync selesai
            setTimeout(() => {
                // Redraw connections before printing to ensure they are visible
                drawAllPageConnections();

                // Apply print-specific styling
                document.body.classList.add('printing');

                // Print with page breaks
                window.print();

                // Remove print styling after print dialog
                setTimeout(() => {
                    document.body.classList.remove('printing');
                }, 1000);
            }, 300);
        }

        // Initialize preview table on page load
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM loaded, initializing...');
            syncPreviewTable();

            // Add event listeners to existing elements
            document
                .querySelectorAll(
                    '#editor-tabel textarea, #editor-tabel input[name^="return_to_"], #editor-tabel select',
                )
                .forEach((element) => {
                    const eventType = element.tagName === 'SELECT' ? 'change' : 'input';
                    element.addEventListener(eventType, syncPreviewTable);
                });

            // Observer for preview changes
            const previewObserver = new MutationObserver(() => {
                setTimeout(() => {
                    drawAllPageConnections();
                    debouncedAutoScale();
                }, 150);
            });

            const pagesContainer = document.getElementById('pages-container');
            if (pagesContainer) {
                previewObserver.observe(pagesContainer, {
                    childList: true,
                    subtree: true,
                    attributes: true,
                    attributeFilter: ['class'],
                });
            }

            window.addEventListener('resize', () => {
                setTimeout(() => {
                    debouncedAutoScale();
                    drawAllPageConnections();
                }, 150);
            });

            setTimeout(() => {
                drawAllPageConnections();
                debouncedAutoScale();
            }, 1500);
        });
    </script>
</x-layout>

@php
    $jumlahPelaksana = $esop->pelaksanas->count();
@endphp

<x-layout>
    <style>
        /* Kontrol tinggi maksimal untuk textarea uraian kegiatan */
        .uraian-column textarea {
            max-height: 100px !important; /* Batasi tinggi maksimal */
            overflow-y: auto !important; /* Scroll jika terlalu panjang */
            line-height: 1.4 !important;
            padding: 8px !important;
            resize: vertical !important; /* Allow vertical resize only */
            min-height: 60px !important; /* Minimum height */
        }

        /* Style untuk semua textarea di tabel */
        .flow-table textarea {
            max-height: 80px !important;
            overflow-y: auto !important;
            line-height: 1.3 !important;
            font-size: 12px !important;
        }

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

            /* Force full size for print pages */
            .page-preview.print-full-size {
                width: 100% !important;
                max-width: none !important;
                min-width: 100% !important;
                transform: none !important;
                scale: 1 !important;
                zoom: 1 !important;
                margin: 0 !important;
                padding: 20px !important;
            }

            /* Reset preview wrapper transform for print */
            #preview-wrapper {
                transform: none !important;
                scale: 1 !important;
                zoom: 1 !important;
                width: 100% !important;
                max-width: none !important;
            }

            /* Untuk print, pastikan baris tidak terlalu tinggi */
            .page-preview .flow-table tbody tr {
                height: auto !important;
                min-height: 70px !important;
                max-height: 120px !important; /* Batasi tinggi maksimal */
            }

            .page-preview .flow-table tbody td {
                max-height: 120px !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
                word-wrap: break-word !important;
            }

            /* Uraian kegiatan column specific */
            .page-preview .flow-table tbody td:nth-child(2) {
                max-height: 120px !important;
                overflow-y: hidden !important;
                line-height: 1.3 !important;
                font-size: 9px !important;
            }

            /* Reset pages container transform for print */
            .pages-container {
                transform: none !important;
                scale: 1 !important;
                zoom: 1 !important;
                width: 100% !important;
                max-width: none !important;
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
            .page-canvas {
                visibility: visible !important;
                display: block !important;
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
                transform: none !important;
                scale: 1 !important;
                zoom: 1 !important;
                z-index: 1 !important;
                pointer-events: none !important;
                border: none !important;
                background: transparent !important;
            }

            /* Ensure print pages have proper positioning for canvas overlay */
            .page-preview.print-full-size {
                position: relative !important;
            }

            #flow-preview-canvas {
                display: block !important;
                position: absolute;
                pointer-events: none;
                z-index: 10;
                border: none !important;
                background: transparent !important;
            }

            /* Optimize table for print */
            #preview-tabel table,
            .page-preview .flow-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 9px;
                table-layout: fixed;
                min-width: 100%;
                max-width: 100%;
                margin: 0;
            }

            #preview-tabel th,
            #preview-tabel td,
            .page-preview .flow-table th,
            .page-preview .flow-table td {
                border: 1px solid #000;
                padding: 4px 3px;
                font-size: 8px;
                line-height: 1.3;
                word-wrap: break-word;
                overflow-wrap: break-word;
                box-sizing: border-box;
            }

            /* Optimized column widths for A4 landscape (total ~1043px available width) */
            .page-preview .flow-table col:nth-child(1) { width: 45px; } /* No */
            .page-preview .flow-table col:nth-child(2) { width: 260px; } /* Uraian Kegiatan */
            .page-preview .flow-table col:nth-child(3) { width: 100px; } /* Pelaksana 1 */
            .page-preview .flow-table col:nth-child(4) { width: 100px; } /* Pelaksana 2 */
            .page-preview .flow-table col:nth-child(5) { width: 100px; } /* Pelaksana 3 */
            .page-preview .flow-table col:nth-child(6) { width: 130px; } /* Kelengkapan */
            .page-preview .flow-table col:nth-child(7) { width: 85px; } /* Waktu */
            .page-preview .flow-table col:nth-child(8) { width: 120px; } /* Output */
            .page-preview .flow-table col:nth-child(9) { width: 103px; } /* Keterangan */

            /* Row height optimization for better space utilization */
            .page-preview .flow-table tbody tr {
                height: auto;
                min-height: 70px; /* Increased for print safety */
                max-height: 90px; /* Conservative max height */
            }

            .page-preview .flow-table tbody td {
                padding: 8px 4px; /* Increased padding for better print readability */
                vertical-align: middle;
                line-height: 1.4; /* Better line spacing */
            }

            /* Header optimization */
            .page-preview .flow-table thead th {
                padding: 10px 4px; /* Increased for print clarity */
                font-weight: bold;
                background-color: #f5f5f5 !important;
                -webkit-print-color-adjust: exact;
                line-height: 1.3;
                min-height: 40px; /* Ensure adequate header height */
            }

            /* Buffer row optimization for smaller footprint */
            .buffer-row td {
                padding: 4px 4px !important;
                height: 35px !important; /* Slightly larger for print visibility */
                min-height: 35px !important;
            }
                height: auto;
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
                margin: 1.5cm 1cm 1.5cm 1cm; /* More conservative margins */
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
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
                overflow: hidden !important; /* Cut off any overflow */
            }

            .page-preview:last-child {
                page-break-after: auto !important;
                break-after: auto !important;
            }

            /* Ensure table doesn't exceed page bounds during print */
            .page-preview .flow-table {
                max-height: calc(100vh - 40px) !important; /* Account for margins */
                overflow: hidden !important;
            }

            .page-preview .flow-table tbody {
                max-height: calc(100vh - 120px) !important; /* Account for header */
                overflow: hidden !important;
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
            overflow-x: auto !important;
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
            transform-origin: top center !important;
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
            display: flex;
            justify-content: center;
            align-items: flex-start;
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
            margin-bottom: 20px;
            page-break-after: always;
            position: relative;
            padding: 25px 20px; /* Conservative A4 margins */
            /* A4 Landscape dimensions: 297mm x 210mm */
            /* Using conservative calculations for print accuracy */
            width: 100%;
            max-width: 1050px; /* Slightly smaller for safety */
            min-height: 650px; /* Conservative height for print safety */
            box-sizing: border-box;
            overflow: visible; /* Allow flowchart lines to show */
            margin-left: auto;
            margin-right: auto;
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
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .page-preview .flow-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            min-width: 100%; /* Fit to page width */
            max-width: 100%; /* Don't exceed page width */
            font-size: 10px;
            height: calc(100% - 60px); /* Account for page margins and page number */
        }

        /* Ensure table fits A4 landscape dimensions */
        .page-preview .flow-table colgroup col {
            width: auto;
        }

        /* Responsive column widths based on content */
        .page-preview .flow-table thead th,
        .page-preview .flow-table tbody td {
            padding: 6px 4px;
            border: 1px solid #9ca3af;
            font-size: 10px;
            line-height: 1.3;
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 0; /* Allow text wrapping */
        }

        /* Row height for A4 optimization */
        .page-preview .flow-table tbody tr {
            height: auto;
            min-height: 75px; /* Conservative height for print consistency */
        }

        /* Ensure consistent spacing across screen and print */
        .page-preview .flow-table tbody td {
            min-height: 75px;
            padding: 8px 4px;
        }

        .page-canvas {
            position: absolute;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 10;
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

                                                {{-- Only show number if symbol is selected --}}
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
                        <button
                            type="button"
                            onclick="clearAllSymbols()"
                            class="rounded-md border border-red-500 px-3 py-2 text-sm text-red-500 hover:bg-red-50"
                            title="Kosongkan semua pilihan simbol dan reset penomoran"
                        >
                            🗑️ Kosongkan Simbol
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

        // Array untuk menyimpan urutan simbol berdasarkan pemilihan
        let symbolOrder = [];
        let nextSymbolNumber = 1;

        // Initialize existing symbols on page load
        function initializeExistingSymbols() {
            console.log('Initializing existing symbols...');

            // First try to load from localStorage
            const loadedFromStorage = loadSymbolOrderFromStorage();

            if (loadedFromStorage && symbolOrder.length > 0) {
                console.log('Using saved symbol order from localStorage');

                // Clear all existing numbers first
                const allSymbolPreviews = document.querySelectorAll('.symbol-preview');
                allSymbolPreviews.forEach((preview) => {
                    const numberDiv = preview.querySelector('.symbol-number');
                    if (numberDiv) {
                        numberDiv.remove();
                    }
                });

                // Validate and update display for saved symbols
                symbolOrder.forEach((item) => {
                    const select = document.querySelector(`select[name="symbol_${item.rowNumber}_${item.colIndex}"]`);
                    if (select && select.value && select.value !== '') {
                        const symbolPreview = select.nextElementSibling;

                        // Add number only if symbol is selected
                        const numberDiv = document.createElement('div');
                        numberDiv.className = 'symbol-number';
                        numberDiv.textContent = item.number;
                        symbolPreview.appendChild(numberDiv);
                    }
                });

                return; // Exit early if we loaded from storage
            }

            // If no saved order, initialize from current state
            console.log('No saved order found, initializing from current state...');

            // Reset order first
            symbolOrder = [];
            nextSymbolNumber = 1;

            // Collect all existing symbols with their current numbers
            const existingSymbols = [];
            const editorRows = document.querySelectorAll('#editor-tabel tbody tr');

            editorRows.forEach((row, rowIndex) => {
                const cells = row.querySelectorAll('td');
                cells.forEach((cell, cellIndex) => {
                    if (cellIndex >= 2 && cellIndex < 2 + jumlahPelaksana) {
                        const select = cell.querySelector('select');
                        const symbolPreview = cell.querySelector('.symbol-preview');
                        const numberDiv = symbolPreview ? symbolPreview.querySelector('.symbol-number') : null;

                        if (select && select.value && select.value !== '') {
                            // For fresh initialization, use visual order (top-to-bottom, left-to-right)
                            const visualOrder = rowIndex * jumlahPelaksana + (cellIndex - 2) + 1;
                            existingSymbols.push({
                                rowNumber: rowIndex + 1,
                                colIndex: cellIndex - 2,
                                visualOrder: visualOrder,
                                select: select,
                                symbolPreview: symbolPreview,
                            });
                        }
                    }
                });
            });

            // Sort by visual order for consistent initialization
            existingSymbols.sort((a, b) => a.visualOrder - b.visualOrder);

            // Re-initialize symbolOrder based on visual order
            existingSymbols.forEach((symbol, index) => {
                const key = `${symbol.rowNumber}_${symbol.colIndex}`;
                const sequentialNumber = index + 1;

                symbolOrder.push({
                    key: key,
                    number: sequentialNumber,
                    rowNumber: symbol.rowNumber,
                    colIndex: symbol.colIndex,
                });

                // Update the display number
                const numberDiv = symbol.symbolPreview.querySelector('.symbol-number');
                if (numberDiv) {
                    numberDiv.textContent = sequentialNumber;
                }
            });

            // Set next symbol number
            nextSymbolNumber = existingSymbols.length + 1;

            // Save this initial order
            if (existingSymbols.length > 0) {
                saveSymbolOrderToStorage();
            }

            console.log('Initialized existing symbols:', symbolOrder);
            console.log('Next symbol number will be:', nextSymbolNumber);
        }

        // Call initialization after page loads
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(() => {
                initializeExistingSymbols();
                syncPreviewTable();
            }, 100);
        });

        // Function to save symbol order to localStorage
        function saveSymbolOrderToStorage() {
            const storageKey = `symbol_order_{{ $esop->id }}`;
            localStorage.setItem(storageKey, JSON.stringify(symbolOrder));
            console.log('Symbol order saved to localStorage:', symbolOrder);
        }

        // Function to load symbol order from localStorage
        function loadSymbolOrderFromStorage() {
            const storageKey = `symbol_order_{{ $esop->id }}`;
            const saved = localStorage.getItem(storageKey);
            if (saved) {
                try {
                    const parsed = JSON.parse(saved);
                    if (Array.isArray(parsed)) {
                        symbolOrder = parsed;
                        nextSymbolNumber = parsed.length + 1;
                        console.log('Symbol order loaded from localStorage:', symbolOrder);
                        return true;
                    }
                } catch (e) {
                    console.error('Error parsing saved symbol order:', e);
                }
            }
            return false;
        }

        // Function to clear saved symbol order
        function clearSavedSymbolOrder() {
            const storageKey = `symbol_order_{{ $esop->id }}`;
            localStorage.removeItem(storageKey);
            console.log('Symbol order cleared from localStorage');
        }
        // Function to get sequential symbol number based on selection order
        function getSequentialSymbolNumber(rowNumber, colIndex) {
            const key = `${rowNumber}_${colIndex}`;

            // Cari apakah simbol ini sudah ada dalam urutan
            const existingIndex = symbolOrder.findIndex((item) => item.key === key);

            if (existingIndex !== -1) {
                return symbolOrder[existingIndex].number;
            }

            // Jika belum ada, tambahkan ke urutan
            const number = nextSymbolNumber++;
            symbolOrder.push({
                key: key,
                number: number,
                rowNumber: rowNumber,
                colIndex: colIndex,
            });

            // Save to localStorage whenever order changes
            saveSymbolOrderToStorage();

            return number;
        }

        // Function to remove symbol from order when changed to empty
        function removeSymbolFromOrder(rowNumber, colIndex) {
            const key = `${rowNumber}_${colIndex}`;
            const index = symbolOrder.findIndex((item) => item.key === key);

            if (index !== -1) {
                symbolOrder.splice(index, 1);

                // Re-number all subsequent symbols
                for (let i = index; i < symbolOrder.length; i++) {
                    symbolOrder[i].number = i + 1;
                }

                // Update nextSymbolNumber
                nextSymbolNumber = symbolOrder.length + 1;

                // Save to localStorage
                saveSymbolOrderToStorage();

                // Update all existing symbols display
                updateAllSymbolNumbers();
            }
        }

        // Function to update all symbol numbers in the editor
        function updateAllSymbolNumbers() {
            // First, clear all symbol numbers
            const allSymbolPreviews = document.querySelectorAll('.symbol-preview');
            allSymbolPreviews.forEach((preview) => {
                const numberDiv = preview.querySelector('.symbol-number');
                if (numberDiv) {
                    numberDiv.remove();
                }
            });

            // Then, add numbers only for symbols in the order
            symbolOrder.forEach((item) => {
                const select = document.querySelector(`select[name="symbol_${item.rowNumber}_${item.colIndex}"]`);
                if (select && select.value && select.value !== '') {
                    const symbolPreview = select.nextElementSibling;

                    // Remove existing number if any
                    const existingNumber = symbolPreview.querySelector('.symbol-number');
                    if (existingNumber) {
                        existingNumber.remove();
                    }

                    // Add new number
                    const numberDiv = document.createElement('div');
                    numberDiv.className = 'symbol-number';
                    numberDiv.textContent = item.number;
                    symbolPreview.appendChild(numberDiv);
                }
            });
        }

        // Function to get ordered symbols for flowchart connections
        function getOrderedSymbols() {
            return symbolOrder.sort((a, b) => a.number - b.number);
        }

        // Function to reset all symbol numbering (useful for initialization or reset)
        function resetSymbolOrder() {
            symbolOrder = [];
            nextSymbolNumber = 1;
            clearSavedSymbolOrder();
            console.log('Symbol order reset');
        }

        // Function to debug current symbol order
        function debugSymbolOrder() {
            console.log('Current symbol order:', symbolOrder);
            console.log('Next symbol number:', nextSymbolNumber);

            // Show current sequential numbering
            symbolOrder.forEach((item) => {
                console.log(`Symbol ${item.number}: Row ${item.rowNumber}, Col ${item.colIndex}`);
            });
        }

        // Expose debug function to global scope for testing
        window.debugSymbolOrder = debugSymbolOrder;
        window.resetSymbolOrder = resetSymbolOrder;
        window.clearSavedSymbolOrder = clearSavedSymbolOrder;
        window.saveSymbolOrderToStorage = saveSymbolOrderToStorage;
        window.loadSymbolOrderFromStorage = loadSymbolOrderFromStorage;

        // Add info message about new numbering system
        console.log('=== Sistem Penomoran Simbol Berurutan ===');
        console.log('Simbol akan diberi nomor berdasarkan urutan pemilihan');
        console.log('Garis penghubung akan mengikuti urutan nomor, bukan posisi visual');
        console.log('Urutan simbol disimpan otomatis dan dipulihkan saat refresh');
        console.log('Fungsi debugging yang tersedia:');
        console.log('- debugSymbolOrder() : melihat urutan saat ini');
        console.log('- resetSymbolOrder() : mereset penomoran');
        console.log('- clearSavedSymbolOrder() : hapus urutan tersimpan');
        console.log('========================================');
        function calculateActualRowHeights() {
            const editorRows = document.querySelectorAll('#editor-tabel tbody tr');
            const heights = [];

            editorRows.forEach((row, index) => {
                // Hitung tinggi berdasarkan content textarea
                const uraianTextarea = row.querySelector('textarea[name^="uraian_kegiatan_"]');
                if (uraianTextarea && uraianTextarea.value.trim()) {
                    // Estimasi tinggi berdasarkan panjang teks
                    const textLength = uraianTextarea.value.length;
                    const lineCount = Math.ceil(textLength / 50); // ~50 karakter per baris
                    const actualLineCount = (uraianTextarea.value.match(/\n/g) || []).length + 1;

                    // Gunakan yang lebih besar antara perhitungan karakter atau line break
                    const estimatedLines = Math.max(lineCount, actualLineCount);

                    // Tinggi minimum 75px, tambah 20px per baris ekstra
                    const estimatedHeight = Math.max(75, 55 + estimatedLines * 20);
                    heights.push(estimatedHeight);

                    console.log(
                        `Row ${index + 1}: ${textLength} chars, ${estimatedLines} lines, ${estimatedHeight}px height`,
                    );
                } else {
                    // Baris kosong menggunakan tinggi minimum
                    heights.push(75);
                }
            });

            return heights;
        }

        // Function to calculate rows per page based on A4 dimensions
        function calculateRowsPerPage() {
            // A4 landscape: 297mm x 210mm at print resolution
            // Browser akan otomatis menambahkan margin saat print

            // Real-world A4 landscape print measurements (tanpa margin tambahan)
            const a4LandscapeHeight = 210; // mm
            const availableHeightMM = a4LandscapeHeight; // Gunakan full height, browser akan handle margin

            // Convert to pixel calculations for print
            // Using 96 DPI (standard web DPI)
            const availableHeightPx = (availableHeightMM / 25.4) * 96; // ~794px

            // Table structure heights untuk print yang lebih akurat
            const tableHeaderHeight = 100; // Header table lebih realistis
            const safetyMargin = 50; // Margin lebih besar untuk safety

            // DYNAMIC ROW HEIGHT CALCULATION
            // Hitung tinggi aktual dari baris-baris yang ada
            const actualRowHeights = calculateActualRowHeights();
            const averageActualHeight =
                actualRowHeights.length > 0
                    ? Math.max(75, actualRowHeights.reduce((sum, height) => sum + height, 0) / actualRowHeights.length)
                    : 90; // Default lebih konservatif

            console.log('Actual row heights:', actualRowHeights);
            console.log('Average actual height:', averageActualHeight);

            const availableForRows = availableHeightPx - tableHeaderHeight - safetyMargin;
            const maxRows = Math.floor(availableForRows / averageActualHeight);

            // Lebih konservatif: batasi berdasarkan tinggi aktual
            const safeRows = Math.min(Math.max(4, maxRows), 7); // Min 4, Max 7 untuk safety

            console.log('Dynamic page calculation based on actual content:', {
                availableHeightMM,
                availableHeightPx,
                tableHeaderHeight,
                averageActualHeight,
                actualRowHeights,
                availableForRows,
                calculatedMaxRows: maxRows,
                safeRows,
            });

            return safeRows;
        }

        // Function to validate page content and adjust if needed
        function validatePageContent() {
            const pages = document.querySelectorAll('.page-preview');
            pages.forEach((page, index) => {
                const table = page.querySelector('.flow-table');
                const rows = table ? table.querySelectorAll('tbody tr:not(.buffer-row)') : [];

                // Hitung tinggi aktual page content
                let totalRowHeight = 0;
                rows.forEach((row) => {
                    // Measure actual row height
                    const rowHeight = row.offsetHeight || 75;
                    totalRowHeight += rowHeight;
                });

                const tableHeaderHeight = 100;
                const totalPageHeight = tableHeaderHeight + totalRowHeight + 50; // +50 safety margin
                const pageAvailableHeight = 744; // A4 height dengan margin browser (~750px available)

                console.log(`Page ${index + 1} validation:`, {
                    rows: rows.length,
                    totalRowHeight,
                    totalPageHeight,
                    pageAvailableHeight,
                    heightPercentage: Math.round((totalPageHeight / pageAvailableHeight) * 100),
                    isOverflowing: totalPageHeight > pageAvailableHeight,
                });

                if (totalPageHeight > pageAvailableHeight) {
                    console.warn(`⚠️ Page ${index + 1} OVERFLOW: ${totalPageHeight}px > ${pageAvailableHeight}px`);
                    console.warn(`   Consider reducing rows per page or content length`);
                }

                // Check individual row heights
                rows.forEach((row, rowIndex) => {
                    const rowHeight = row.offsetHeight || 75;
                    if (rowHeight > 120) {
                        console.warn(`⚠️ Row ${rowIndex + 1} in page ${index + 1} is very tall: ${rowHeight}px`);
                    }
                });

                // Check if page exceeds safe row limit
                const maxSafeRows = ROWS_PER_PAGE;
                if (rows.length > maxSafeRows) {
                    console.warn(`Page ${index + 1} has ${rows.length} rows, exceeds safe limit of ${maxSafeRows}`);
                }

                // Ensure we don't have too many empty rows
                if (rows.length < ROWS_PER_PAGE / 2 && index < pages.length - 1) {
                    console.log(`Page ${index + 1} has only ${rows.length} rows, could be optimized`);
                }
            });
        }

        // Get dynamic rows per page - recalculate every time
        let ROWS_PER_PAGE = calculateRowsPerPage();

        // Function to get current ROWS_PER_PAGE (always fresh calculation)
        function getCurrentRowsPerPage() {
            ROWS_PER_PAGE = calculateRowsPerPage();
            return ROWS_PER_PAGE;
        }

        // Debug function to show current page calculations
        function showPageInfo() {
            const actualRowHeights = calculateActualRowHeights();
            const averageHeight =
                actualRowHeights.length > 0
                    ? actualRowHeights.reduce((sum, height) => sum + height, 0) / actualRowHeights.length
                    : 75;

            console.log('=== A4 Page Break Info (Dynamic) ===');
            console.log('Calculated rows per page:', ROWS_PER_PAGE);
            console.log('Total rows:', rowCount);
            console.log('Estimated pages:', Math.ceil(rowCount / ROWS_PER_PAGE));
            console.log('Actual row heights:', actualRowHeights);
            console.log('Average row height:', Math.round(averageHeight) + 'px');
            console.log('Tallest row:', Math.max(...actualRowHeights, 0) + 'px');
            console.log('Shortest row:', Math.min(...actualRowHeights, 75) + 'px');

            // Check if we're in landscape mode
            const isLandscape = window.innerWidth > window.innerHeight;
            console.log('Current orientation:', isLandscape ? 'Landscape' : 'Portrait');

            // Calculate estimated total page height
            const tableHeaderHeight = 100;
            const safetyMargin = 50;
            const estimatedPageHeight = tableHeaderHeight + ROWS_PER_PAGE * averageHeight + safetyMargin;
            console.log('Estimated page height:', Math.round(estimatedPageHeight) + 'px');
            console.log('A4 available height: 744px');
            console.log('Height utilization:', Math.round((estimatedPageHeight / 744) * 100) + '%');
            console.log('====================================');
        }

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
                const containerHeight = previewArea.clientHeight - 40; // Padding for pages
                const firstPage = pagesContainer.querySelector('.page-preview');

                if (firstPage) {
                    // Wait for layout to settle
                    setTimeout(() => {
                        const pageWidth = firstPage.scrollWidth;
                        const pageHeight = firstPage.scrollHeight;

                        if (pageWidth > 0) {
                            // Calculate scale to fit screen with maximum scale of 1
                            const scaleX = containerWidth / pageWidth;
                            const scaleY = containerHeight / pageHeight;
                            const scale = Math.min(1, scaleX, scaleY);

                            // Apply scale with center transform origin
                            previewWrapper.style.transform = `scale(${scale})`;
                            previewWrapper.style.transformOrigin = 'center center';

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

        function clearAllSymbols() {
            // Konfirmasi sebelum menghapus
            const confirmed = confirm(
                'Apakah Anda yakin ingin mengosongkan semua pilihan simbol? Tindakan ini tidak dapat dibatalkan.',
            );

            if (!confirmed) {
                return;
            }

            console.log('Mengosongkan semua pilihan simbol...');

            // Reset symbol order dan numbering
            resetSymbolOrder();

            // Cari semua select element untuk simbol
            const allSymbolSelects = document.querySelectorAll('select[name^="symbol_"]');

            allSymbolSelects.forEach((select) => {
                // Reset select ke nilai kosong
                select.value = '';

                // Reset preview simbol
                const symbolPreview = select.nextElementSibling;
                if (symbolPreview && symbolPreview.classList.contains('symbol-preview')) {
                    symbolPreview.innerHTML =
                        '<div class="w-15 h-6 border-2 border-gray-300 border-dashed mx-auto"></div>';
                }

                // Hapus input return_to jika ada
                const cell = select.closest('td');
                const returnInput = cell.querySelector('input[name^="return_to_"]');
                if (returnInput) {
                    returnInput.closest('div').remove();
                }
            });

            // Update preview table
            syncPreviewTable();

            console.log('Semua pilihan simbol berhasil dikosongkan');
        }

        function addEventListenersToRow(row) {
            row.querySelectorAll('textarea, input[name^="return_to_"], select').forEach((element) => {
                const eventType = element.tagName === 'SELECT' ? 'change' : 'input';
                element.addEventListener(eventType, () => {
                    // Debounce untuk textarea yang sering berubah
                    if (element.tagName === 'TEXTAREA') {
                        setTimeout(() => {
                            syncPreviewTable();
                        }, 300);
                    } else {
                        syncPreviewTable();
                    }
                });
            });
        }

        function updateSymbol(selectElement) {
            const symbolPreview = selectElement.nextElementSibling;
            const value = selectElement.value;
            const nameAttr = selectElement.getAttribute('name');
            const match = nameAttr.match(/symbol_(\d+)_(\d+)/);
            const rowNumber = match ? parseInt(match[1]) : 1;
            const colIndex = match ? parseInt(match[2]) : 0;

            let symbolHtml = '';
            let sequentialNumber = 0;

            // Jika simbol dipilih (bukan kosong), dapatkan nomor berurutan
            if (value && value !== '') {
                sequentialNumber = getSequentialSymbolNumber(rowNumber, colIndex);
            } else {
                // Jika simbol dikosongkan, hapus dari urutan
                removeSymbolFromOrder(rowNumber, colIndex);
            }

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

            // Tambahkan nomor simbol hanya jika ada simbol
            if (value && value !== '' && sequentialNumber > 0) {
                symbolHtml += `<div class="symbol-number">${sequentialNumber}</div>`;
            }

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

            // Recalculate rows per page based on current content
            const UPDATED_ROWS_PER_PAGE = calculateRowsPerPage();

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

                        // Dapatkan nomor berurutan dari sistem symbolOrder
                        let sequentialNumber = 0;
                        if (select && select.value && select.value !== '') {
                            const rowNumber = rowIndex + 1;
                            const colIndex = pelaksanaIndex;
                            const key = `${rowNumber}_${colIndex}`;
                            const symbolOrderItem = symbolOrder.find((item) => item.key === key);
                            if (symbolOrderItem) {
                                sequentialNumber = symbolOrderItem.number;
                            }
                        }

                        rowData.pelaksanas[pelaksanaIndex] = {
                            value: select ? select.value : '',
                            returnTo: returnInput ? returnInput.value : '',
                            sequentialNumber: sequentialNumber,
                            rowNumber: rowIndex + 1,
                            colIndex: pelaksanaIndex,
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
            for (let i = 0; i < processedRowsData.length; i += UPDATED_ROWS_PER_PAGE) {
                const pageRows = processedRowsData.slice(i, i + UPDATED_ROWS_PER_PAGE);
                pages.push({
                    number: Math.floor(i / UPDATED_ROWS_PER_PAGE) + 1,
                    rows: pageRows,
                    needsConnector: i + UPDATED_ROWS_PER_PAGE < processedRowsData.length,
                });
            }

            pages.forEach((page, pageIndex) => {
                const pageDiv = createPageElement(page, pageIndex === pages.length - 1);
                pagesContainer.appendChild(pageDiv);
            });

            setTimeout(() => {
                drawAllPageConnections();
                debouncedAutoScale();
                validatePageContent(); // Validate page utilization
                showPageInfo(); // Show debug info
            }, 200);
        }

        function createPageElement(page, isLastPage) {
            const pageDiv = document.createElement('div');
            pageDiv.className = 'page-preview';
            pageDiv.id = `page-${page.number}`;

            // Create table header
            const tableHeader = `
                <colgroup>
                    <col style="width: 45px" />
                    <col style="width: 260px" />
                    ${Array(jumlahPelaksana).fill('<col style="width: 100px" />').join('')}
                    <col style="width: 130px" />
                    <col style="width: 85px" />
                    <col style="width: 120px" />
                    <col style="width: 103px" />
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

                const rowsPerPage = ROWS_PER_PAGE; // Use dynamic calculation
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

                // Add symbol number if symbol exists - gunakan nomor berurutan
                if (symbolHTML && pelaksana.sequentialNumber > 0) {
                    symbolHTML += `<div class="symbol-number">${pelaksana.sequentialNumber}</div>`;
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

            // Deteksi mode print yang lebih akurat
            const isPrinting = document.body.classList.contains('printing');
            const isPrintPage = pageElement.classList.contains('print-full-size');

            // Get current scale factor - HANYA untuk preview, NOT untuk print
            let scaleFactor = 1;
            if (!isPrinting && !isPrintPage) {
                const previewWrapper = document.getElementById('preview-wrapper');
                if (previewWrapper) {
                    const transform = previewWrapper.style.transform;
                    const scaleMatch = transform.match(/scale\(([\d.]+)\)/);
                    if (scaleMatch) {
                        scaleFactor = parseFloat(scaleMatch[1]);
                    }
                }
            }

            console.log('Canvas drawing mode:', {
                isPrinting,
                isPrintPage,
                scaleFactor,
                canvasId: canvas.id,
            });

            // Dapatkan semua simbol dari halaman ini
            const symbols = table.querySelectorAll('.symbol-preview > div:first-child');

            if (symbols.length === 0) {
                // Set canvas size berdasarkan mode
                if (isPrinting || isPrintPage) {
                    canvas.width = table.offsetWidth;
                    canvas.height = table.offsetHeight;
                    canvas.style.width = table.offsetWidth + 'px';
                    canvas.style.height = table.offsetHeight + 'px';
                } else {
                    canvas.width = table.offsetWidth / scaleFactor;
                    canvas.height = table.offsetHeight / scaleFactor;
                    canvas.style.width = table.offsetWidth + 'px';
                    canvas.style.height = table.offsetHeight + 'px';
                }
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                return;
            }

            const centers = [];
            const tableRect = table.getBoundingClientRect();

            symbols.forEach((el, index) => {
                const rect = el.getBoundingClientRect();
                const symbolPreview = el.parentElement;
                const cell = symbolPreview.parentElement;
                const row = cell.parentElement;
                const rowIndex = Array.from(row.parentElement.children).indexOf(row);
                const cellIndex = Array.from(row.children).indexOf(cell);

                // Check if this is a buffer row (connector symbol)
                const isBufferRow = row.classList.contains('buffer-row');
                let sequentialNumber = 0;
                let isConnector = false;

                if (isBufferRow) {
                    isConnector = true;
                    sequentialNumber = -1; // Connector tidak punya nomor berurutan
                } else {
                    // Dapatkan nomor berurutan dari sistem symbolOrder
                    const pageRows = table.querySelectorAll('tbody tr:not(.buffer-row)');
                    const rowInPage = Array.from(pageRows).indexOf(row);
                    const rowsPerPage = ROWS_PER_PAGE;
                    const actualRowNumber = (pageNumber - 1) * rowsPerPage + rowInPage + 1;
                    const actualColIndex = cellIndex - 2; // Column index dalam pelaksana
                    const key = `${actualRowNumber}_${actualColIndex}`;

                    const symbolOrderItem = symbolOrder.find((item) => item.key === key);
                    if (symbolOrderItem) {
                        sequentialNumber = symbolOrderItem.number;
                    } else {
                        sequentialNumber = 0; // Tidak ada nomor jika tidak ditemukan
                    }
                }

                // Calculate coordinates - BERBEDA untuk print vs preview
                let centerX, centerY;
                if (isPrinting || isPrintPage) {
                    // Untuk print: gunakan koordinat relatif langsung tanpa scaling
                    centerX = rect.left - tableRect.left + rect.width / 2;
                    centerY = rect.top - tableRect.top + rect.height / 2;
                } else {
                    // Untuk preview: gunakan scaling
                    centerX = (rect.left - tableRect.left + rect.width / 2) / scaleFactor;
                    centerY = (rect.top - tableRect.top + rect.height / 2) / scaleFactor;
                }

                const center = {
                    element: el,
                    x: centerX,
                    y: centerY,
                    rowIndex: rowIndex,
                    cellIndex: cellIndex,
                    sequentialNumber: sequentialNumber,
                    symbolType: getSymbolType(el),
                    isConnector: isConnector,
                };
                centers.push(center);
            });

            // Set canvas size berdasarkan mode
            if (isPrinting || isPrintPage) {
                canvas.width = table.offsetWidth;
                canvas.height = table.offsetHeight;
                canvas.style.width = table.offsetWidth + 'px';
                canvas.style.height = table.offsetHeight + 'px';
            } else {
                canvas.width = table.offsetWidth;
                canvas.height = table.offsetHeight;
                canvas.style.width = table.offsetWidth + 'px';
                canvas.style.height = table.offsetHeight + 'px';
            }

            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Set drawing styles - BERBEDA untuk print vs preview
            ctx.strokeStyle = '#000000';
            if (isPrinting || isPrintPage) {
                ctx.lineWidth = 2; // Fixed width untuk print
            } else {
                ctx.lineWidth = Math.max(2 * scaleFactor, 2); // Scaled width untuk preview
            }
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            // Filter active symbols (exclude empty but include connectors)
            const activeSymbols = centers.filter((center) => center.symbolType !== 'empty');

            // Sort symbols by their sequential number for flowchart connections
            // Connectors don't have sequential numbers, so handle them separately
            const sequentialSymbols = activeSymbols.filter(
                (center) => !center.isConnector && center.sequentialNumber > 0,
            );
            const connectorSymbols = activeSymbols.filter((center) => center.isConnector);

            // Sort sequential symbols by their number
            sequentialSymbols.sort((a, b) => a.sequentialNumber - b.sequentialNumber);

            // Draw connections between sequential symbols (following the order of selection)
            const lineScale = isPrinting || isPrintPage ? 1 : scaleFactor;
            for (let i = 0; i < sequentialSymbols.length - 1; i++) {
                const from = sequentialSymbols[i];
                const to = sequentialSymbols[i + 1];
                drawConnectionLine(ctx, from, to, lineScale);
            }

            // Handle connectors - connect them to the flow properly
            connectorSymbols.forEach((connector) => {
                if (sequentialSymbols.length > 0) {
                    // For page continuity connectors (like on page 2),
                    // they should connect TO the next symbol, not FROM a previous symbol

                    // Check if this is a continuation connector (at top of page)
                    const isTopConnector =
                        connector.rowIndex === 0 ||
                        (connector.rowIndex === 1 &&
                            connector.element.closest('tr').previousElementSibling?.classList.contains('buffer-row'));

                    if (isTopConnector) {
                        // This is a page continuation connector - connect TO next symbol
                        const nextSymbol = sequentialSymbols.find((symbol) => symbol.rowIndex > connector.rowIndex);
                        if (nextSymbol) {
                            drawConnectionLine(ctx, connector, nextSymbol, lineScale);
                        }
                    } else {
                        // This is a page ending connector - connect FROM previous symbol
                        const previousSymbol = findNearestSequentialSymbol(connector, sequentialSymbols);
                        if (previousSymbol) {
                            drawConnectionLine(ctx, previousSymbol, connector, lineScale);
                        }
                    }
                }
            });

            // Draw decision lines
            centers.forEach((center) => {
                if (center.symbolType === 'decision') {
                    drawDecisionLineInPage(ctx, center, centers, pageNumber);
                }
            });
        }

        // Helper function to find nearest sequential symbol for connector
        function findNearestSequentialSymbol(connector, sequentialSymbols) {
            if (sequentialSymbols.length === 0) return null;

            // For connectors, we want to connect to the PREVIOUS symbol in the sequence
            // to continue the flow, not just the nearest by distance

            // Find symbols that are BEFORE this connector row (above it)
            const symbolsAbove = sequentialSymbols.filter((symbol) => symbol.rowIndex < connector.rowIndex);

            if (symbolsAbove.length === 0) {
                // If no symbols above, find the closest symbol in same column
                const sameColumnSymbols = sequentialSymbols.filter(
                    (symbol) => symbol.cellIndex === connector.cellIndex,
                );
                if (sameColumnSymbols.length > 0) {
                    // Return the symbol with highest sequential number in same column
                    return sameColumnSymbols.reduce((prev, current) =>
                        current.sequentialNumber > prev.sequentialNumber ? current : prev,
                    );
                }
                return null;
            }

            // From symbols above, find the one that should logically connect to this connector
            // Priority: same column first, then by sequential number (highest first)
            const sameColumnAbove = symbolsAbove.filter((symbol) => symbol.cellIndex === connector.cellIndex);

            if (sameColumnAbove.length > 0) {
                // Return the symbol with highest sequential number in same column
                return sameColumnAbove.reduce((prev, current) =>
                    current.sequentialNumber > prev.sequentialNumber ? current : prev,
                );
            }

            // If no symbol in same column above, find the symbol with highest sequential number
            // that is closest row-wise
            return symbolsAbove.reduce((prev, current) => {
                // Prefer higher sequential number, then closer row
                if (current.sequentialNumber > prev.sequentialNumber) {
                    return current;
                } else if (current.sequentialNumber === prev.sequentialNumber) {
                    // If same sequential number, prefer closer row
                    const currentDistance = Math.abs(current.rowIndex - connector.rowIndex);
                    const prevDistance = Math.abs(prev.rowIndex - connector.rowIndex);
                    return currentDistance < prevDistance ? current : prev;
                }
                return prev;
            });
        }

        function drawDecisionLineInPage(ctx, decisionCenter, allCenters, pageNumber) {
            // For now, only draw decision lines within the same page
            // You can extend this to handle cross-page decision lines if needed

            // Find the original input field to get return_to value
            // This is simplified - you might need to adapt based on your data structure
            const editorRows = document.querySelectorAll('#editor-tabel tbody tr');

            // Calculate which editor row this decision symbol corresponds to
            const rowsPerPage = ROWS_PER_PAGE; // Use dynamic calculation
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
                    // Cari berdasarkan nomor berurutan, bukan globalNumber
                    let targetSymbol = allCenters.find((center) => center.sequentialNumber === targetNumber);

                    if (targetSymbol) {
                        // Draw decision line within this page with collision detection
                        drawDecisionLineWithCollisionDetection(ctx, decisionCenter, targetSymbol, allCenters, 1);
                    }
                }
            }
        }

        function drawDecisionLineWithCollisionDetection(ctx, decisionCenter, targetSymbol, allCenters, scaleX) {
            const decisionType = getSymbolType(decisionCenter.element);
            const targetType = getSymbolType(targetSymbol.element);
            const decisionDim = getSymbolDimensions(decisionCenter.element, decisionType);
            const targetDim = getSymbolDimensions(targetSymbol.element, targetType);

            const horizontalOffset = Math.max(decisionDim.width / 2 + 10, 25);
            const curveOffset = Math.max(horizontalOffset + 15, 40);

            // Check for potential collision with main flow lines (black lines)
            const useRightSide = shouldUseRightSideForDecisionLine(decisionCenter, targetSymbol, allCenters);

            // Deteksi mode print untuk styling yang berbeda
            const isPrinting = document.body.classList.contains('printing');
            const pageElement = decisionCenter.element.closest('.page-preview');
            const isPrintPage = pageElement && pageElement.classList.contains('print-full-size');

            ctx.save();
            ctx.strokeStyle = '#ef4444';

            // Set line width berdasarkan mode
            if (isPrinting || isPrintPage) {
                ctx.lineWidth = 2; // Fixed width untuk print
            } else {
                ctx.lineWidth = Math.max(2 * scaleX, 2); // Scaled width untuk preview
            }

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

            drawPreviewArrow(ctx, midX, endY, endX, endY, scaleX, isPrinting || isPrintPage);

            // Add "Tidak" text
            const labelText = 'Tidak';

            ctx.fillStyle = '#ef4444';

            // Set font size berdasarkan mode
            if (isPrinting || isPrintPage) {
                ctx.font = '12px Arial'; // Fixed font untuk print
            } else {
                ctx.font = `${Math.max(12 * scaleX, 8)}px Arial`; // Scaled font untuk preview
            }

            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            const textX = midX;
            const textY = startY + (endY - startY) * 0.3;

            // White background for text
            const textMetrics = ctx.measureText(labelText);
            const textWidth = textMetrics.width;
            const textHeight = isPrinting || isPrintPage ? 15 : 15 * scaleX;

            ctx.fillStyle = 'white';
            ctx.fillRect(textX - textWidth / 2 - 2, textY - textHeight / 2 - 1, textWidth + 4, textHeight + 2);

            ctx.fillStyle = '#ef4444';
            ctx.fillText(labelText, textX, textY);

            ctx.restore();
        }

        function shouldUseRightSideForDecisionLine(decisionCenter, targetSymbol, allCenters) {
            console.log(`Decision at column ${decisionCenter.cellIndex}, Target at column ${targetSymbol.cellIndex}`);

            // LOGIC SESUAI PERMINTAAN USER:
            // Jika target symbol (proses) berada di KANAN decision symbol,
            // maka garis merah keluar dari KIRI decision diamond
            if (targetSymbol.cellIndex > decisionCenter.cellIndex) {
                console.log(`Target symbol is to the RIGHT, using LEFT side of decision diamond`);
                return false; // false = left side
            }
            // Jika target symbol (proses) berada di KIRI decision symbol,
            // maka garis merah keluar dari KANAN decision diamond
            else if (targetSymbol.cellIndex < decisionCenter.cellIndex) {
                console.log(`Target symbol is to the LEFT, using RIGHT side of decision diamond`);
                return true; // true = right side
            }
            // Jika di kolom yang sama, gunakan sisi kiri sebagai default
            else {
                console.log(`Target symbol is in the SAME column, using LEFT side of decision diamond`);
                return false; // false = left side
            }
        }

        function wouldLinesIntersect(decisionCenter, targetSymbol, flowFrom, flowTo, useRightSide) {
            const decisionDim = getSymbolDimensions(decisionCenter.element, getSymbolType(decisionCenter.element));
            const targetDim = getSymbolDimensions(targetSymbol.element, getSymbolType(targetSymbol.element));
            const curveOffset = Math.max(decisionDim.width / 2 + 25, 40);

            // Calculate decision line path
            let decisionStartX, decisionMidX, decisionEndX;
            if (useRightSide) {
                decisionStartX = decisionCenter.x + (decisionDim.width / 2 + 8);
                decisionMidX = decisionStartX + curveOffset;
                decisionEndX = targetSymbol.x + (targetDim.width / 2 + 8);
            } else {
                decisionStartX = decisionCenter.x - (decisionDim.width / 2 + 8);
                decisionMidX = decisionStartX - curveOffset;
                decisionEndX = targetSymbol.x - (targetDim.width / 2 + 8);
            }

            const decisionY1 = decisionCenter.y;
            const decisionY2 = targetSymbol.y;

            // Calculate main flow line path
            const flowFromDim = getSymbolDimensions(flowFrom.element, getSymbolType(flowFrom.element));
            const flowToDim = getSymbolDimensions(flowTo.element, getSymbolType(flowTo.element));

            const flowStartY = flowFrom.y + flowFromDim.height / 2 + 8;
            const flowEndY = flowTo.y - flowToDim.height / 2 - 8;
            const flowX = flowFrom.x;

            // Check intersection between vertical segments
            const tolerance = 15; // Minimum distance to avoid visual collision

            // Check if decision line's horizontal segment intersects with flow line
            const minDecisionY = Math.min(decisionY1, decisionY2);
            const maxDecisionY = Math.max(decisionY1, decisionY2);

            // Check if flow line's vertical path intersects decision line's horizontal path
            if (flowStartY <= maxDecisionY && flowEndY >= minDecisionY) {
                // Check horizontal overlap
                const minDecisionX = Math.min(decisionMidX, Math.min(decisionStartX, decisionEndX));
                const maxDecisionX = Math.max(decisionMidX, Math.max(decisionStartX, decisionEndX));

                if (
                    Math.abs(flowX - decisionMidX) < tolerance &&
                    flowX >= minDecisionX - tolerance &&
                    flowX <= maxDecisionX + tolerance
                ) {
                    return true;
                }
            }

            return false;
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

            // Enhanced logging for connectors using sequential numbers
            const fromLabel = from.isConnector ? 'connector' : `symbol ${from.sequentialNumber}`;
            const toLabel = to.isConnector ? 'connector' : `symbol ${to.sequentialNumber}`;
            console.log(`Menggambar garis dari ${fromLabel} (row ${from.rowIndex}) ke ${toLabel} (row ${to.rowIndex})`);

            console.log(`Flow connection: ${fromLabel} -> ${toLabel}`);

            // Deteksi mode print
            const isPrinting = document.body.classList.contains('printing');
            const pageElement = from.element.closest('.page-preview');
            const isPrintPage = pageElement && pageElement.classList.contains('print-full-size');

            // Save context state
            ctx.save();

            // Set clean stroke style
            ctx.strokeStyle = '#000000';

            if (isPrinting || isPrintPage) {
                ctx.lineWidth = 2; // Fixed width untuk print
            } else {
                ctx.lineWidth = Math.max(2 * scaleX, 2);
            }

            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            ctx.beginPath();
            ctx.moveTo(startX, startY);

            // Check if symbols are on the same row (horizontal alignment)
            // Allow small tolerance for row detection due to potential layout differences
            const rowTolerance = 5; // pixels
            const isSameRow = Math.abs(from.rowIndex - to.rowIndex) === 0;

            if (isSameRow) {
                // Same row: draw straight horizontal line from right side of 'from' to left side of 'to'
                console.log(`Same row detected: drawing straight horizontal line from ${fromLabel} to ${toLabel}`);

                // Calculate horizontal connection points based on actual positions
                const isFromLeftToRight = from.x < to.x; // Check if 'from' is to the left of 'to'

                let lineStartX, lineEndX, horizontalY;

                if (isFromLeftToRight) {
                    // From left to right: arrow points right (→)
                    lineStartX = from.x + fromDim.width / 2 + 8; // Right side of 'from'
                    lineEndX = to.x - toDim.width / 2 - 8; // Left side of 'to'
                    horizontalY = from.y;

                    console.log(`Drawing left to right: from ${fromLabel} (${lineStartX}) to ${toLabel} (${lineEndX})`);
                } else {
                    // From right to left: arrow points left (←)
                    lineStartX = from.x - fromDim.width / 2 - 8; // Left side of 'from'
                    lineEndX = to.x + toDim.width / 2 + 8; // Right side of 'to'
                    horizontalY = from.y;

                    console.log(`Drawing right to left: from ${fromLabel} (${lineStartX}) to ${toLabel} (${lineEndX})`);
                }

                // Draw straight horizontal line
                ctx.moveTo(lineStartX, horizontalY);
                ctx.lineTo(lineEndX, horizontalY);
                ctx.stroke();

                // Draw arrow pointing in the correct direction
                drawPreviewArrow(
                    ctx,
                    lineStartX,
                    horizontalY,
                    lineEndX,
                    horizontalY,
                    scaleX,
                    isPrinting || isPrintPage,
                );
            } else {
                // Different rows: use the existing L-shaped connection
                ctx.lineTo(startX, (startY + endY) / 2);
                ctx.lineTo(endX, (startY + endY) / 2);
                ctx.lineTo(endX, endY);
                ctx.stroke();

                // Gambar panah di ujung garis
                drawPreviewArrow(ctx, endX, (startY + endY) / 2, endX, endY, scaleX, isPrinting || isPrintPage);
            }

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

                    // Use the same collision detection logic as the in-page function
                    drawDecisionLineWithCollisionDetection(ctx, decisionCenter, targetSymbol, allCenters, scaleX);
                }
            }
        }

        function drawPreviewArrow(ctx, fromX, fromY, toX, toY, scaleX = 1, isPrintMode = false) {
            // Save context state
            ctx.save();

            // Dynamic arrow size based on scale and minimum size
            const baseHeadlen = 8;
            let headlen;

            if (isPrintMode) {
                headlen = baseHeadlen; // Fixed size untuk print
            } else {
                headlen = Math.max(baseHeadlen * scaleX, 6); // Minimum 6px, scales with zoom
            }

            const angle = Math.atan2(toY - fromY, toX - fromX);

            // Set clean stroke style for arrow
            ctx.strokeStyle = '#000000';

            if (isPrintMode) {
                ctx.lineWidth = 2; // Fixed width untuk print
            } else {
                ctx.lineWidth = Math.max(2 * scaleX, 2);
            }

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
            // Simpan preview yang ada sebelum membuat print pages
            const pagesContainer = document.getElementById('pages-container');
            const previewWrapper = document.getElementById('preview-wrapper');
            const originalContent = pagesContainer.innerHTML;
            const originalScale = previewWrapper.style.transform;

            // Reset scale ke ukuran normal untuk print
            previewWrapper.style.transform = 'scale(1)';

            // Buat halaman print dengan ukuran penuh
            createPrintPagesFullSize();

            // Tunggu layout selesai dan gambar ulang garis penghubung
            setTimeout(() => {
                // Apply print-specific styling
                document.body.classList.add('printing');

                // Gambar ulang semua garis penghubung untuk print
                drawAllPageConnections();

                // Print dengan halaman yang baru dibuat
                setTimeout(() => {
                    window.print();

                    // Remove print styling dan kembalikan ke preview normal
                    setTimeout(() => {
                        document.body.classList.remove('printing');
                        // Kembalikan ke preview normal dengan scale yang ada
                        pagesContainer.innerHTML = originalContent;
                        previewWrapper.style.transform = originalScale;

                        // Gambar ulang garis penghubung untuk preview normal
                        setTimeout(() => {
                            drawAllPageConnections();
                        }, 100);
                    }, 100);
                }, 500); // Tunggu lebih lama untuk print dialog
            }, 500); // Tunggu lebih lama untuk layout selesai
        }

        function createPrintPagesFullSize() {
            // Ambil data langsung dari tabel editor
            const editorRows = document.querySelectorAll('#editor-tabel tbody tr');
            const pagesContainer = document.getElementById('pages-container');

            // Kosongkan container
            pagesContainer.innerHTML = '';

            const rowsPerPage = ROWS_PER_PAGE;
            const processedRowsData = [];

            // Proses data dari editor tabel
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

            // Buat halaman-halaman untuk print dengan ukuran penuh
            const pages = [];
            for (let i = 0; i < processedRowsData.length; i += rowsPerPage) {
                const pageRows = processedRowsData.slice(i, i + rowsPerPage);
                pages.push({
                    number: Math.floor(i / rowsPerPage) + 1,
                    rows: pageRows,
                    needsConnector: i + rowsPerPage < processedRowsData.length,
                });
            }

            // Buat setiap halaman dengan ukuran penuh untuk print
            pages.forEach((page, pageIndex) => {
                const pageDiv = createPrintPageElementFullSize(page, pageIndex === pages.length - 1);
                pagesContainer.appendChild(pageDiv);
            });

            // Gambar koneksi flowchart setelah halaman dibuat
            setTimeout(() => {
                drawAllPageConnections();
            }, 100);
        }
        function createPrintPageElementFullSize(page, isLastPage) {
            const pageDiv = document.createElement('div');
            pageDiv.className = 'page-preview print-full-size';
            pageDiv.id = `print-page-${page.number}`;

            // Tambahkan styling khusus untuk print dengan ukuran penuh
            pageDiv.style.cssText = `
                width: 100% !important;
                max-width: none !important;
                min-height: auto !important;
                transform: none !important;
                scale: 1 !important;
                zoom: 1 !important;
            `;

            // Buat header tabel dengan ukuran penuh
            const tableHeader = `
                <colgroup>
                    <col style="width: 45px" />
                    <col style="width: 260px" />
                    ${Array(jumlahPelaksana).fill('<col style="width: 100px" />').join('')}
                    <col style="width: 130px" />
                    <col style="width: 85px" />
                    <col style="width: 120px" />
                    <col style="width: 103px" />
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

            // Buat body tabel
            let tableBody = '<tbody>';

            // Tambahkan connector row untuk halaman lanjutan
            if (page.number > 1) {
                tableBody += createConnectorRowHTML(0);
            }

            // Tambahkan baris reguler
            page.rows.forEach((rowData) => {
                tableBody += createRowHTML(rowData);
            });

            // Tambahkan connector row untuk halaman berikutnya
            if (page.needsConnector && !isLastPage) {
                tableBody += createConnectorRowHTML(0);
            }

            tableBody += '</tbody>';

            // Buat tabel dengan styling khusus untuk print full size
            const tableStyle = `
                width: 100% !important;
                max-width: none !important;
                transform: none !important;
                scale: 1 !important;
                zoom: 1 !important;
            `;

            pageDiv.innerHTML = `
                <table class="flow-table border border-gray-400 text-sm text-gray-800" style="${tableStyle}">
                    ${tableHeader}
                    ${tableBody}
                </table>
                <canvas class="page-canvas" id="print-canvas-page-${page.number}" style="transform: none !important; scale: 1 !important;"></canvas>
                <div class="page-number">Halaman ${page.number}</div>
            `;

            return pageDiv;
        }

        function createPrintPageElement(page, isLastPage) {
            const pageDiv = document.createElement('div');
            pageDiv.className = 'page-preview';
            pageDiv.id = `print-page-${page.number}`;

            // Buat header tabel
            const tableHeader = `
                <colgroup>
                    <col style="width: 45px" />
                    <col style="width: 260px" />
                    ${Array(jumlahPelaksana).fill('<col style="width: 100px" />').join('')}
                    <col style="width: 130px" />
                    <col style="width: 85px" />
                    <col style="width: 120px" />
                    <col style="width: 103px" />
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

            // Buat body tabel
            let tableBody = '<tbody>';

            // Tambahkan connector row untuk halaman lanjutan
            if (page.number > 1) {
                tableBody += createConnectorRowHTML(0); // Simplified connector
            }

            // Tambahkan baris reguler
            page.rows.forEach((rowData) => {
                tableBody += createRowHTML(rowData);
            });

            // Tambahkan connector row untuk halaman berikutnya
            if (page.needsConnector && !isLastPage) {
                tableBody += createConnectorRowHTML(0); // Simplified connector
            }

            tableBody += '</tbody>';

            pageDiv.innerHTML = `
                <table class="flow-table border border-gray-400 text-sm text-gray-800">
                    ${tableHeader}
                    ${tableBody}
                </table>
                <canvas class="page-canvas" id="print-canvas-page-${page.number}"></canvas>
                <div class="page-number">Halaman ${page.number}</div>
            `;

            return pageDiv;
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

        // Function to show notification to user
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-4 py-3 rounded-md shadow-lg z-50 transition-all duration-300 transform translate-x-0`;

            // Set style based on type
            switch (type) {
                case 'success':
                    notification.className += ' bg-green-500 text-white';
                    break;
                case 'error':
                    notification.className += ' bg-red-500 text-white';
                    break;
                case 'warning':
                    notification.className += ' bg-yellow-500 text-black';
                    break;
                default:
                    notification.className += ' bg-blue-500 text-white';
            }

            notification.textContent = message;

            // Add to DOM
            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }
    </script>
</x-layout>

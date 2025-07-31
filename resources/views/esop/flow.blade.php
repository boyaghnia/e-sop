@php
    $jumlahPelaksana = $esop->pelaksanas->count();
@endphp

<style>
    /* ===== BASE STYLES ===== */

    /* General textarea styling */
    textarea {
        resize: none;
        overflow: auto;
        border: none;
        outline: none;
        min-height: 60px;
        max-height: 120px;
    }

    /* Table base styles */
    table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
        min-width: 1200px;
    }

    /* ===== EDITOR TABLE STYLES ===== */

    /* Main flow table styling */
    .flow-table {
        width: 100%;
        border-collapse: collapse;
    }

    .flow-table thead th {
        padding: 8px 6px;
        font-size: 13px;
        font-weight: 600;
    }

    .flow-table tbody tr {
        height: 80px;
    }

    .flow-table tbody td {
        padding: 8px 6px;
    }

    /* Textarea specific styling */
    .flow-table textarea {
        height: 60px;
        max-height: 60px;
        min-height: 60px;
        overflow-y: auto;
        font-size: 13px;
        line-height: 1.4;
        padding: 6px;
    }

    /* Uraian kegiatan column specific */
    .uraian-column {
        width: 100% !important;
    }

    .uraian-column textarea {
        width: 100%;
        height: 60px;
        max-height: 100px !important;
        overflow-y: auto !important;
        padding: 8px !important;
        min-height: 60px !important;
        font-size: 13px;
        line-height: 1.4;
    }

    /* Select styling */
    .flow-table select {
        font-size: 12px;
        padding: 4px;
    }

    /* ===== SYMBOL STYLES ===== */

    .symbol-preview {
        margin-top: 4px;
        display: flex;
        justify-content: center;
        position: relative;
    }

    /* Connector symbol styling with SVG - same shape as clip-path */
    .symbol-preview .connector-symbol-svg {
        width: 40px;
        height: 40px;
        margin: 0 auto;
    }

    .symbol-preview .connector-symbol-svg polygon {
        fill: #90a4ae !important;
        stroke: #90a4ae;
        stroke-width: 1;
    }

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
        z-index: 10;
    }

    /* ===== CONTAINER STYLES ===== */

    .table-container {
        width: 100%;
        overflow-x: auto !important;
        overflow-y: visible;
    }

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

    /* ===== PREVIEW STYLES ===== */

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

    #preview-container {
        overflow: visible !important;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        position: relative;
    }

    .preview-wrapper .flow-table {
        min-width: auto;
        width: 100%;
        table-layout: fixed;
    }

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

    /* ===== PAGE PREVIEW STYLES ===== */

    .page-preview {
        background: white;
        margin-bottom: 20px;
        page-break-after: always;
        position: relative;
        width: 100%;
        box-sizing: border-box;
        overflow: visible;
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

    .pages-container {
        width: 100%;
        overflow: visible;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        transform-origin: top left;
        transition: transform 0.3s ease;
    }

    .page-preview .flow-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        min-width: 100%;
        max-width: 100%;
        font-size: 10px;
        height: calc(100% - 60px);
    }

    .page-preview .flow-table colgroup col {
        width: auto;
    }

    .page-preview .flow-table thead th,
    .page-preview .flow-table tbody td {
        padding: 6px 4px;
        border: 1px solid #9ca3af;
        font-size: 10px;
        line-height: 1.3;
        word-wrap: break-word;
        overflow-wrap: break-word;
        max-width: 0;
    }

    .page-preview .flow-table tbody tr {
        height: auto;
        min-height: 60px; /* Dikurangi dari 75px untuk konsistensi dengan JS */
    }

    .page-preview .flow-table tbody td {
        min-height: 60px; /* Dikurangi dari 75px untuk konsistensi dengan JS */
        padding: 8px 4px;
    }

    .page-canvas {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
        z-index: 10;
        border: none;
        outline: none;
        background: transparent;
    }

    /* ===== PRINT STYLES ===============================================================
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    */
    @media print {
        /* Print page setup */
        @page {
            size: landscape;
        }

        /* Hide everything by default, show only preview */
        body * {
            visibility: hidden;
        }
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

        /* Override border colors for print - make all borders black */
        .page-preview .flow-table thead th,
        .page-preview .flow-table tbody td {
            border: 1px solid #000 !important;
        }

        /* Override all Tailwind gray borders to black for print */
        .border-gray-400,
        .border-gray-300 {
            border-color: #000 !important;
        }

        /* Reset transforms for print */
        #preview-wrapper {
            transform: none !important;
            scale: 1 !important;
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .pages-container {
            transform: none !important;
            scale: 1 !important;
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Page preview optimization */
        .page-preview {
            page-break-after: always !important;
            break-after: page !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            max-width: none !important;
            min-height: auto !important;
            overflow: hidden !important;
        }

        .page-preview:last-child {
            page-break-after: auto !important;
            break-after: auto !important;
        }

        .page-preview.print-full-size {
            width: 100% !important;
            max-width: none !important;
            min-width: 100% !important;
            transform: none !important;
            scale: 1 !important;
            margin: 0 !important;
        }

        /* Table optimization for print */
        .page-preview .flow-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
            table-layout: fixed;
            min-width: 100%;
            max-width: 100%;
            margin: 0;
            max-height: calc(100vh - 40px) !important;
            overflow: hidden !important;
        }

        .page-preview .flow-table tbody {
            max-height: calc(100vh - 120px) !important;
            overflow: hidden !important;
        }

        /* Cell styling for print */
        .page-preview .flow-table th,
        .page-preview .flow-table td {
            border: 1px solid #000 !important;
            padding: 4px 3px;
            font-size: 9px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            box-sizing: border-box;
        }

        /* Row height optimization */
        .page-preview .flow-table tbody tr {
            height: auto;
            min-height: 85px; /* Disesuaikan dengan min-h-[5rem] + padding */
            max-height: 110px; /* Ditingkatkan untuk mengakomodasi content yang lebih tinggi */
        }

        .page-preview .flow-table tbody td {
            padding: 6px 4px;
            vertical-align: middle;
            max-height: 110px !important; /* Disesuaikan dengan row height baru */
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            word-wrap: break-word !important;
        }

        /* Header optimization */
        .page-preview .flow-table thead th {
            padding: 8px 4px;
            font-weight: bold;
            background-color: #f5f5f5 !important;
            -webkit-print-color-adjust: exact;
            min-height: 35px;
            font-size: 9px;
        }

        /* Uraian kegiatan column for print */
        .page-preview .flow-table tbody td:nth-child(2) {
            overflow-y: hidden !important;
            font-size: 9px !important;
            line-height: 1.2 !important;
        }

        /* Buffer row styling */
        .buffer-row {
            height: 45px !important;
            background-color: white !important;
        }

        .buffer-row td {
            border: 1px solid #000 !important;
            padding: 6px !important;
            vertical-align: middle !important;
            background-color: white !important;
            height: 45px !important;
            min-height: 45px !important;
        }

        /* Symbol styling for print */
        .symbol-preview > div {
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            print-color-adjust: exact;
        }

        .symbol-preview {
            padding: 4px;
            text-align: center;
        }

        /* Canvas styling for print */
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
            z-index: 1 !important;
            pointer-events: none !important;
            border: none !important;
            background: transparent !important;
        }

        #flow-preview-canvas {
            display: block !important;
            position: absolute;
            pointer-events: none;
            z-index: 10;
            border: none !important;
            background: transparent !important;
        }

        /* Hide elements that shouldn't be printed */
        .no-print,
        .debug-button,
        h3,
        .page-number {
            display: none !important;
        }

        /* Print container optimization */
        .table-container {
            overflow-x: visible !important;
        }

        /* Table header repetition */
        #preview-tabel thead {
            display: table-header-group;
        }

        #preview-tabel tbody {
            display: table-row-group;
        }

        /* Remove all background colors for symbols in print */
        .page-preview .symbol-preview > div {
            background-color: transparent !important;
            background: none !important;
            border: 1px solid #000 !important;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Special handling for connector symbols - SVG version with same clip-path shape */
        .page-preview .symbol-preview .connector-symbol-svg {
            width: 40px;
            height: 40px;
            margin: 0 auto;
        }

        .page-preview .symbol-preview .connector-symbol-svg polygon {
            fill: none !important;
            stroke: #000 !important;
            stroke-width: 1 !important;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Ensure symbol numbers are visible in print */
        .page-preview .symbol-number {
            visibility: hidden;
        }

        .page-preview .symbol-number {
            display: none !important;
            visibility: hidden !important;
        }

        .symbol-number {
            display: none !important;
            visibility: hidden !important;
        }
    }
</style>

<x-layout>
    <div class="mb-4 flex items-center justify-between">
        <div class="w-full text-left print:hidden"></div>

        <div class="flex space-x-2">
            <a href="{{ route('esop.print', ['id' => $esop->id]) }}" class="print:hidden">
                <button
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
            </a>
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

    <div id="editor-tabel">
        <form id="esopForm" action="{{ route('flow.update', $esop->id) }}" method="POST">
            @csrf
            <div class="main-content rounded-sm bg-white p-4 shadow-sm">
                <div class="table-container">
                    <table class="flow-table border border-gray-400 text-sm text-gray-800">
                        <colgroup>
                            <col style="width: 50px" />
                            <!-- No -->
                            <col style="width: 300px" />
                            <!-- Uraian Kegiatan lebih lebar untuk F4 -->
                            @for ($i = 0; $i < $jumlahPelaksana; $i++)
                                <col style="width: 150px" />
                                <!-- Pelaksana columns lebih lebar -->
                            @endfor

                            <col style="width: 125px" />
                            <!-- Kelengkapan lebih lebar -->
                            <col style="width: 125px" />
                            <!-- Waktu -->
                            <col style="width: 125px" />
                            <!-- Output lebih lebar -->
                            <col style="width: 125px" />
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
                            onclick="clearAllSymbolsWithSweetAlert()"
                            class="rounded-md border border-red-500 px-3 py-2 text-sm text-red-500 hover:bg-red-50"
                            title="Kosongkan semua pilihan simbol dan reset penomoran"
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
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                />
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <a
                            href="{{ route('esop.edit', ['id' => $esop->id]) }}"
                            class="no-print inline-block rounded-sm bg-gray-500 px-3 py-2 text-sm font-semibold text-white hover:bg-gray-400"
                        >
                            Kembali
                        </a>
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
            </div>
        </form>
    </div>

    <div class="main-content mt-4 rounded-sm bg-white p-4 shadow-sm">
        <div id="preview-area">
            <div class="preview-wrapper" id="preview-wrapper">
                <div id="pages-container" class="pages-container">
                    <!-- Pages will be dynamically generated here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize rowCount based on actual rows in the table, not just flow keys
        let rowCount = Math.max({{ $flows->keys()->max() ?? 0 }}, {{ max(4, $flows->max('no_urutan') ?? 0) }});
        const jumlahPelaksana = {{ $esop->pelaksanas->count() }};
        const pelaksanaIds = @json($esop->pelaksanas->pluck('id'));

        // Array untuk menyimpan urutan simbol berdasarkan pemilihan
        let symbolOrder = [];
        let nextSymbolNumber = 1;

        // Initialize existing symbols on page load
        function initializeExistingSymbols() {
            // First try to load from localStorage
            const loadedFromStorage = loadSymbolOrderFromStorage();

            if (loadedFromStorage && symbolOrder.length > 0) {
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

        function calculateActualRowHeights() {
            // Jika ada preview table (hasil render), ukur tinggi aktual baris di situ
            const previewTable = document.querySelector('.page-preview .flow-table');
            if (previewTable) {
                const rows = previewTable.querySelectorAll('tbody tr:not(.buffer-row)');
                const heights = [];
                rows.forEach((row) => {
                    heights.push(row.getBoundingClientRect().height);
                });
                return heights;
            }
            // Fallback ke estimasi lama jika belum ada preview table
            const editorRows = document.querySelectorAll('#editor-tabel tbody tr');
            const heights = [];
            editorRows.forEach((row, index) => {
                const uraianTextarea = row.querySelector('textarea[name^="uraian_kegiatan_"]');
                if (uraianTextarea && uraianTextarea.value.trim()) {
                    const textLength = uraianTextarea.value.length;
                    const lineCount = Math.ceil(textLength / 250);
                    const actualLineCount = (uraianTextarea.value.match(/\n/g) || []).length + 1;
                    const estimatedLines = Math.max(lineCount, actualLineCount);
                    const estimatedHeight = Math.max(120, 120 + (estimatedLines - 1) * 20);
                    heights.push(estimatedHeight);
                } else {
                    heights.push(80);
                }
            });
            return heights;
        }

        // Function to calculate rows per page based on F4 dimensions
        function calculateRowsPerPage() {
            // F4 landscape: 330mm x 250mm
            const f4LandscapeHeight = 260; // mm
            const availableHeightPx = (f4LandscapeHeight / 25.4) * 96;

            // Ambil header height dari tabel preview jika ada
            let tableHeaderHeight = 0;
            const previewTable = document.querySelector('.page-preview .flow-table');
            if (previewTable) {
                const thead = previewTable.querySelector('thead');
                if (thead) {
                    tableHeaderHeight = thead.getBoundingClientRect().height;
                }
            } else {
                tableHeaderHeight = 70; // fallback
            }

            const safetyMargin = 0;
            const actualRowHeights = calculateActualRowHeights();
            const averageActualHeight =
                actualRowHeights.length > 0
                    ? actualRowHeights.reduce((sum, height) => sum + height, 0) / actualRowHeights.length
                    : 85;
            const availableForRows = availableHeightPx - tableHeaderHeight - safetyMargin;
            const maxRows = Math.floor(availableForRows / averageActualHeight);
            return maxRows > 0 ? maxRows : 1;
        }

        // Get dynamic rows per page - recalculate every time
        let ROWS_PER_PAGE = calculateRowsPerPage();

        // Function to get current ROWS_PER_PAGE (always fresh calculation)
        function getCurrentRowsPerPage() {
            ROWS_PER_PAGE = calculateRowsPerPage();
            return ROWS_PER_PAGE;
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
                const containerWidth = previewArea.clientWidth; // Padding for pages
                const containerHeight = previewArea.clientHeight; // Padding for pages
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
            // Get current number of rows in table to ensure proper numbering
            const tbody = document.getElementById('tbody-flow');
            const currentRowCount = tbody.children.length;

            // Use the higher value between rowCount and actual table rows
            rowCount = Math.max(rowCount, currentRowCount);
            rowCount++;

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

                // Update rowCount to match actual table rows
                const actualRowCount = tbody.children.length;
                rowCount = actualRowCount;

                syncPreviewTable();
                setTimeout(debouncedAutoScale, 300);
            }
        }

        function clearAllSymbolsWithSweetAlert() {
            Swal.fire({
                title: 'Hapus Simbol?',
                text: 'Apakah Anda yakin ingin mengosongkan semua pilihan simbol? Tindakan ini tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Kosongkan!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
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

                    // Tampilkan notifikasi sukses
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Semua pilihan simbol telah dikosongkan.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            });
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
            }, 200);
        }

        function createPageElement(page, isLastPage) {
            const pageDiv = document.createElement('div');
            pageDiv.className = 'page-preview';
            pageDiv.id = `page-${page.number}`;

            // Create table header
            const tableHeader = `
                <colgroup>
                    <col style="width: 50px" />
                    <col style="width: 300px" />
                    ${Array(jumlahPelaksana).fill('<col style="width: 120px" />').join('')}
                    <col style="width: 125px" />
                    <col style="width: 125px" />
                    <col style="width: 125px" />
                    <col style="width: 125px" />
                </colgroup>
                <thead>
                    <tr class="bg-gray-100 text-center font-semibold">
                        <th rowspan="2" class="border border-gray-400 px-2 py-1 align-middle">No</th>
                        <th rowspan="2" class="border border-gray-400 px-2 py-1 align-middle">Uraian Kegiatan</th>
                        <th colspan="${jumlahPelaksana}" class="border border-gray-400 px-2 py-1">Pelaksana</th>
                        <th colspan="3" class="border border-gray-400 px-2 py-1">Mutu Baku</th>
                        <th rowspan="2" class="border border-gray-400 px-2 py-1">Keterangan</th>
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
                        <div class="px-2 py-1 text-sm min-h-[5rem] whitespace-pre-wrap">${rowData.uraianKegiatan}</div>
                    </td>
                    ${pelaksanaHTML}
                    <td class="border border-gray-400 px-2 py-1">
                        <div class="px-2 py-1 text-sm min-h-[5rem] whitespace-pre-wrap">${rowData.kelengkapan}</div>
                    </td>
                    <td class="border border-gray-400 px-2 py-1">
                        <div class="px-2 py-1 text-sm min-h-[5rem] whitespace-pre-wrap">${rowData.waktu}</div>
                    </td>
                    <td class="border border-gray-400 px-2 py-1">
                        <div class="px-2 py-1 text-sm min-h-[5rem] whitespace-pre-wrap">${rowData.output}</div>
                    </td>
                    <td class="border border-gray-400 px-2 py-1">
                        <div class="px-2 py-1 text-sm min-h-[5rem] whitespace-pre-wrap">${rowData.keterangan}</div>
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
                                <svg class="connector-symbol-svg" width="40" height="40" viewBox="0 0 40 40">
                                    <polygon points="0,0 40,0 40,20 20,40 0,20"
                                             fill="none"
                                             stroke="#000"
                                             stroke-width="2"/>
                                </svg>
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

            // Dapatkan semua simbol dari halaman ini (div biasa dan SVG connector)
            const symbols = table.querySelectorAll(
                '.symbol-preview > div:first-child, .symbol-preview > svg.connector-symbol-svg',
            );

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

            ctx.fillStyle = '#ef4444'; // Red color for "Tidak" text

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
            // LOGIC SESUAI PERMINTAAN USER:
            // Jika target symbol (proses) berada di KANAN decision symbol,
            // maka garis merah keluar dari KIRI decision diamond
            if (targetSymbol.cellIndex > decisionCenter.cellIndex) {
                return false; // false = left side
            }
            // Jika target symbol (proses) berada di KIRI decision symbol,
            // maka garis merah keluar dari KANAN decision diamond
            else if (targetSymbol.cellIndex < decisionCenter.cellIndex) {
                return true; // true = right side
            }
            // Jika di kolom yang sama, gunakan sisi kiri sebagai default
            else {
                return false; // false = left side
            }
        }

        function getSymbolType(element) {
            if (element.classList.contains('bg-blue-500')) return 'start';
            if (element.classList.contains('bg-green-500')) return 'process';
            if (element.classList.contains('bg-yellow-400')) return 'decision';
            if (element.classList.contains('connector-symbol-svg')) return 'connector'; // Connector SVG symbol in buffer row
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

                // Calculate horizontal connection points based on actual positions
                const isFromLeftToRight = from.x < to.x; // Check if 'from' is to the left of 'to'

                let lineStartX, lineEndX, horizontalY;

                if (isFromLeftToRight) {
                    // From left to right: arrow points right (→)
                    lineStartX = from.x + fromDim.width / 2 + 8; // Right side of 'from'
                    lineEndX = to.x - toDim.width / 2 - 8; // Left side of 'to'
                    horizontalY = from.y;
                } else {
                    // From right to left: arrow points left (←)
                    lineStartX = from.x - fromDim.width / 2 - 8; // Left side of 'from'
                    lineEndX = to.x + toDim.width / 2 + 8; // Right side of 'to'
                    horizontalY = from.y;
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

        // Initialize preview table on page load
        document.addEventListener('DOMContentLoaded', function () {
            // Sync rowCount with actual table rows
            const tbody = document.getElementById('tbody-flow');
            if (tbody) {
                const actualRowCount = tbody.children.length;
                rowCount = Math.max(rowCount, actualRowCount);
            }

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

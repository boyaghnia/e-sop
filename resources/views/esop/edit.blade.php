<x-layout>
    {{--
        <style>
        @media print {
        /* Sembunyikan semua elemen kecuali tabel */
        body * {
        visibility: hidden;
        }
        
        /* Tampilkan hanya tabel dan parent-nya */
        .print-area,
        .print-area * {
        visibility: visible;
        font-size: 11px;
        }
        
        /* Posisikan tabel di print area */
        .print-area {
        left: 0;
        top: 0;
        position: absolute;
        width: 100%;
        height: 100%;
        max-height: 100%;
        overflow: hidden !important;
        transform-origin: center center;
        page-break-inside: avoid;
        }
        
        /* Style khusus untuk print */
        table {
        border-collapse: collapse !important;
        width: 100% !important;
        height: auto !important;
        table-layout: fixed !important;
        page-break-inside: avoid !important;
        }
        
        td {
        border: 1px solid black !important;
        padding: 4px !important;
        color: black !important;
        font-size: 10px !important;
        word-wrap: break-word !important;
        overflow: hidden !important;
        height: auto !important;
        }
        
        .text-gray-800,
        .text-gray-400 {
        color: black !important;
        }
        
        img {
        max-width: 120px !important;
        max-height: 80px !important;
        height: auto !important;
        width: auto !important;
        }
        
        /* Pastikan font size konsisten */
        p,
        div,
        span {
        font-size: 11px !important;
        margin: 0 !important;
        padding: 0 !important;
        line-height: 1.5 !important;
        }
        
        /* Tambahkan CSS khusus untuk tanda tangan */
        .ttd-spacing {
        margin-left: 3rem !important;
        }
        
        /* Atau alternatif dengan padding-left */
        .ttd-spacing-alt {
        padding-left: 3rem !important;
        }
        
        .spacing {
        margin-left: 1rem !important;
        }
        
        @page {
        margin: 10mm;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
        }
        
        /* Hindari page break di dalam tabel */
        tbody,
        tr,
        td {
        page-break-inside: avoid !important;
        break-inside: avoid !important;
        }
        
        tr:nth-child(-n + 4) {
        height: 35px !important;
        }
        
        tr:nth-child(6) {
        height: 40px !important;
        }
        
        tr:nth-child(8) {
        height: auto !important;
        }
        
        tr:nth-child(10) {
        height: 125px !important;
        }
        
        tr:nth-child(12) {
        height: 125px !important;
        }
        }
        </style>
    --}}

    <div class="mb-4 flex items-center justify-between">
        <div class="w-full text-left print:hidden">
            <span class="text-lg font-bold text-slate-700"></span>
        </div>

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
            <a href="{{ route('esop.flow', ['id' => $esop->id]) }}" class="print:hidden">
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
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
                    } else if (ref.includes('/esop/print')) {
                        backBtn.href = '{{ route('esop.tampil') }}';
                    } else {
                        backBtn.href = ref || '{{ route('dashboard.tampil') }}';
                    }
                });
            </script>
        </div>
    </div>

    <div class="flex space-x-3">
        <div class="w-[35%] rounded-sm bg-white p-4 shadow-sm">
            <form id="esopForm" action="{{ route('esop.update', ['id' => $esop->id]) }}" method="POST">
                @csrf
                <div class="px-2">
                    <div class="space-y-12">
                        <div class="pb-2">
                            <div class="mt-2 grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-6">
                                <div class="sm:col-span-6">
                                    <label for="judul_sop" class="block text-sm/6 font-medium text-gray-900">
                                        Unit Kerja
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="judul_sop"
                                                id="judul_sop"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('judul_sop', $esop->judul_sop ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="no_sop" class="block text-sm/6 font-medium text-gray-900">
                                        Nomor SOP
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="no_sop"
                                                id="no_sop"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('no_sop', $esop->no_sop ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="tgl_ditetapkan" class="block text-sm/6 font-medium text-gray-900">
                                        Tanggal Ditetapkan
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="tgl_ditetapkan"
                                                id="tgl_ditetapkan"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('tgl_ditetapkan', $esop->tgl_ditetapkan ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="tgl_revisi" class="block text-sm/6 font-medium text-gray-900">
                                        Tanggal Revisi
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="tgl_revisi"
                                                id="tgl_revisi"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('tgl_revisi', $esop->tgl_revisi ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="tgl_diberlakukan" class="block text-sm/6 font-medium text-gray-900">
                                        Tanggal Diberlakukan
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="tgl_diberlakukan"
                                                id="tgl_diberlakukan"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('tgl_diberlakukan', $esop->tgl_diberlakukan ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="ditetapkan_oleh" class="block text-sm/6 font-medium text-gray-900">
                                        Ditetapkan Oleh
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="ditetapkan_oleh"
                                                id="ditetapkan_oleh"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('ditetapkan_oleh', $esop->ditetapkan_oleh ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="nama_sop" class="block text-sm/6 font-medium text-gray-900">
                                        Judul Naskah SOP
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="nama_sop"
                                                id="nama_sop"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('nama_sop', $esop->nama_sop ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="dasar_hukum" class="block text-sm/6 font-medium text-gray-900">
                                        Dasar Hukum
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="dasar_hukum"
                                                id="dasar_hukum"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('dasar_hukum', $esop->dasar_hukum ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="cara_mengatasi" class="block text-sm/6 font-medium text-gray-900">
                                        Cara Mengatasi
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="cara_mengatasi"
                                                id="cara_mengatasi"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('cara_mengatasi', $esop->cara_mengatasi ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="keterkaitan" class="block text-sm/6 font-medium text-gray-900">
                                        Keterkaitan
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="keterkaitan"
                                                id="keterkaitan"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('keterkaitan', $esop->keterkaitan ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label
                                        for="peralatan_perlengkapan"
                                        class="block text-sm/6 font-medium text-gray-900"
                                    >
                                        Peralatan
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="peralatan_perlengkapan"
                                                id="peralatan_perlengkapan"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('peralatan_perlengkapan', $esop->peralatan_perlengkapan ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="peringatan" class="block text-sm/6 font-medium text-gray-900">
                                        Peringatan
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="peringatan"
                                                id="peringatan"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('peringatan', $esop->peringatan ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end gap-x-2 py-5">
                                <a href="{{ url('/esop') }}">
                                    <button
                                        type="button"
                                        id="editButton"
                                        class="cursor-pointer rounded-sm bg-gray-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-400 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                                    >
                                        Kembali
                                    </button>
                                </a>
                                <button
                                    type="submit"
                                    id="simpanButton"
                                    onclick="showSuccessAlert()"
                                    class="cursor-pointer rounded-sm bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                >
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="w-[65%] space-y-3">
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
                                <div id="preview_judul_sop" class="text-center text-sm text-gray-800"></div>
                            </td>
                            <td colspan="2" class="border p-2 font-bold">Nomor SOP</td>
                            <td colspan="3" class="border p-2">
                                <div id="preview_no_sop" class="text-left text-sm text-gray-800"></div>
                            </td>
                        </tr>

                        <!-- === Tgl. Ditetapkan === -->
                        <tr>
                            <td colspan="2" class="border p-2 font-bold">Tgl. Ditetapkan</td>
                            <td colspan="3" class="border p-2">
                                {{-- Input Tgl. Ditetapkan --}}
                                <div id="preview_tgl_ditetapkan" class="text-left text-sm text-gray-800"></div>
                            </td>
                        </tr>

                        <!-- === Tgl. Revisi === -->
                        <tr>
                            <td colspan="2" class="border p-2 font-bold">Tgl. Revisi</td>
                            <td colspan="3" class="border p-2">
                                {{-- Input Tgl. Revisi --}}
                                <div id="preview_tgl_revisi" class="text-left text-sm text-gray-800"></div>
                            </td>
                        </tr>

                        <!-- === Tgl. Diberlakukan === -->
                        <tr>
                            <td colspan="2" class="border p-2 font-bold">Tgl. Diberlakukan</td>
                            <td colspan="3" class="border p-2">
                                {{-- Input Tgl. Diberlakukan --}}
                                <div id="preview_tgl_diberlakukan" class="text-left text-sm text-gray-800"></div>
                            </td>
                        </tr>

                        <!-- === Ditetapkan Oleh === -->
                        <tr>
                            <td colspan="2" class="border p-2 font-bold">Ditetapkan Oleh</td>
                            <td colspan="3" class="border p-2 text-left">
                                {{--
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
                                --}}
                                <div id="preview_ditetapkan_oleh" class="text-left text-sm text-gray-800"></div>
                            </td>
                        </tr>

                        <!-- === Input Nama SOP === -->
                        <tr>
                            <td colspan="10" class="border p-2 font-bold">
                                <div id="preview_nama_sop" class="text-center text-sm text-gray-800"></div>
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
                                <div id="preview_dasar_hukum" class="text-left text-sm text-gray-800"></div>
                            </td>
                            <td colspan="5" class="border p-2 align-top">
                                <div id="preview_cara_mengatasi" class="text-left text-sm text-gray-800"></div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" class="border p-2 font-bold">Keterkaitan :</td>
                            <td colspan="5" class="border p-2 font-bold">Peralatan :</td>
                        </tr>

                        <tr>
                            <td colspan="5" class="border p-2 align-top">
                                <div id="preview_keterkaitan" class="text-left text-sm text-gray-800"></div>
                            </td>
                            <td colspan="5" rowspan="3" class="border p-2 align-top">
                                <div id="preview_peralatan_perlengkapan" class="text-left text-sm text-gray-800"></div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" class="border p-2 font-bold">Peringatan :</td>
                        </tr>

                        <tr>
                            <td colspan="5" class="border p-2 align-top">
                                <div id="preview_peringatan" class="text-left text-sm text-gray-800"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                {{--
                    <div class="flex items-center justify-between gap-x-2 py-5">
                    <button
                    type="button"
                    onclick="window.print()"
                    class="cursor-pointer rounded-sm bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-400 focus-visible:outline-offset-2 focus-visible:outline-green-600"
                    >
                    Cetak
                    </button>
                    </div>
                --}}
            </div>

            <div class="flex space-x-3">
                <div class="w-[60%] rounded-sm bg-white p-4 shadow-sm">
                    <form id="esopForm" action="{{ route('esop.flow.simpan', ['id' => $esop->id]) }}" method="POST">
                        @csrf
                        <div class="">
                            <div class="space-y-12">
                                <div class="pb-2">
                                    <div class="mt-2 grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-6">
                                        <div class="sm:col-span-6">
                                            <label
                                                for="unit_organisasi"
                                                class="block text-sm/6 font-medium text-gray-900"
                                            >
                                                Unit Kerja
                                            </label>
                                            <div class="mt-2 grid grid-cols-1">
                                                <select
                                                    id="unit_kerja"
                                                    name="unit_kerja"
                                                    readonly
                                                    disabled
                                                    class="form-control pointer-events-none col-start-1 row-start-1 w-full appearance-none rounded-md bg-gray-100 py-1.5 pr-8 pl-3 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 focus:outline focus:-outline-offset-2 sm:text-sm/6"
                                                >
                                                    <option value="{{ $esop->user->id ?? '' }}" selected>
                                                        {{ $esop->user->name ?? 'User tidak ditemukan' }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label class="block text-sm font-medium text-gray-900">Pelaksana</label>
                                            <div id="pelaksana-container" class="mt-2 space-y-2">
                                                @foreach ($esop->pelaksanas as $index => $pelaksana)
                                                    <div
                                                        class="pelaksana-row flex items-center rounded-md bg-white px-3 py-1.5 outline outline-gray-300 focus-within:outline-1 focus-within:-outline-offset-1 focus-within:outline-blue-600"
                                                    >
                                                        <textarea
                                                            name="pelaksana[]"
                                                            rows="1"
                                                            class="form-control block w-full resize-none overflow-hidden bg-white text-base text-gray-900 outline-none placeholder:text-gray-400 sm:text-sm"
                                                            oninput="this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                                        >
{{ old('pelaksana.' . $index, $pelaksana->isi) }}</textarea
                                                        >

                                                        {{-- Tampilkan ikon hapus hanya jika lebih dari 1 --}}
                                                        @if ($loop->index > 0)
                                                            <span
                                                                class="ml-2 cursor-pointer text-gray-400"
                                                                onclick="this.parentElement.remove()"
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
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endforeach

                                                {{-- Jika tidak ada pelaksana, tambahkan satu textarea kosong --}}
                                                @if ($esop->pelaksanas->isEmpty())
                                                    <div
                                                        class="pelaksana-row flex items-center rounded-md bg-white px-3 py-1.5 outline outline-gray-300 focus-within:outline-1 focus-within:-outline-offset-1 focus-within:outline-blue-600"
                                                    >
                                                        <textarea
                                                            name="pelaksana[]"
                                                            rows="1"
                                                            class="form-control block w-full resize-none overflow-hidden bg-white text-base text-gray-900 outline-none placeholder:text-gray-400 sm:text-sm"
                                                            oninput="this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                                        ></textarea>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Tombol tambah pelaksana -->
                                            <div class="mt-4 flex items-center justify-between">
                                                <button
                                                    type="button"
                                                    onclick="addPelaksanaField()"
                                                    class="inline-flex items-center gap-1 rounded-md border border-blue-500 px-3 py-2 text-sm font-medium text-blue-500 hover:bg-blue-50"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M12 4.5v15m7.5-7.5h-15"
                                                        />
                                                    </svg>
                                                    Tambah Pelaksana
                                                </button>

                                                {{--
                                                    <a href="{{ url('/esop/flow') }}">
                                                    <button
                                                    type="button"
                                                    id="editButton"
                                                    class="cursor-pointer rounded-sm bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                                                    >
                                                    Lanjut
                                                    </button>
                                                    </a>
                                                --}}
                                                <button
                                                    type="submit"
                                                    id="simpanButton"
                                                    onclick="showSuccessAlert()"
                                                    class="cursor-pointer rounded-sm bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                                >
                                                    Lanjut
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="w-[40%] rounded-sm bg-white p-4 shadow-sm">
                    <form
                        id="fileUploadForm"
                        action="{{ route('esop.upload.file', ['id' => $esop->id]) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        <div>
                            <label for="file" class="mt-2 block text-sm/6 font-medium text-gray-900">File</label>

                            @if ($esop->file_path && $esop->file_name)
                                <!-- File sudah ada -->
                                <div
                                    class="mx-auto mt-2 w-full max-w-lg rounded-sm border-2 border-solid border-green-300 bg-green-50 p-5 text-center"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="mx-auto h-8 w-8 text-green-500"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                        />
                                    </svg>

                                    <h2 class="mt-1 font-medium tracking-wide text-green-700">File Terupload</h2>
                                    <p class="mt-1 text-sm font-medium text-green-600">{{ $esop->file_name }}</p>

                                    <div class="mt-3 flex justify-center gap-2">
                                        <a
                                            href="{{ asset('storage/' . $esop->file_path) }}"
                                            target="_blank"
                                            class="inline-flex items-center rounded-md border border-green-500 bg-white px-3 py-2 text-sm font-medium text-green-500 hover:bg-green-50"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="mr-1 h-4 w-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                                />
                                            </svg>
                                            Lihat File
                                        </a>
                                        <button
                                            type="button"
                                            onclick="showUploadForm()"
                                            class="inline-flex items-center rounded-md bg-blue-500 px-3 py-2 text-sm font-medium text-white hover:bg-blue-600"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="mr-1 h-4 w-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"
                                                />
                                            </svg>
                                            Upload Ulang
                                        </button>
                                    </div>
                                </div>

                                <p class="mt-4 text-center text-xs text-green-500">
                                    *terima kasih telah mengisi semua data sekarang status SOP anda telah disahkan
                                </p>

                                <!-- Form upload yang tersembunyi -->
                                <div id="uploadFormContainer" class="hidden">
                                    <label
                                        for="dropzone-file"
                                        class="mx-auto mt-2 flex w-full max-w-lg cursor-pointer flex-col items-center rounded-sm border-2 border-dashed border-gray-300 bg-white p-5 text-center"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="h-8 w-8 text-gray-500"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"
                                            />
                                        </svg>

                                        <h2 class="mt-1 font-medium tracking-wide text-gray-700">Upload File Baru</h2>

                                        <p class="mt-2 text-xs tracking-wide text-gray-500">
                                            Upload SOP yang sudah ditandatangani dalam format PDF disini (maks. 1MB)
                                        </p>

                                        <input
                                            id="dropzone-file"
                                            name="file"
                                            type="file"
                                            accept=".pdf"
                                            class="hidden"
                                            onchange="handleFileUpload()"
                                        />
                                    </label>
                                    <div class="mt-2 flex justify-center gap-2">
                                        <button
                                            type="button"
                                            onclick="hideUploadForm()"
                                            class="rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                        >
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            @else
                                <!-- Belum ada file -->
                                <label
                                    for="dropzone-file"
                                    class="mx-auto mt-2 flex w-full max-w-lg cursor-pointer flex-col items-center rounded-sm border-2 border-dashed border-gray-300 bg-white p-5 text-center"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-8 w-8 text-gray-500"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"
                                        />
                                    </svg>

                                    <h2 class="mt-1 font-medium tracking-wide text-gray-700">Upload File</h2>

                                    <p class="mt-2 text-xs tracking-wide text-gray-500">
                                        Upload SOP yang sudah ditandatangani dalam format PDF disini (maks. 1MB)
                                    </p>

                                    <input
                                        id="dropzone-file"
                                        name="file"
                                        type="file"
                                        accept=".pdf"
                                        class="hidden"
                                        onchange="handleFileUpload()"
                                    />
                                </label>

                                <p class="mt-4 text-center text-xs text-gray-500">
                                    *pastikan anda telah mengisi cover sop dan flowchart terlebih dahulu, apabila anda
                                    belum mengisi hal tersebut silahkan klik tombol lanjut di sebelah kiri
                                </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateEsopPreview() {
            const pairs = [
                ['judul_sop', 'preview_judul_sop'],
                ['no_sop', 'preview_no_sop'],
                ['tgl_ditetapkan', 'preview_tgl_ditetapkan'],
                ['tgl_revisi', 'preview_tgl_revisi'],
                ['tgl_diberlakukan', 'preview_tgl_diberlakukan'],
                ['ditetapkan_oleh', 'preview_ditetapkan_oleh'],
                ['nama_sop', 'preview_nama_sop'],
                ['dasar_hukum', 'preview_dasar_hukum'],
                ['keterkaitan', 'preview_keterkaitan'],
                ['peralatan_perlengkapan', 'preview_peralatan_perlengkapan'],
                ['peringatan', 'preview_peringatan'],
                ['cara_mengatasi', 'preview_cara_mengatasi'],
            ];

            pairs.forEach(([inputId, previewId]) => {
                const textarea = document.getElementById(inputId);
                const preview = document.getElementById(previewId);
                if (!textarea || !preview) return;

                const rawLines = textarea.value.split('\n');

                // Khusus untuk "Ditetapkan Oleh"
                if (inputId === 'ditetapkan_oleh') {
                    const html = rawLines
                        .map((line) => {
                            const trimmed = line.trim();
                            // Berikan margin kiri pada baris tanda tangan
                            if (trimmed === '${ttd_pengirim}') {
                                return `<p class="mb-1" style="margin-left:2rem;">${trimmed}</p>`;
                            }
                            // Baris kosong
                            if (trimmed === '') {
                                return '<p class="mb-1">&nbsp;</p>';
                            }
                            // Baris biasa
                            return `<p class="mb-1">${trimmed}</p>`;
                        })
                        .join('');
                    preview.innerHTML = html || '<em class="text-gray-400">Tidak ada isian</em>';
                    return;
                }

                // Hilangkan baris kosong dan spasi depan/belakang untuk field lainnya
                const lines = rawLines.map((line) => line.trim()).filter((line) => line !== '');

                // Tampilkan sebagai paragraf biasa (tanpa penomoran)
                if (
                    ['judul_sop', 'no_sop', 'tgl_ditetapkan', 'tgl_revisi', 'tgl_diberlakukan', 'nama_sop'].includes(
                        inputId,
                    )
                ) {
                    const paragraphs = lines.map((line) => `<p class="mb-1">${line}</p>`);
                    let customClass = '';
                    if (inputId === 'judul_sop') {
                        customClass =
                            'mt-2 w-full resize-none overflow-hidden border-none text-center text-base leading-snug font-bold outline-none';
                    } else if (inputId === 'nama_sop') {
                        customClass =
                            'w-full resize-none overflow-hidden border-none text-center font-bold outline-none';
                    }
                    preview.innerHTML = paragraphs.length
                        ? `<div class="${customClass}">${paragraphs.join('')}</div>`
                        : '<em class="text-gray-400">Tidak ada isian</em>';
                } else {
                    // Field lainnya tampilkan sebagai daftar bernomor
                    const listItems = lines.map((line) => {
                        const clean = line.replace(/^\d+\.\s*/, '');
                        return `<li>${clean}</li>`;
                    });
                    preview.innerHTML = listItems.length
                        ? `<ol class="list-decimal pl-4">${listItems.join('')}</ol>`
                        : '<em class="text-gray-400">Tidak ada isian</em>';
                }
            });
        }

        // Panggil fungsi ini sekali saat halaman dimuat
        document.addEventListener('DOMContentLoaded', updateEsopPreview);
    </script>

    <script>
        let pelaksanaCounter = 1;

        function addPelaksanaField() {
            pelaksanaCounter++;

            const container = document.getElementById('pelaksana-container');

            const wrapper = document.createElement('div');
            wrapper.className =
                'pelaksana-row flex items-center rounded-md bg-white py-1.5 px-3 outline outline-gray-300 focus-within:outline-1 focus-within:-outline-offset-1 focus-within:outline-blue-600';

            const textarea = document.createElement('textarea');
            textarea.name = 'pelaksana[]';
            textarea.rows = 1;
            textarea.className =
                'form-control block w-full resize-none overflow-hidden bg-white text-base text-gray-900 outline-none placeholder:text-gray-400 sm:text-sm';
            textarea.setAttribute('oninput', "this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';");

            const deleteSpan = document.createElement('span');
            deleteSpan.className = 'ml-2 text-gray-400 cursor-pointer';
            deleteSpan.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
          <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </svg>

                `;
            deleteSpan.onclick = () => container.removeChild(wrapper);

            wrapper.appendChild(textarea);
            wrapper.appendChild(deleteSpan);

            container.appendChild(wrapper);
        }
    </script>

    <script>
        document.addEventListener('keydown', function (e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                e.preventDefault();
            }
        });
    </script>

    <script>
        function showUploadForm() {
            document.getElementById('uploadFormContainer').classList.remove('hidden');
        }

        function hideUploadForm() {
            document.getElementById('uploadFormContainer').classList.add('hidden');
        }

        function handleFileUpload() {
            const fileInput = document.getElementById('dropzone-file');
            const file = fileInput.files[0];

            if (file) {
                // Validasi ukuran file (maksimal 1MB)
                if (file.size > 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: 'Ukuran file terlalu besar. Maksimal 1MB.',
                        confirmButtonColor: '#d33'
                    });
                    fileInput.value = '';
                    return;
                }

                // Validasi tipe file
                if (file.type !== 'application/pdf') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format File Salah',
                        text: 'Hanya file PDF yang diperbolehkan.',
                        confirmButtonColor: '#d33'
                    });
                    fileInput.value = '';
                    return;
                }

                // Konfirmasi upload dengan SweetAlert
                Swal.fire({
                    title: 'Upload File?',
                    text: `Upload file "${file.name}"?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Upload!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Mengupload...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        document.getElementById('fileUploadForm').submit();
                    } else {
                        fileInput.value = '';
                    }
                });
            }
        }

        // Tampilkan SweetAlert untuk session messages
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#10b981',
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33'
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                html: '@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach',
                confirmButtonColor: '#d33'
            });
        @endif
    </script>
</x-layout>

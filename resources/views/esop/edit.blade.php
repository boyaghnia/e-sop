<x-layout>
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
                                        Judul SOP (Unit Organisasi)
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="judul_sop"
                                                id="judul_sop"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
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
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
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
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
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
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
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
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
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
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            >
{{ old('ditetapkan_oleh', $esop->ditetapkan_oleh ?? '') }}</textarea
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="nama_sop" class="block text-sm/6 font-medium text-gray-900">
                                        Nama SOP
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="nama_sop"
                                                id="nama_sop"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
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
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
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
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
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
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
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
                                        Peralatan / Perlengkapan
                                    </label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="mt-1">
                                            <textarea
                                                type="text"
                                                name="peralatan_perlengkapan"
                                                id="peralatan_perlengkapan"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
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
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
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

            <div class="rounded-sm bg-white p-4 shadow-sm">
                <form id="esopForm" action="{{ route('esop.flow.simpan', ['id' => $esop->id]) }}" method="POST">
                    @csrf
                    <div class="">
                        <div class="space-y-12">
                            <div class="pb-2">
                                <div class="mt-2 grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <label for="unit_organisasi" class="block text-sm/6 font-medium text-gray-900">
                                            Unit Organisasi
                                        </label>
                                        <div class="mt-2 grid grid-cols-1">
                                            <select
                                                id="unit_organisasi"
                                                name="unit_organisasi"
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

                                    <div class="sm:col-span-4">
                                        <label class="block text-sm font-medium text-gray-900">Pelaksana</label>
                                        <div id="pelaksana-container" class="mt-2 space-y-2">
                                            @foreach ($esop->pelaksanas as $index => $pelaksana)
                                                <div
                                                    class="pelaksana-row flex items-center rounded-md bg-white px-3 py-1.5 outline outline-gray-300 focus-within:outline-1 focus-within:-outline-offset-1 focus-within:outline-indigo-600"
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
                                                    class="pelaksana-row flex items-center rounded-md bg-white px-3 py-1.5 outline outline-gray-300 focus-within:outline-1 focus-within:-outline-offset-1 focus-within:outline-indigo-600"
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
                                                class="inline-flex items-center gap-1 rounded-md border border-blue-500 px-3 py-2 text-sm font-medium text-blue-500 hover:bg-indigo-50"
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
                ['cara_mengatasi', 'preview_cara_mengatasi'],
                ['keterkaitan', 'preview_keterkaitan'],
                ['peralatan_perlengkapan', 'preview_peralatan_perlengkapan'],
                ['peringatan', 'preview_peringatan'],
            ];

            pairs.forEach(([inputId, previewId]) => {
                const textarea = document.getElementById(inputId);
                const preview = document.getElementById(previewId);
                if (!textarea || !preview) return;

                const lines = textarea.value
                    .split('\n')
                    .map((line) => line.trim())
                    .filter((line) => line !== '');

                // ➤ Untuk "paragraf biasa" (tanpa list)
                if (
                    [
                        'judul_sop',
                        'no_sop',
                        'tgl_ditetapkan',
                        'tgl_revisi',
                        'tgl_diberlakukan',
                        'ditetapkan_oleh',
                        'nama_sop',
                    ].includes(inputId)
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
                        : '<em class="text-gray-400"></em>';
                } else {
                    // ➤ Untuk yang lain pakai <ol><li>
                    const listItems = lines.map((line) => {
                        const clean = line.replace(/^\d+\.\s*/, '');
                        return `<li>${clean}</li>`;
                    });

                    preview.innerHTML = listItems.length
                        ? `<ol class="list-decimal pl-4">${listItems.join('')}</ol>`
                        : '<em class="text-gray-400"></em>';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', updateEsopPreview);
    </script>

    <script>
        let pelaksanaCounter = 1;

        function addPelaksanaField() {
            pelaksanaCounter++;

            const container = document.getElementById('pelaksana-container');

            const wrapper = document.createElement('div');
            wrapper.className =
                'pelaksana-row flex items-center rounded-md bg-white py-1.5 px-3 outline outline-gray-300 focus-within:outline-1 focus-within:-outline-offset-1 focus-within:outline-indigo-600';

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
</x-layout>

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
                position: fixed;
                width: 100vh;
                height: 100vw;
                overflow: hidden !important;
                transform-origin: top left;
                transform: rotate(-90deg) translate(-100%, 0);
                page-break-inside: avoid;
            }

            /* Style khusus untuk print */
            table {
                border-collapse: collapse !important;
                width: 100vh !important;
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
                size: 330mm 210mm; /* Ukuran kertas A4 */
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

    <div class="w-[100%] space-y-3">
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

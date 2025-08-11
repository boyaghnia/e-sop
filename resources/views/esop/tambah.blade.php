<x-layout>
    <div class="mb-5 w-full rounded-lg bg-blue-500 text-white">
        <div class="container mx-auto flex items-center justify-between px-6 py-4">
            <div class="flex items-center">
                <svg viewBox="0 0 40 40" class="h-6 w-6 fill-current">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"
                    ></path>
                </svg>

                <p class="mx-7 my-auto">
                    <span class="font-bold">Harap isi E-SOP dengan bertahap !</span>
                    <br />
                    <span class="text-xs">
                        Silahkan input isian pada sebelah kiri, lalu akan muncul preview disebelah kanan, lalu klik
                        simpan.
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="flex space-x-3">
        <div class="w-[35%] rounded-sm bg-white p-4 shadow-sm">
            <form id="esopForm" action="{{ route('esop.simpan') }}" method="POST">
                @csrf
                <div class="px-2">
                    <div class="space-y-12">
                        <div class="pb-2">
                            <div class="mt-2 grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-6">
                                <div class="sm:col-span-6">
                                    <label for="isian" class="block text-sm/6 font-medium text-gray-900">Isian</label>
                                    <div class="mt-1 grid grid-cols-1">
                                        <div class="relative mt-1">
                                            <select
                                                id="isian_select"
                                                name="isian"
                                                class="form-control col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-12 pl-3 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 focus:outline focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                            >
                                                <option value="Srikandi">Srikandi</option>
                                                <option value="Manual">Manual</option>
                                            </select>
                                            <span
                                                class="pointer-events-none absolute inset-y-0 right-3 flex items-center"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="h-4 w-4"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m19.5 8.25-7.5 7.5-7.5-7.5"
                                                    />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>

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
                                            ></textarea>
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
                                            ></textarea>
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
                                            ></textarea>
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
                                            ></textarea>
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
                                            ></textarea>
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
                                                id="ditetapkan_oleh"
                                                name="ditetapkan_oleh"
                                                rows="3"
                                                class="form-control block field-sizing-content w-full resize-none overflow-hidden rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6"
                                                oninput="updateEsopPreview(); this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                            ></textarea>
                                        </div>

                                        <script>
                                            function applyIsianMode(value) {
                                                const noSopField = document.getElementById('no_sop');
                                                const tglDitetapkanField = document.getElementById('tgl_ditetapkan');
                                                const tglDiberlakukanField =
                                                    document.getElementById('tgl_diberlakukan');
                                                const ditetapkanOlehTextarea =
                                                    document.getElementById('ditetapkan_oleh');

                                                if (value === 'Srikandi') {
                                                    // Isi literal placeholder (bukan variabel server)
                                                    noSopField.value = '${nomor_naskah}';
                                                    tglDitetapkanField.value = '${tanggal_naskah}';
                                                    tglDiberlakukanField.value = '${tanggal_naskah}';
                                                    ditetapkanOlehTextarea.value =
                                                        '${jabatan_pengirim}\n\n\n${ttd_pengirim}\n\n\n${nama_pengirim}\n${nip_pengirim}';

                                                    noSopField.readOnly = true;
                                                    tglDitetapkanField.readOnly = true;
                                                    tglDiberlakukanField.readOnly = true;
                                                    ditetapkanOlehTextarea.readOnly = true;
                                                } else {
                                                    // Mode manual
                                                    noSopField.readOnly = false;
                                                    tglDitetapkanField.readOnly = false;
                                                    tglDiberlakukanField.readOnly = false;
                                                    ditetapkanOlehTextarea.readOnly = false;

                                                    noSopField.value = '';
                                                    tglDitetapkanField.value = '';
                                                    tglDiberlakukanField.value = '';
                                                    ditetapkanOlehTextarea.value = '';
                                                }

                                                // Update preview setiap perubahan
                                                updateEsopPreview();
                                            }

                                            // Event handler untuk select
                                            document
                                                .getElementById('isian_select')
                                                .addEventListener('change', function () {
                                                    applyIsianMode(this.value);
                                                });

                                            // Set default ke Srikandi saat halaman pertama kali dimuat
                                            document.addEventListener('DOMContentLoaded', function () {
                                                const select = document.getElementById('isian_select');
                                                select.value = 'Srikandi';
                                                applyIsianMode('Srikandi');
                                            });
                                        </script>
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
                                            ></textarea>
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
                                            ></textarea>
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
                                            ></textarea>
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
                                            ></textarea>
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
                                            ></textarea>
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
                                            ></textarea>
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
                <table class="w-full table-fixed border border-black text-sm">
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
                            <td colspan="3" class="border p-2">
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

                        {{-- Judul Dasar Hukum - Kualifikasi Pelaksana --}}
                        <tr>
                            <td colspan="5" class="border p-2 font-bold">Dasar Hukum :</td>
                            <td colspan="5" class="border p-2 font-bold">Cara Mengatasi :</td>
                        </tr>

                        {{-- Input Dasar Hukum - Kualifikasi Pelaksana --}}
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

                // Auto-prefix "SOP " untuk textarea judul_sop (hindari duplikasi)
                let currentValue = textarea.value;
                if (inputId === 'judul_sop') {
                    if (currentValue.trim() !== '' && !/^\s*SOP\b/i.test(currentValue)) {
                        currentValue = 'SOP\n' + currentValue.trimStart();
                        textarea.value = currentValue;
                    }
                }

                // Pecah isi textarea menjadi array baris (termasuk baris kosong)
                const rawLines = (inputId === 'judul_sop' ? currentValue : textarea.value).split('\n');

                // Tangani khusus field 'ditetapkan_oleh' agar Enter menambah baris kosong
                if (inputId === 'ditetapkan_oleh') {
                    const html = rawLines
                        .map((line) => {
                            const trimmed = line.trim();
                            if (trimmed === '${ttd_pengirim}') {
                                return `<p class="mb-1" style="margin-left:2rem;">${trimmed}</p>`;
                            }
                            return trimmed === '' ? '<p class="mb-1">&nbsp;</p>' : `<p class="mb-1">${trimmed}</p>`;
                        })
                        .join('');
                    preview.innerHTML = html || '<em class="text-gray-400">Tidak ada isian</em>';
                    return;
                }

                // Untuk field lain, hilangkan baris kosong dan trim
                const lines = rawLines.map((line) => line.trim()).filter((line) => line !== '');

                // ➤ Tampilkan sebagai paragraf biasa
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
                    // ➤ Field lainnya pakai daftar bernomor
                    const listItems = lines.map((line) => {
                        const clean = line.replace(/^\d+\\.\\s*/, '');
                        return `<li>${clean}</li>`;
                    });
                    preview.innerHTML = listItems.length
                        ? `<ol class="list-decimal pl-4">${listItems.join('')}</ol>`
                        : '<em class="text-gray-400">Tidak ada isian</em>';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', updateEsopPreview);
    </script>
</x-layout>

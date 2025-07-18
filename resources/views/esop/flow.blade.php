@php
    $jumlahPelaksana = $esop->pelaksanas->count();
@endphp

<x-layout>
    <canvas id="flow-canvas" class="pointer-events-none absolute top-0 left-0 z-0 h-full w-full"></canvas>
    <style>
        #flow-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }
    </style>
    <form id="esopForm" action="{{ route('flow.update', $esop->id) }}" method="POST">
        @csrf
        <div class="rounded-sm bg-white p-4 shadow-sm">
            <a href="{{ route('esop.edit', ['id' => $esop->id]) }}">
                <button
                    type="button"
                    class="mb-3 cursor-pointer rounded-sm bg-gray-500 px-3 py-2 text-sm font-semibold text-white hover:bg-gray-400"
                >
                    Kembali
                </button>
            </a>

            <div class="overflow-auto">
                <table class="min-w-full border border-gray-400 text-left text-sm text-gray-800">
                    <thead>
                        <tr class="bg-gray-100 text-center font-semibold">
                            <th rowspan="2" class="border border-gray-400 px-2 py-1 align-middle">No</th>
                            <th rowspan="2" class="border border-gray-400 px-2 py-1 align-middle">Uraian Kegiatan</th>
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

                            <tr class="{{ $i % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="align-center border border-gray-400 px-2 py-1 text-center">{{ $i }}</td>
                                <td class="border border-gray-400 px-2 py-1">
                                    <textarea
                                        name="uraian_kegiatan_{{ $i }}"
                                        placeholder="Uraian Kegiatan {{ $i }}"
                                        class="w-full resize-none content-center overflow-visible border-none outline-none"
                                        rows="3"
                                        oninput="this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                    >
{{ $flow->uraian_kegiatan ?? '' }}</textarea
                                    >
                                </td>

                                @foreach ($esop->pelaksanas as $pelaksana)
                                    <td
                                        class="flow-cell border border-gray-400 px-2 py-1"
                                        data-flow="{{ $flow->id ?? '' }}"
                                        data-pelaksana="{{ $pelaksana->id }}"
                                    >
                                        <select
                                            onchange="updateSymbol(this)"
                                            class="w-full rounded border text-xs"
                                            id="symbol-{{ $i }}-{{ $pelaksana->id }}"
                                        >
                                            <option value="">Pilih</option>
                                            <option value="start">Mulai</option>
                                            <option value="process">Proses</option>
                                            <option value="decision">Pengambilan Keputusan</option>
                                        </select>
                                        <div
                                            class="symbol-preview mt-1"
                                            id="preview-{{ $i }}-{{ $pelaksana->id }}"
                                        ></div>
                                    </td>
                                @endforeach

                                <td class="align-center border border-gray-400 px-2 py-1">
                                    <textarea
                                        name="kelengkapan_{{ $i }}"
                                        placeholder="Kelengkapan {{ $i }}"
                                        class="w-full resize-none content-center overflow-visible border-none text-center outline-none"
                                        rows="3"
                                        oninput="this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                    >
{{ $flow->kelengkapan ?? '' }}</textarea
                                    >
                                </td>

                                <td class="align-center border border-gray-400 px-2 py-1">
                                    <textarea
                                        name="waktu_{{ $i }}"
                                        placeholder="Waktu {{ $i }}"
                                        class="w-full resize-none content-center overflow-visible border-none text-center outline-none"
                                        rows="3"
                                        oninput="this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                    >
{{ $flow->waktu ?? '' }}</textarea
                                    >
                                </td>

                                <td class="align-center border border-gray-400 px-2 py-1">
                                    <textarea
                                        name="output_{{ $i }}"
                                        placeholder="Output {{ $i }}"
                                        class="w-full resize-none content-center overflow-visible border-none text-center outline-none"
                                        rows="3"
                                        oninput="this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
                                    >
{{ $flow->output ?? '' }}</textarea
                                    >
                                </td>

                                <td class="align-center border border-gray-400 px-2 py-1">
                                    <textarea
                                        name="keterangan_{{ $i }}"
                                        placeholder="Keterangan {{ $i }}"
                                        class="w-full resize-none content-center overflow-visible border-none text-center outline-none"
                                        rows="3"
                                        oninput="this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
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
                        class="inline-flex items-center gap-1 rounded-md border border-blue-500 px-3 py-2 text-sm font-medium text-blue-500 hover:bg-indigo-50"
                    >
                        - Hapus Baris
                    </button>
                    <button
                        type="button"
                        onclick="addRow()"
                        class="inline-flex items-center gap-1 rounded-md border border-blue-500 px-3 py-2 text-sm font-medium text-blue-500 hover:bg-indigo-50"
                    >
                        + Tambah Baris
                    </button>
                </div>

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
    </form>

    <script>
        let rowCount = {{ $flows->keys()->max() ?? 0 }};
        const jumlahPelaksana = {{ $esop->pelaksanas->count() }};

        function addRow() {
            rowCount++;
            const tbody = document.getElementById('tbody-flow');

            const row = document.createElement('tr');
            row.className = rowCount % 2 === 0 ? 'bg-gray-50' : 'bg-white';

            let html = `
        <td class="border border-gray-400 px-2 py-1 text-center align-center">${rowCount}</td>
        <td class="border border-gray-400 px-2 py-1">
            <textarea
                name="uraian_kegiatan_${rowCount}"
                placeholder="Uraian Kegiatan ${rowCount}"
                class="w-full content-center resize-none overflow-visible border-none outline-none"
                rows="3"
                oninput="this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
            ></textarea>
        </td>
    `;

            for (let i = 0; i < jumlahPelaksana; i++) {
                html += `<td class="border border-gray-400 px-2 py-1"></td>`;
            }

            html += `
        <td class="border border-gray-400 px-2 py-1 align-center">
            <textarea
                name="kelengkapan_${rowCount}"
                placeholder="Kelengkapan ${rowCount}"
                class="w-full resize-none content-center text-center overflow-visible border-none outline-none"
                rows="3"
                oninput="this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
            ></textarea>
        </td>
        <td class="border border-gray-400 px-2 py-1 align-center">
            <textarea
                name="waktu_${rowCount}"
                placeholder="Waktu ${rowCount}"
                class="w-full resize-none content-center text-center overflow-visible border-none outline-none"
                rows="3"
                oninput="this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
            ></textarea>
        </td>
        <td class="border border-gray-400 px-2 py-1 align-center">
            <textarea
                name="output_${rowCount}"
                placeholder="Output ${rowCount}"
                class="w-full resize-none content-center text-center overflow-visible border-none outline-none"
                rows="3"
                oninput="this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
            ></textarea>
        </td>
        <td class="border border-gray-400 px-2 py-1 align-center">
            <textarea
                name="keterangan_${rowCount}"
                placeholder="Keterangan ${rowCount}"
                class="w-full resize-none content-center text-center overflow-visible border-none outline-none"
                rows="3"
                oninput="this.style.height='auto'; this.style.height=(this.scrollHeight)+'px';"
            ></textarea>
        </td>
    `;

            row.innerHTML = html;
            tbody.appendChild(row);
        }

        function removeRow() {
            const tbody = document.getElementById('tbody-flow');
            if (tbody.lastElementChild) {
                tbody.removeChild(tbody.lastElementChild);
                rowCount--;
            }
        }
    </script>

    <script>
        function updateSymbol(selectElement) {
            const container = selectElement.nextElementSibling;
            const value = selectElement.value;

            let html = '';
            if (value === 'start') {
                html = '<div class="w-6 h-6 bg-blue-500 rounded-md mx-auto"></div>';
            } else if (value === 'process') {
                html = '<div class="w-6 h-6 bg-green-500 mx-auto"></div>';
            } else if (value === 'decision') {
                html = '<div class="w-6 h-6 bg-yellow-400 rotate-45 mx-auto"></div>';
            }

            container.innerHTML = html;
            drawConnections();
        }
    </script>
    <script>
        function getSymbolCenters() {
            const symbols = document.querySelectorAll('.symbol-preview > div');
            const centers = [];

            symbols.forEach((el) => {
                const rect = el.getBoundingClientRect();
                centers.push({
                    element: el,
                    x: rect.left + rect.width / 2 + window.scrollX,
                    y: rect.top + rect.height / 2 + window.scrollY,
                });
            });

            return centers;
        }

        function drawConnections() {
            const canvas = document.getElementById('flow-canvas');
            const ctx = canvas.getContext('2d');

            canvas.width = document.body.scrollWidth;
            canvas.height = document.body.scrollHeight;

            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.strokeStyle = '#000';
            ctx.lineWidth = 1.5;

            const centers = getSymbolCenters();
            const padding = 12;

            for (let i = 0; i < centers.length - 1; i++) {
                const from = centers[i];
                const to = centers[i + 1];

                let startX = from.x;
                let startY = from.y;

                let endX = to.x;
                let endY = to.y;

                const isSameRow = Math.abs(endY - startY) < 20;

                if (isSameRow) {
                    startY = from.y; // tetap
                    endY = to.y;
                } else if (endY > startY) {
                    startY = from.y + padding;
                    endY = to.y - padding;
                }

                const midY = (startY + endY) / 2;

                ctx.beginPath();
                ctx.moveTo(startX, startY);

                if (Math.abs(endY - startY) < 20) {
                    // Jika dalam satu baris (jarak vertikal kecil), langsung horizontal
                    ctx.lineTo(endX, startY);
                    ctx.stroke();
                    drawArrow(ctx, endX - 1, startY, endX, startY); // panah horizontal
                } else if (endY > startY) {
                    // Target di bawah → jalur siku: turun → kanan/kiri → turun
                    const midY = (startY + endY) / 2;
                    ctx.lineTo(startX, midY);
                    ctx.lineTo(endX, midY);
                    ctx.lineTo(endX, endY);
                    ctx.stroke();
                    drawArrow(ctx, endX, midY, endX, endY); // panah vertikal ke bawah
                } else {
                    // Target di atas (harus dihindari): buat garis horizontal saja
                    ctx.lineTo(endX, startY);
                    ctx.stroke();
                    drawArrow(ctx, endX - 1, startY, endX, startY); // panah horizontal
                }
            }
        }

        function drawArrow(ctx, fromX, fromY, toX, toY) {
            const headlen = 8;
            const dx = toX - fromX;
            const dy = toY - fromY;
            const angle = Math.atan2(dy, dx);

            ctx.beginPath();
            ctx.moveTo(toX, toY);
            ctx.lineTo(toX - headlen * Math.cos(angle - Math.PI / 6), toY - headlen * Math.sin(angle - Math.PI / 6));
            ctx.moveTo(toX, toY);
            ctx.lineTo(toX - headlen * Math.cos(angle + Math.PI / 6), toY - headlen * Math.sin(angle + Math.PI / 6));
            ctx.stroke();
        }

        const observer = new MutationObserver(drawConnections);
        observer.observe(document.getElementById('tbody-flow'), { childList: true, subtree: true });

        window.addEventListener('load', drawConnections);
        window.addEventListener('resize', drawConnections);
    </script>
</x-layout>

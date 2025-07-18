import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('esopForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Mencegah form langsung submit

        Swal.fire({
            title: 'Berhasil!',
            text: 'SOP berhasil disimpan.',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500, // ⏳ Alert otomatis hilang dalam 1.5 detik
        });

        setTimeout(() => {
            event.target.submit(); // Kirim form setelah alert selesai
        }, 1500);
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete-esop');

    deleteButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const form = btn.closest('form');
            const namaSOP = form.getAttribute('data-nama');

            Swal.fire({
                title: 'Hapus SOP?',
                text: `Yakin ingin menghapus SOP "${namaSOP}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('textarea').forEach((el) => {
        el.style.height = 'auto';
        el.style.height = el.scrollHeight + 'px';
    });
});

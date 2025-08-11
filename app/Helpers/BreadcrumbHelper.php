<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\Esop;

class BreadcrumbHelper
{
    public static function generate()
    {
        $user = Auth::user();
        $homeUrl = url('/');
        $segments = request()->segments();

        $breadcrumb = [[
            'title' => '<svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1-1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>',
            'url' => $homeUrl,
            'active' => count($segments) === 0, // Home aktif jika tidak ada segment
            'clickable' => count($segments) > 0 // Home bisa diklik jika tidak sedang di home
        ]];

        $url = '';

        // Custom titles untuk beberapa segment
        $customTitles = [
            'dashboard' => 'Dashboard',
            'esop' => 'E-SOP',
            'tambah' => 'Tambah',
            'edit' => 'Edit',
            'flow' => 'Flow',
            'print' => 'Print',
            'folder' => 'Folder',
            'faq' => 'FAQ',
            'panduan' => 'Panduan'
        ];

        foreach ($segments as $index => $segment) {
            $url .= '/' . $segment;
            $isLast = $index === count($segments) - 1;
            
            // Cek apakah segment adalah ID untuk halaman ESOP
            if (is_numeric($segment) && $index > 0 && in_array($segments[$index - 1], ['edit', 'flow', 'print'])) {
                // Ambil nama ESOP dari database
                try {
                    $esop = Esop::find($segment);
                    $title = $esop ? $esop->nama_sop : "ESOP #{$segment}";
                } catch (\Exception $e) {
                    $title = "ESOP #{$segment}";
                }
                
                // ID ESOP tidak bisa diklik
                $canClick = false;
            } else {
                // Gunakan custom title jika ada, jika tidak pakai format ucfirst
                $title = $customTitles[$segment] ?? ucfirst(str_replace('-', ' ', $segment));
                
                // Tentukan apakah segment ini bisa diklik
                $canClick = self::canNavigateToSegment($segments, $index);
            }

            $breadcrumb[] = [
                'title' => $title,
                'url' => ($canClick && !$isLast) ? url($url) : null,
                'active' => $isLast,
                'clickable' => $canClick && !$isLast
            ];
        }

        return $breadcrumb;
    }

    /**
     * Menentukan apakah segment tertentu dapat dinavigasi (memiliki halaman yang valid)
     */
    private static function canNavigateToSegment($segments, $currentIndex)
    {
        // Jika hanya satu segment, cek apakah itu halaman yang valid
        if ($currentIndex === 0) {
            $validRootPages = ['dashboard', 'esop', 'faq', 'panduan'];
            return in_array($segments[0], $validRootPages);
        }

        // Untuk segment yang lebih dalam, kita perlu memvalidasi path
        $pathSegments = array_slice($segments, 0, $currentIndex + 1);
        
        // Validasi path berdasarkan struktur yang ada
        if (count($pathSegments) === 1) {
            // Root pages
            $validRootPages = ['dashboard', 'esop', 'faq', 'panduan'];
            return in_array($pathSegments[0], $validRootPages);
        }
        
        if (count($pathSegments) === 2) {
            // Second level pages
            if ($pathSegments[0] === 'esop') {
                $validEsopPages = ['tambah', 'folder'];
                return in_array($pathSegments[1], $validEsopPages);
            }
        }
        
        // Untuk path yang lebih dalam atau yang mengandung edit/flow/print dengan ID
        // tidak bisa diklik karena memerlukan ID yang spesifik
        if (in_array('edit', $pathSegments) || in_array('flow', $pathSegments) || in_array('print', $pathSegments)) {
            return false;
        }
        
        return false;
    }
}
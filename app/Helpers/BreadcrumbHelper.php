<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class BreadcrumbHelper
{
    public static function generate()
    {
        $user = Auth::user();
        $homeUrl = url('/'); // Default untuk non-admin

        // if ($user && $user->role === 'admin') {
        //     $homeUrl = route('dashboard.tampil'); // Admin ke Dashboard
        // }

        // **Custom Mapping Nama Halaman**
        // $customTitles = [
        //     'rpkp' => 'RPKP',
        //     'stb' => 'STB',
        //     'perjanjian' => 'Perjanjian Belajar',
        //     'verval' => 'VERVAL',
        //     'faq' => 'FAQ',
        // ];

        $breadcrumb = [[
            'title' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1-1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>',
            'url' => $homeUrl
        ]];

        $segments = request()->segments();
        $url = '';

        foreach ($segments as $segment) {
            $url .= '/' . $segment;
            
            // Gunakan custom title jika ada, jika tidak pakai format ucfirst
            $title = $customTitles[$segment] ?? ucfirst(str_replace('-', ' ', $segment));

            $breadcrumb[] = [
                'title' => $title,
                'url' => url($url),
            ];
        }

        return $breadcrumb;
    }
}
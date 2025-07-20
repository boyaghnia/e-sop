<div class="sidebar no-print">
    <aside
        class="fixed flex h-screen w-64 flex-col justify-between overflow-y-auto border-r bg-white px-5 py-8 rtl:border-r-0 rtl:border-l dark:border-gray-700 dark:bg-gray-900"
    >
        <div>
            {{-- Logo & Navigation --}}
            <a class="flex items-center align-middle" href="#">
                <img class="-ml-3 h-12 w-auto" src="{{ asset('img/logo-kemenhub.png') }}" alt="" />
                <div class="mb-1 flex flex-col">
                    <h1 class="text-xl font-medium text-white">E-SOP</h1>
                    <p class="text-xs text-white">Direktorat Jenderal Perhubungan Udara</p>
                </div>
            </a>

            <hr class="mt-3 border-gray-700" />
        </div>

        <div class="mt-4 flex flex-1 flex-col justify-between">
            <nav class="-mx-3 space-y-6">
                <div class="space-y-3">
                    {{-- <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">analytics</label> --}}

                    <a
                        class="flex transform items-center rounded-lg px-3 py-2 text-gray-600 transition-colors duration-300 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="{{ url('/dashboard') }}"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                            />
                        </svg>

                        <span class="mx-2 text-sm font-medium">Dashboard</span>
                    </a>

                    <div x-data="{ open: false }" class="space-y-1">
                        <button
                            @click="open = !open"
                            class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-gray-600 transition-colors duration-300 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        >
                            <div class="flex items-center space-x-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
                                    />
                                </svg>
                                <span class="text-sm font-medium">Sekretariat</span>
                            </div>
                            <svg
                                :class="{'transform rotate-180': open}"
                                class="h-4 w-4 transition-transform"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </button>

                        <div x-show="open" x-transition class="space-y-1 pl-6">
                            <a
                                href="/sekretariat/perencanaan"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Perencanaan
                            </a>
                            <a
                                href="/sekretariat/keuangan"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Keuangan
                            </a>
                            <a
                                href="/sekretariat/sdm"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Sumber Daya Manusia
                            </a>
                            <a
                                href="/sekretariat/ortala"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Organisasi & Tata Laksana
                            </a>
                            <a
                                href="/sekretariat/hukum"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Hukum & Kerjasama
                            </a>
                            <a
                                href="/sekretariat/humas"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Hubungan Masyarakat & Umum
                            </a>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="space-y-1">
                        <button
                            @click="open = !open"
                            class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-gray-600 transition-colors duration-300 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        >
                            <div class="flex items-center space-x-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
                                    />
                                </svg>
                                <span class="text-sm font-medium">Direktorat</span>
                            </div>
                            <svg
                                :class="{'transform rotate-180': open}"
                                class="h-4 w-4 transition-transform"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </button>

                        <div x-show="open" x-transition class="space-y-1 pl-6">
                            <a
                                href="/direktorat/angkutan"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Angkutan Udara
                            </a>
                            <a
                                href="/direktorat/bandarudara"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Bandar Udara
                            </a>
                            <a
                                href="/direktorat/kampen"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Keamanan Penerbangan
                            </a>
                            <a
                                href="/direktorat/navpen"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Navigasi Penerbangan
                            </a>
                            <a
                                href="/direktorat/dkppu"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                DKPPU
                            </a>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="space-y-1">
                        <button
                            @click="open = !open"
                            class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-gray-600 transition-colors duration-300 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        >
                            <div class="flex items-center space-x-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
                                    />
                                </svg>
                                <span class="text-sm font-medium">Balai</span>
                            </div>
                            <svg
                                :class="{'transform rotate-180': open}"
                                class="h-4 w-4 transition-transform"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </button>

                        <div x-show="open" x-transition class="space-y-1 pl-6">
                            <a
                                href="/balai/kespen"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Kesehatan Penerbangan
                            </a>
                            <a
                                href="/balai/kalibrasi"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Kalibrasi Fasilitas Penerbangan
                            </a>
                            <a
                                href="/bagian/tekpen"
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            >
                                Teknik Penerbangan
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        {{-- Logout di bawah --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <div class="-mx-3 mt-5">
                <button
                    class="flex w-full transform items-center rounded-lg px-3 py-2 text-gray-200 transition-colors duration-300 hover:bg-red-600"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"
                        />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Log Out</span>
                </button>
            </div>
        </form>
    </aside>
</div>

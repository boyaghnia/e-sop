<aside
    id="sidebar"
    class="fixed z-30 flex h-screen w-64 flex-col justify-between overflow-y-auto border-r bg-white px-5 py-5 rtl:border-r-0 rtl:border-l dark:border-gray-700 dark:bg-gray-900"
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

        <div class="mt-3 flex flex-col items-start text-white">
            <p class="text-xs font-semibold">{{ Auth::user()->name }}</p>
        </div>

        <hr class="mt-3 border-gray-700" />
    </div>

    <div class="mt-4 flex flex-1 flex-col justify-between">
        <nav class="-mx-3 space-y-6">
            <div class="space-y-3">
                <span class="px-3 text-xs text-gray-400 uppercase">Admin Dashboard</span>

                <x-nav-link href="/dashboard" :active="request()->is('dashboard')">
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
                </x-nav-link>
            </div>

            <div class="space-y-3">
                <span class="px-3 text-xs text-gray-400 uppercase">E - SOP</span>

                <x-nav-link href="/esop" :active="request()->is('esop')">
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
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                        />
                    </svg>

                    <span class="mx-2 text-sm font-medium">Data SOP</span>
                </x-nav-link>

                <x-nav-link href="/esop/tambah" :active="request()->is('esop/tambah') || request()->is('esop/edit/*')">
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
                            d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
                        />
                    </svg>

                    <span class="mx-2 text-sm font-medium">Tambah SOP</span>
                </x-nav-link>

                <x-nav-link
                    href="/esop/folder"
                    :active="request()->is('esop/folder') || request()->is('esop/folder/*')"
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
                            d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
                        />
                    </svg>

                    <span class="mx-2 text-sm font-medium">Folder</span>
                </x-nav-link>
            </div>

            <div class="space-y-3">
                <span class="px-3 text-xs text-gray-400 uppercase">BANTUAN & PANDUAN</span>

                <x-nav-link href="/faq" :active="request()->is('faq')">
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
                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"
                        />
                    </svg>

                    <span class="mx-2 text-sm font-medium">FAQ</span>
                </x-nav-link>

                <x-nav-link href="/panduan" :active="request()->is('panduan')">
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
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"
                        />
                    </svg>

                    <span class="mx-2 text-sm font-medium">Panduan</span>
                </x-nav-link>
            </div>
        </nav>
    </div>

    {{-- Logout di bawah --}}
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <div class="-mx-3 mt-5">
            <button
                class="flex w-full transform cursor-pointer items-center rounded-lg px-3 py-2 text-gray-200 transition-colors duration-300 hover:bg-red-600"
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

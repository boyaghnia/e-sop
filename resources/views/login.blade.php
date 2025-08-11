<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        @vite('resources/css/app.css')
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <title>E-SOP | DJPU</title>
    </head>
    <body>
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="mx-auto flex flex-col items-center justify-center px-6 py-8 md:h-screen lg:py-0">
                <a href="#" class="mb-6 flex items-center text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="-ml-3 h-12 w-auto" src="{{ asset('img/logo-kemenhub.png') }}" alt="" />
                    <div class="ml-3 flex flex-col">
                        <p>E-SOP</p>
                        <p class="text-sm font-normal">Direktorat Jenderal Perhubungan Udara</p>
                    </div>
                </a>
                <div
                    class="w-full rounded-lg bg-white shadow sm:max-w-md md:mt-0 xl:p-0 dark:border dark:border-gray-700 dark:bg-gray-800"
                >
                    <div class="space-y-4 p-6 sm:p-8 md:space-y-6">
                        {{--
                            <h1
                            class="text-xl leading-tight font-bold tracking-tight text-gray-900 md:text-2xl dark:text-white"
                            >
                            Sign in to your account
                            </h1>
                        --}}
                        <form
                            action="{{ route('login.submit') }}"
                            method="POST"
                            class="space-y-4 md:space-y-6"
                            action="#"
                        >
                            @csrf
                            <div>
                                <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    ID Unit Kerja
                                </label>
                                <input
                                    text="id_uker"
                                    name="id_uker"
                                    id="id_uker"
                                    class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                    placeholder="Organisasi & Tata Laksana"
                                    required=""
                                />
                            </div>
                            <div>
                                <label
                                    for="password"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    Password
                                </label>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    placeholder="••••••••"
                                    class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                    required=""
                                />
                            </div>
                            <button
                                type="submit"
                                class="hover:bg-primary-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mt-6 w-full rounded-lg bg-blue-600 px-5 py-2.5 text-center text-sm font-medium text-white focus:ring-4 focus:outline-none"
                            >
                                Sign in
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>

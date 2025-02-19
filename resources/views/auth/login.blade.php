<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>
    @vite(['resources/js/css/app.css', 'resources/js/app.js'])
</head>
    <body class="bg-gray-900 min-h-screen flex flex-col gap-4 items-center justify-center p-4">
        <div class="w-1/2 aspect-square max-w-md bg-gray-700 rounded-lg shadow-lg p-8 border dark:bg-gray-800 dark:border-gray-700">
            <h1 class="text-2xl font-bold text-white text-center mb-8">Login</h1>
    
            <form class="space-y-6" action="{{ route('authenticate') }}" method="POST">
                @csrf
                <!-- Email Input -->
                <div class="space-y-2 mb-4">
                    <label for="email" class="text-sm font-medium text-gray-200 block">
                        Email
                    </label>
                    <input type="text" id="email" name="email"
                    class="bg-slate-900 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-4 py-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="nama@email.com">
                        @error('email')
                            <p style="color: red;">{{ $message }}</p>
                        @enderror
                </div>
    
                <!-- Password Input -->
                <div class="space-y-2">
                    <label for="password" class="text-sm font-medium text-gray-200 block">
                        Password
                    </label>
                    <input type="password" id="password" name="password"
                    class="bg-slate-900 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-4 py-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Masukkan password">
                        @error('password')
                            <p style="color: red;">{{ $message }}</p>
                        @enderror
                </div>
    
                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200">
                    Login
                </button>
            </form>
            <p class="text-sm mt-3 font-light text-gray-500 dark:text-gray-400">Belum punya akun? <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Buat akun disini</a></p>
        </div>
    
        @if (session()->has('message'))
        <div id="toast-warning" class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-700" role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                </svg>
                <span class="sr-only">Warning icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('message') }}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
        @endif
    
    </body>
</html>
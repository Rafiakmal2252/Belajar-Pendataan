@extends('layouts.main')

@section('content')
<div class="pr-8 sm:ml-56">
    
    <div class="text-white min-h-screen flex flex-col items-center justify-center">
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-md w-full text-center">
            <h1 class="text-2xl font-bold">Selamat Datang, <span class="text-blue-400">{{ Auth::user()->name }}</span>!</h1>
            <p class="mt-4 text-gray-300">Ini adalah halaman dashboard utama Anda. Selamat beraktivitas!</p>
        </div>
    </div>
</div>
@endsection

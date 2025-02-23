@extends('layouts.main')

@section('content')
    <div class="pr-8 pt-20 sm:ml-56">

        <div class="flex mb-14" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('discussion.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Diskusi
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('discussion.create') }}"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Halaman Buat</a>
                    </div>
                </li>
            </ol>
        </div>

        <div class="max-w-2xl mx-auto mt-10 p-6 bg-gray-800 text-white rounded-lg shadow-md border border-gray-700">
            <h2 class="text-2xl font-bold mb-4">Buat Diskusi</h2>
        
            <!-- Form -->
            <form action="{{ route('discussion.store') }}" method="POST">
                @csrf
        
                <!-- Input Judul -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-300 text-sm font-medium mb-1">Judul</label>
                    <input type="text" id="title" name="title" 
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan judul diskusi" required>
                </div>
        
                <!-- Input Konten -->
                <div class="mb-4">
                    <label for="content" class="block text-gray-300 text-sm font-medium mb-1">Konten</label>
                    <textarea id="content" name="content" rows="5"
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Tulis isi diskusi..." required></textarea>
                </div>
        
                <!-- Tombol Kirim -->
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                    Kirim
                </button>
            </form>
        </div>
    </div>
    @endsection
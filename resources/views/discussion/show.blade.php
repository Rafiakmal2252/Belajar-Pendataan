@extends('layouts.main')

@section('content')
    <div class="sm:ml-56 sm:mr-7 pt-20 mx-auto">

        <div class="flex mb-10" aria-label="Breadcrumb">
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
                        <a 
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Halaman Balas</a>
                    </div>
                </li>
            </ol>
        </div>

        <!-- Diskusi -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
            <h1 class="text-2xl font-bold text-white">{{ $discussion->title }}</h1>
            <p class="text-gray-300 mt-2">{{ $discussion->content }}</p>
            <small class="text-gray-500 flex items-center gap-2 mt-2">
                <span class="material-symbols-outlined text-gray-500">person</span>
                Oleh: {{ $discussion->user->name }} | {{ $discussion->created_at->diffForHumans() }}
            </small>
        </div>

        <!-- Balasan -->
        <h2 class="text-xl font-bold text-white mt-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-blue-400">chat</span>
            Balasan
        </h2>

        <div class="mt-4 space-y-4">
            @foreach ($discussion->replies as $reply)
                <div class="bg-gray-900 p-4 rounded-lg shadow-md border border-gray-700">
                    <p class="text-gray-300">{{ $reply->content }}</p>
                    <small class="text-gray-500 flex items-center gap-2 mt-2">
                        <span class="material-symbols-outlined text-gray-500">person</span>
                        Oleh: {{ $reply->user->name }} | {{ $reply->created_at->diffForHumans() }}
                    </small>
                </div>
            @endforeach
        </div>

        <!-- Form Tambah Balasan -->
        <h2 class="text-xl font-bold text-white mt-6">Tambah Balasan</h2>
        <form action="{{ route('discussion.reply', $discussion->id) }}" method="POST" class="mt-4">
            @csrf
            <textarea name="content" rows="4"
                class="w-full bg-gray-700 text-white p-3 rounded-lg focus:ring focus:ring-blue-500" placeholder="Tulis balasan..."></textarea>

            <button type="submit"
                class="mt-3 mb-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition flex items-center gap-2">
                <span class="material-symbols-outlined">send</span>
                Kirim Balasan
            </button>
        </form>
    </div>
@endsection

@extends('layouts.main')

@section('content')
    <div class="p-6 pt-20 sm:ml-56">

        <div class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('member.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Diskusi
                    </a>
                </li>
            </ol>
        </div>

        <!-- Judul Halaman -->
        <h1 class="text-3xl font-bold text-white mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-blue-400">forum</span>
            Diskusi
        </h1>

        <!-- Tombol Buat Diskusi -->
        @if (auth()->user()->role == 'ADMIN')
            <a href="{{ route('discussion.create') }}"
                class="bg-blue-600 hover:bg-blue-700 w-40 text-white px-4 py-2 rounded-lg font-semibold transition flex items-center gap-2">
                <span class="material-symbols-outlined">add_circle</span>
                Buat Diskusi
            </a>
        @endif

        <!-- List Diskusi -->
        <div class="mt-6 space-y-4">
            @foreach ($discussions as $discussion)
                <div class="bg-gray-800 p-4 rounded-lg shadow-md border border-gray-700 mb-4 relative">
                    <!-- Tanggal Posting di Kanan Atas -->
                    <small class="absolute top-2 right-4 text-gray-400 text-sm">
                        {{ $discussion->created_at->diffForHumans() }}
                    </small>

                    <!-- Judul Diskusi -->
                    <h2 class="text-xl font-bold text-white mb-2">{{ $discussion->title }}</h2>

                    <!-- Konten Diskusi Singkat -->
                    <p class="text-gray-300">{{ Str::limit($discussion->content, 100) }}</p>

                    <!-- Footer Card: Ikon Komentar di Kiri Bawah -->
                    <div class="flex justify-between items-center mt-4">
                        <!-- Ikon Komentar -->
                        <a href="{{ route('discussion.show', $discussion->id) }}"
                            class="flex items-center text-blue-400 hover:text-blue-500 transition">
                            <span class="material-symbols-outlined text-xl">chat_bubble</span>
                            <span class="ml-1 text-sm">Komentar</span>
                        </a>

                        <!-- Info Pembuat Diskusi -->
                        {{-- <div class="flex items-center text-gray-500 text-sm">
                            <span class="material-symbols-outlined text-sm mr-1">person</span>
                            <span>{{ $discussion->user->name }}</span>
                        </div> --}}
                        @if (auth()->user()->role == 'ADMIN')
                        <form action="{{ route('discussion.destroy', $discussion->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus diskusi ini?')">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('discussion.edit', $discussion->id) }}"
                                class="text-white hover:text-yellow-500 transition">
                                ✏️ Edit
                            </a>
                            <button type="submit" class="text-red-400 ml-3 hover:text-red-500 transition">🗑️ Hapus</button>
                        </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $discussions->links() }}
        </div>
    </div>
@endsection

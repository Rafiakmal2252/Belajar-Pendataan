@extends('layouts.main')

@section('content')
    <div class="pr-8 pt-20 sm:ml-56 text-white">
        <h2 class="text-2xl font-semibold mb-4">Manajemen Kode Undangan</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-700 h-44 p-6 rounded-lg shadow-lg">
                <form action="{{ route('invitation.store') }}" method="POST">
                    @csrf
                    <label class="block mb-2 text-gray-300">Jumlah Kode</label>
                    <input type="number" name="quantity" min="1" max="50"
                        class="w-full p-2 rounded bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <button type="submit"
                        class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Generate Kode
                    </button>
                </form>
            </div>

            <!-- Daftar Kode Undangan -->
            <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Kode Undangan Aktif</h3>
                <div class="max-h-60 overflow-y-auto space-y-2">
                    <ul>
                        @foreach ($codes as $code)
                            <li class="p-2 bg-gray-800 mb-1 rounded-lg text-center text-green-400 font-mono">
                                {{ $code->code }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

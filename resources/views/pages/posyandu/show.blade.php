@extends('layouts.app')

@section('content')
    <div class="w-full px-6 py-6 mx-auto">

        <h2 class="text-2xl font-bold mb-4">{{ $posyandu->nama }}</h2>
        <p><strong>Alamat:</strong> {{ $posyandu->alamat }}</p>
        <p><strong>RT/RW:</strong> {{ $posyandu->rt }}/{{ $posyandu->rw }}</p>
        <p><strong>Kontak:</strong> {{ $posyandu->kontak }}</p>

        <hr class="my-4">

        <h3 class="text-xl font-semibold">File Media</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
            @foreach ($media as $m)
                <div class="border p-2 rounded shadow">
                    <img src="{{ asset('storage/media/' . $m->file_name) }}" alt="{{ $m->file_name }}"
                        class="w-full h-40 object-cover rounded">
                    <p class="text-sm mt-1 text-center">{{ $m->caption ?? $m->file_name }}</p>
                </div>
            @endforeach
        </div>


    </div>
@endsection

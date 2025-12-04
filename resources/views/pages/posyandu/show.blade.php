@extends('layouts.guest.app')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    <h2 class="text-2xl font-bold mb-4">{{ $posyandu->nama }}</h2>
    <p><strong>Alamat:</strong> {{ $posyandu->alamat }}</p>
    <p><strong>RT/RW:</strong> {{ $posyandu->rt }}/{{ $posyandu->rw }}</p>
    <p><strong>Kontak:</strong> {{ $posyandu->kontak }}</p>

    <hr class="my-4">

    <h3 class="text-xl font-semibold">File Media</h3>

    @if ($medias->isEmpty())
        <p class="text-gray-500">Tidak ada file.</p>
    @else
        <ul class="list-disc pl-6 mt-2">
            @foreach ($medias as $m)
                <li>
                    <a href="{{ asset('storage/'.$m->file_path) }}" target="_blank"
                       class="text-blue-600">
                        {{ $m->file_name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

</div>
@endsection

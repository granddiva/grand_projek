@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="fas fa-clinic-medical me-2 text-pink"></i> Data Posyandu
        </h2>
        <a href="{{ route('posyandu.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Posyandu
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white p-3 border-bottom">
            {{-- ================================================================= --}}
            {{-- SEARCH & FILTER FORM (Dibuat lebih inline dan rapi) --}}
            {{-- ================================================================= --}}
            <form method="GET" action="{{ route('posyandu.index') }}">
                <div class="row g-3 align-items-center">

                    {{-- Pencarian Umum (q) --}}
                    <div class="col-md-4">
                        <input type="text" name="q" class="form-control form-control-sm"
                               placeholder="Cari nama / alamat / RT / RW..."
                               value="{{ request('q') }}">
                    </div>

                    {{-- Filter RT --}}
                    <div class="col-md-1">
                        <input type="text" name="rt" class="form-control form-control-sm"
                               placeholder="RT" value="{{ request('rt') }}">
                    </div>

                    {{-- Filter RW --}}
                    <div class="col-md-1">
                        <input type="text" name="rw" class="form-control form-control-sm"
                               placeholder="RW" value="{{ request('rw') }}">
                    </div>

                    {{-- Item per halaman (per_page) --}}
                    <div class="col-md-2">
                        <select name="per_page" class="form-select form-select-sm">
                            <option selected disabled>Tampil Data</option>
                            @foreach([10, 15, 25, 50] as $n)
                                <option value="{{ $n }}" {{ request('per_page') == $n ? 'selected' : '' }}>
                                    {{ $n }} Data
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tombol Submit / Filter --}}
                    <div class="col-md-2">
                        <button class="btn btn-sm btn-outline-secondary w-100" type="submit">
                            <i class="fas fa-search me-1"></i> Filter
                        </button>
                    </div>

                    {{-- Tombol Reset --}}
                    <div class="col-md-2">
                        <a href="{{ route('posyandu.index') }}" class="btn btn-sm btn-outline-danger w-100">
                             <i class="fas fa-times me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            {{-- ================================================================= --}}
            {{-- TABEL DATA POSYANDU --}}
            {{-- ================================================================= --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="40px">No</th>
                            <th>Nama Posyandu</th>
                            <th>Alamat</th>
                            <th width="50px">RT</th>
                            <th width="50px">RW</th>
                            <th width="150px">Kontak</th>
                            <th width="100px">Media</th>
                            <th width="120px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($posyandu as $i => $p)
                            <tr>
                                <td class="text-center">{{ $posyandu->firstItem() + $i }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td class="text-center">{{ $p->rt ?? '-' }}</td>
                                <td class="text-center">{{ $p->rw ?? '-' }}</td>
                                <td>{{ $p->kontak ?? '-' }}</td>

                                <td class="text-center">
                                    @if($p->media)
                                        <a href="{{ $p->media }}" target="_blank" class="btn btn-link btn-sm p-0" title="Lihat Media">
                                            Lihat <i class="fas fa-external-link-alt ms-1"></i>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="text-center">
                                    {{-- Button Group untuk Aksi --}}
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Aksi Posyandu">

                                        <a href="{{ route('posyandu.show', $p->posyandu_id) }}"
                                           class="btn btn-info text-white" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('posyandu.edit', $p->posyandu_id) }}"
                                           class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('posyandu.destroy', $p->posyandu_id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin hapus data Posyandu {{ $p->nama }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-box-open me-2"></i> Tidak ada data Posyandu yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ================================================================= --}}
    {{-- PAGINATION --}}
    {{-- ================================================================= --}}
    <div class="mt-3">
        {{ $posyandu->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection

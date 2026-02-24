@extends('layout.base')

@section('title', 'Edit Buku')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
    <a href="{{ route('books.index') }}" class="active">📚 Kelola Data Buku</a>
    <a href="{{ route('transactions.index.admin') }}">📋 Transaksi</a>
    <a href="{{ route('members.index') }}">👥 Kelola Anggota</a>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Data Buku</h1>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('books.update', $book) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="kode_buku" class="form-label">Kode Buku</label>
                    <input type="text" class="form-control @error('kode_buku') is-invalid @enderror" 
                           id="kode_buku" name="kode_buku" value="{{ old('kode_buku', $book->kode_buku) }}" required>
                    @error('kode_buku')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="judul_buku" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control @error('judul_buku') is-invalid @enderror" 
                           id="judul_buku" name="judul_buku" value="{{ old('judul_buku', $book->judul_buku) }}" required>
                    @error('judul_buku')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pengarang" class="form-label">Pengarang</label>
                    <input type="text" class="form-control @error('pengarang') is-invalid @enderror" 
                           id="pengarang" name="pengarang" value="{{ old('pengarang', $book->pengarang) }}" required>
                    @error('pengarang')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                           id="penerbit" name="penerbit" value="{{ old('penerbit', $book->penerbit) }}" required>
                    @error('penerbit')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" 
                           id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}" 
                           min="1900" max="{{ date('Y') }}" required>
                    @error('tahun_terbit')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">💾 Perbarui</button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

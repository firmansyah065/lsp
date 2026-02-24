@extends('layout.base')

@section('title', 'Edit Transaksi')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
    <a href="{{ route('books.index') }}">📚 Kelola Data Buku</a>
    <a href="{{ route('transactions.index.admin') }}" class="active">📋 Transaksi</a>
    <a href="{{ route('members.index') }}">👥 Kelola Anggota</a>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Transaksi</h1>
        <a href="{{ route('transactions.index.admin') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('transactions.update', $transaction) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Siswa</label>
                    <p class="form-control-plaintext">{{ $transaction->user->nis }} - {{ $transaction->user->nama_lengkap }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Buku</label>
                    <p class="form-control-plaintext">{{ $transaction->book->kode_buku }} - {{ $transaction->book->judul_buku }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Pinjam</label>
                    <p class="form-control-plaintext">{{ $transaction->tanggal_pinjam->format('d/m/Y') }}</p>
                </div>

                <div class="mb-3">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                    <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" 
                           id="tanggal_kembali" name="tanggal_kembali" 
                           value="{{ old('tanggal_kembali', $transaction->tanggal_kembali?->format('Y-m-d')) }}">
                    @error('tanggal_kembali')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" 
                            id="status" name="status" required>
                        <option value="pinjam" {{ old('status', $transaction->status) === 'pinjam' ? 'selected' : '' }}>Pinjam</option>
                        <option value="kembali" {{ old('status', $transaction->status) === 'kembali' ? 'selected' : '' }}>Kembali</option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">💾 Perbarui</button>
                    <a href="{{ route('transactions.index.admin') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

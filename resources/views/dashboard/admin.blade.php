@extends('layout.base')

@section('title', 'Dashboard Admin')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="active">📊 Dashboard</a>
    <a href="{{ route('books.index') }}">📚 Kelola Data Buku</a>
    <a href="{{ route('transactions.index.admin') }}">📋 Transaksi</a>
    <a href="{{ route('members.index') }}">👥 Kelola Anggota</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Dashboard Admin</h1>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Buku</h5>
                            <h2 class="text-primary">{{ \App\Models\Book::count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Buku Tersedia</h5>
                            <h2 class="text-success">{{ \App\Models\Book::where('is_available', true)->count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Buku Dipinjam</h5>
                            <h2 class="text-warning">{{ \App\Models\Book::where('is_available', false)->count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Anggota</h5>
                            <h2 class="text-info">{{ \App\Models\User::where('role', 'siswa')->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Menu Utama</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('books.index') }}" class="btn btn-outline-primary w-100 py-3">
                                <h5>📚 Kelola Data Buku</h5>
                                <small>Tambah, ubah, atau hapus data buku</small>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('transactions.index.admin') }}" class="btn btn-outline-info w-100 py-3">
                                <h5>📋 Transaksi</h5>
                                <small>Lihat histori peminjaman & pengembalian</small>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('members.index') }}" class="btn btn-outline-success w-100 py-3">
                                <h5>👥 Kelola Anggota</h5>
                                <small>Kelola data siswa yang terdaftar</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
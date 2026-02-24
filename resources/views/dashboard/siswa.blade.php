@extends('layout.base')

@section('title', 'Dashboard Siswa')

@section('sidebar')
    <a href="{{ route('student.dashboard') }}" class="active">📊 Dashboard</a>
    <a href="{{ route('borrowings') }}">📥 Peminjaman Buku</a>
    <a href="{{ route('pengembalian') }}">📤 Pengembalian Buku</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Dashboard Siswa</h1>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Buku Yang Sedang Dipinjam</h5>
                            <h2 class="text-warning">{{ \App\Models\Transaction::where('user_id', Auth::id())->where('status', 'pinjam')->count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Peminjaman</h5>
                            <h2 class="text-info">{{ \App\Models\Transaction::where('user_id', Auth::id())->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            
@endsection
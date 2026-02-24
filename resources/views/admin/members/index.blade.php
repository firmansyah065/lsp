@extends('layout.base')

@section('title', 'Kelola Anggota')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
    <a href="{{ route('books.index') }}">📚 Kelola Data Buku</a>
    <a href="{{ route('transactions.index.admin') }}">📋 Transaksi</a>
    <a href="{{ route('members.index') }}" class="active">👥 Kelola Anggota</a>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Kelola Anggota</h1>
        <a href="{{ route('members.create') }}" class="btn btn-primary">➕ Tambah Anggota</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Anggota</th>
                        <th>NIS</th>
                        <th>Nama Anggota</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $key => $member)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><strong>#{{ $member->id }}</strong></td>
                            <td>{{ $member->nis }}</td>
                            <td>{{ $member->nama_lengkap }}</td>
                            <td>{{ $member->kelas }}</td>
                            <td>{{ $member->jurusan }}</td>
                            <td>{{ $member->username }}</td>
                            <td>
                                <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                                <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">Tidak ada anggota terdaftar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

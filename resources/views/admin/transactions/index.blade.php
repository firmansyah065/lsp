@extends('layout.base')

@section('title', 'Transaksi Peminjaman')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
    <a href="{{ route('books.index') }}">📚 Kelola Data Buku</a>
    <a href="{{ route('transactions.index.admin') }}" class="active">📋 Transaksi</a>
    <a href="{{ route('members.index') }}">👥 Kelola Anggota</a>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Transaksi Peminjaman & Pengembalian</h1>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">➕ Buat Transaksi</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>NIS</th>
                        <th>Nama Anggota</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $key => $trans)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><strong>#{{ $trans->id }}</strong></td>
                            <td>{{ $trans->user->nis }}</td>
                            <td>{{ $trans->user->nama_lengkap }}</td>
                            <td>{{ $trans->user->kelas }}</td>
                            <td>{{ $trans->user->jurusan }}</td>
                            <td>{{ $trans->book->judul_buku }}</td>
                            <td>{{ $trans->tanggal_pinjam->format('d/m/Y') }}</td>
                            <td>{{ $trans->tanggal_kembali ? $trans->tanggal_kembali->format('d/m/Y') : '-' }}</td>
                            <td>
                                @if ($trans->status === 'pinjam')
                                    <span class="badge bg-warning">Dipinjam</span>
                                @else
                                    <span class="badge bg-success">Dikembalikan</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('transactions.edit', $trans) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                                <form action="{{ route('transactions.destroy', $trans) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-4">Tidak ada transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

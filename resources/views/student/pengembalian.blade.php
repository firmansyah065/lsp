@extends('layout.base')

@section('title', 'Pengembalian Buku')

@section('sidebar')
    <a href="{{ route('student.dashboard') }}">📊 Dashboard</a>
    <a href="{{ route('borrowings') }}">📥 Peminjaman Buku</a>
    <a href="{{ route('pengembalian') }}" class="active">📤 Pengembalian Buku</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Pengembalian Buku</h1>
                <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">← Kembali</a>
            </div>

            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Daftar Buku Yang Sedang Dipinjam</h5>
                </div>
                <div class="table-responsive">
                    @php
                        $borrowings = \App\Models\Transaction::where('user_id', Auth::id())
                                                ->where('status', 'pinjam')
                                                ->with('book')
                                                ->get();
                    @endphp
                    
                    @if ($borrowings->count() > 0)
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Buku</th>
                                    <th>Judul Buku</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($borrowings as $key => $borrow)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><strong>{{ $borrow->book->kode_buku }}</strong></td>
                                        <td>{{ $borrow->book->judul_buku }}</td>
                                        <td>{{ $borrow->book->pengarang }}</td>
                                        <td>{{ $borrow->book->penerbit }}</td>
                                        <td>{{ $borrow->tanggal_pinjam->format('d/m/Y') }}</td>
                                        <td>
                                            <form action="{{ route('return') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="transaction_id" value="{{ $borrow->id }}">
                                                <button type="submit" class="btn btn-sm btn-success">📤 Kembalikan</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">Anda tidak memiliki buku yang sedang dipinjam</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @else
                        <div class="text-center py-5">
                            <h5>Tidak Ada Buku Yang Sedang Dipinjam</h5>
                            <p>Anda tidak memiliki buku yang perlu dikembalikan.</p>
                            <a href="{{ route('borrowings') }}" class="btn btn-primary mt-2">Pinjam Buku →</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

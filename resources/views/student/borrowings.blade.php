@extends('layout.base')

@section('title', 'Peminjaman Buku')

@section('sidebar')
    <a href="{{ route('student.dashboard') }}">📊 Dashboard</a>
    <a href="{{ route('borrowings') }}" class="active">📥 Peminjaman Buku</a>
    <a href="{{ route('pengembalian') }}">📤 Pengembalian Buku</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Peminjaman Buku</h1>
                <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">← Kembali</a>
            </div>

            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Daftar Buku Tersedia</h5>
                </div>
                <div class="table-responsive">
                    @php
                        $available_books = \App\Models\Book::where('is_available', true)->get();
                    @endphp
                    
                    @if ($available_books->count() > 0)
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Buku</th>
                                    <th>Judul Buku</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tahun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($available_books as $key => $book)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><strong>{{ $book->kode_buku }}</strong></td>
                                        <td>{{ $book->judul_buku }}</td>
                                        <td>{{ $book->pengarang }}</td>
                                        <td>{{ $book->penerbit }}</td>
                                        <td>{{ $book->tahun_terbit }}</td>
                                        <td>
                                            <form action="{{ route('borrow') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                <button type="submit" class="btn btn-sm btn-primary">📥 Pinjam</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">Tidak ada buku tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @else
                        <div class="text-center py-5">
                            <h5>Tidak Ada Buku Tersedia</h5>
                            <p>Semua buku sedang dipinjam. Silakan coba lagi nanti.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection

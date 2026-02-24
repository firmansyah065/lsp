<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'kode_buku' => 'BK001',
                'judul_buku' => 'Belajar PHP Dasar',
                'pengarang' => 'Andi Wijaya',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2022,
                'is_available' => true,
            ],
            [
                'kode_buku' => 'BK002',
                'judul_buku' => 'Web Development Modern',
                'pengarang' => 'Budi Santoso',
                'penerbit' => 'Elex Media',
                'tahun_terbit' => 2023,
                'is_available' => true,
            ],
            [
                'kode_buku' => 'BK003',
                'judul_buku' => 'Database MySQL',
                'pengarang' => 'Citra Dewi',
                'penerbit' => 'Informatika',
                'tahun_terbit' => 2021,
                'is_available' => true,
            ],
            [
                'kode_buku' => 'BK004',
                'judul_buku' => 'JavaScript untuk Pemula',
                'pengarang' => 'Doni Pratama',
                'penerbit' => 'Andi Publisher',
                'tahun_terbit' => 2023,
                'is_available' => true,
            ],
            [
                'kode_buku' => 'BK005',
                'judul_buku' => 'Desain UX/UI',
                'pengarang' => 'Erina Kusuma',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2022,
                'is_available' => true,
            ],
            [
                'kode_buku' => 'BK006',
                'judul_buku' => 'Pemrograman Laravel',
                'pengarang' => 'Fajar Ramadhan',
                'penerbit' => 'Informatika',
                'tahun_terbit' => 2023,
                'is_available' => true,
            ],
            [
                'kode_buku' => 'BK007',
                'judul_buku' => 'Security & Networking',
                'pengarang' => 'Gina Sari',
                'penerbit' => 'Elex Media',
                'tahun_terbit' => 2022,
                'is_available' => true,
            ],
            [
                'kode_buku' => 'BK008',
                'judul_buku' => 'Cloud Computing Basics',
                'pengarang' => 'Hendra Wijaya',
                'penerbit' => 'Andi Publisher',
                'tahun_terbit' => 2023,
                'is_available' => true,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}

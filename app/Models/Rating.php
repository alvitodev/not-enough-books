<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    // Karena tabel ratings memiliki kolom 'rating' selain foreign keys,
    // dan mungkin tidak memiliki primary key 'id' (tergantung migrasi Anda,
    // migrasi Anda tidak mendefinisikan primary key, jadi Eloquent akan mengasumsikan 'id').
    // Jika Anda ingin user_id dan book_id unik bersamaan, Anda harus menambahkannya di migrasi.
    // ALTER TABLE ratings ADD PRIMARY KEY (user_id, book_id); (contoh SQL)
    // atau di migrasi: $table->primary(['user_id', 'book_id']);

    protected $fillable = [
        'user_id',
        'book_id',
        'rating', // Kolom rating tambahan
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Books::class);
    }
}
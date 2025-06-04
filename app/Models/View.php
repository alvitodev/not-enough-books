<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Seharusnya Relations\Pivot jika ini murni tabel pivot

// Jika ini murni tabel pivot (hanya user_id, book_id, timestamps), lebih baik extends Pivot
// use Illuminate\Database\Eloquent\Relations\Pivot;
// class View extends Pivot

class View extends Model // Untuk saat ini kita anggap sebagai Model biasa
{
    use HasFactory;

    // Jika Anda ingin menggunakan created_at/updated_at, biarkan default.
    // Jika tidak, public $timestamps = false;

    protected $table = 'views'; // Eksplisit mendefinisikan nama tabel (opsional jika sudah sesuai konvensi)

    // Tentukan primary key jika bukan 'id' atau jika composite
    // protected $primaryKey = ['user_id', 'book_id']; // Hanya jika Anda set composite di migrasi
    // public $incrementing = false; // Diperlukan jika primary key bukan auto-increment integer

    protected $fillable = [ // Atau gunakan $guarded = [];
        'user_id',
        'book_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book() // Nama method bisa 'books' atau 'book'
    {
        return $this->belongsTo(Books::class); // Sesuaikan dengan nama model buku Anda
    }
}
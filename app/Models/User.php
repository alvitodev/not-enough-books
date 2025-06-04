<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'is_admin', // Kolom untuk menandakan admin
        'image',    // Kolom untuk gambar profil (sesuai migrasi)
        // 'bio',   // Jika ada kolom bio (sesuai migrasi)
    ];

    // $guarded juga bisa digunakan, pilih salah satu strategi (fillable atau guarded)
    // protected $guarded = ['id']; // Jika ini aktif, $fillable biasanya tidak diperlukan atau sebaliknya

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Otomatis hash password saat diset
            'is_admin' => 'boolean', // Casting is_admin ke boolean
        ];
    }

    /**
     * Buku-buku yang dilihat oleh user ini.
     */
    public function viewedBooks()
    {
        return $this->belongsToMany(Books::class, 'views', 'user_id', 'book_id')->withTimestamps();
    }

    /**
     * Buku-buku yang disukai oleh user ini.
     */
    public function likedBooks()
    {
        return $this->belongsToMany(Books::class, 'likes', 'user_id', 'book_id')->withTimestamps();
    }

    /**
     * Buku-buku yang ada di wishlist user ini.
     */
    public function wishlistedBooks() // Mengganti nama dari wishlists() agar lebih deskriptif
    {
        return $this->belongsToMany(Books::class, 'wishlists', 'user_id', 'book_id')->withTimestamps();
    }

    /**
     * Rating yang diberikan oleh user ini.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id'); // Satu user bisa memberikan banyak rating
    }
}
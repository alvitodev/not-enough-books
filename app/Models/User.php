<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Book;

class User extends Authenticatable
{
    public function library()
    {
        return $this->hasMany(Library::class);
    }
    
    /** @use HasFactory<\Database\Factories\UserFactory> */
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



}
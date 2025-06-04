<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Sluggable; // Untuk auto-generate slug

    protected $guarded = ['id'];

    /**
     * Konfigurasi untuk Sluggable.
     * Akan membuat slug dari kolom 'title' (sesuai migrasi).
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title' // Diubah dari 'name' menjadi 'title' agar sesuai migrasi
            ]
        ];
    }

    /**
     * Mendefinisikan bahwa satu kategori bisa memiliki banyak buku.
     */
    public function books()
    {
        return $this->hasMany(Book::class); // Diubah dari Book::class menjadi Books::class
    }

    /**
     * Menggunakan 'slug' untuk route model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
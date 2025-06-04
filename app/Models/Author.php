<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Atau $guarded = ['id'];

    // Jika Anda memiliki author_id di tabel books, Anda bisa menambahkan relasi:
    // public function books()
    // {
    //     return $this->hasMany(Books::class, 'author_id');
    // }
}
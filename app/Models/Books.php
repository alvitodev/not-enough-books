<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable; // Pastikan package ini sudah terinstall: composer require cviebrock/eloquent-sluggable

class Books extends Model // Nama kelas sudah Books
{
    use HasFactory;
    use Sluggable; // Untuk auto-generate slug

    protected $guarded = ['id']; // Baik, menjaga field 'id' dari mass assignment
    protected $with = ['category']; // Eager load relasi category secara default

    /**
     * Konfigurasi untuk Sluggable.
     * Akan membuat slug dari kolom 'title'.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Mendefinisikan bahwa setiap buku 'milik satu' Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Jika Anda ingin menggunakan 'author' sebagai relasi ke model Author,
    // maka tabel 'books' perlu kolom 'author_id' dan relasi di bawah ini:
    // public function author_model() // beri nama berbeda jika kolom 'author' string masih ada
    // {
    //     return $this->belongsTo(Author::class, 'author_id'); // Asumsi foreign key adalah author_id
    // }
    // Saat ini, migrasi 'books' memiliki kolom 'author' sebagai string, jadi tidak ada relasi Eloquent langsung.

    /**
     * Relasi untuk user yang melihat buku ini (jika ada tabel views).
     */
    public function viewers()
    {
        return $this->belongsToMany(User::class, 'views', 'book_id', 'user_id')->withTimestamps();
    }

    /**
     * Relasi untuk user yang menyukai buku ini (jika ada tabel likes).
     */
    public function likers()
    {
        return $this->belongsToMany(User::class, 'likes', 'book_id', 'user_id')->withTimestamps();
    }

    /**
     * Relasi untuk user yang memasukkan ke wishlist (jika ada tabel wishlists).
     */
    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'book_id', 'user_id')->withTimestamps();
    }

    /**
     * Relasi untuk rating buku ini (jika ada tabel ratings).
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'book_id'); // Satu buku bisa punya banyak rating
    }


    /**
     * Scope untuk filtering.
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('author', 'like', '%' . $search . '%'); // Jika 'author' adalah string di tabel books
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $categorySlug) {
            // Filter berdasarkan slug kategori
            return $query->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            });
        });

        // Filter berdasarkan author (jika author adalah relasi ke model User atau Author)
        // Contoh jika 'author' adalah kolom string di tabel 'books' dan Anda ingin filter berdasarkan itu:
        // $query->when($filters['author_name'] ?? false, function($query, $authorName) {
        //     return $query->where('author', 'like', '%' . $authorName . '%');
        // });

        // Jika Anda punya relasi author_model() yang didefinisikan di atas:
        // $query->when($filters['author_username'] ?? false, function($query, $username) {
        //     return $query->whereHas('author_model', function($query) use ($username){ // Asumsi relasi author_model()
        //         // dan model Author/User memiliki kolom 'username'
        //         $query->where('username', $username); // atau 'name' jika filternya berdasarkan nama author
        //     });
        // });
    }

    /**
     * Menggunakan 'slug' untuk route model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
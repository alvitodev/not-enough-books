<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    use Sluggable;


    protected $guarded = ['id'];
    protected $with = ['category'];

    public function scopeFilter($query, array $filters) {
        if(isset($filters['search']) ? $filters['search'] : false) {
            
        }

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
            });
            // return $query->where('title', 'like', '%' . $search . '%')
            //     ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category', function($query) use ($category){
                $query->where('slug', $category);
            });
        });

        // $query->when($filters['author'] ?? false, fn($query, $author) =>
        //     $query->whereHas('author', fn($query) =>
        //         $query->where('username', $author)
        //     )
        // );

    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function getRouteKeyName() {
        return 'slug';
    }
    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

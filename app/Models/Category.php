<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    use Sluggable;


    protected $guarded = ['id'];

    public function books() {
        return $this->hasMany(Book::class);
    }


    public function getRouteKeyName() {
        return 'slug';
    }

    
    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}

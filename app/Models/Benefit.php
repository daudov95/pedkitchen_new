<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'image', 'document'];

    public function category()
    {
        return $this->belongsTo(CategoryBenefit::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}

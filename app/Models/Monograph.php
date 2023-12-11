<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monograph extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'desc', 'year', 'category_id', 'image', 'document', 'authors'];

    public function category()
    {
        return $this->belongsTo(CategoryMonograph::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}

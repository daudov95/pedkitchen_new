<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'image', 'document'];

    public function category()
    {
        return $this->belongsTo(CategoryDiagnostic::class);
    }

    public function getExcerptAttribute()
    {
        return mb_strimwidth($this->title, 0, 110, "...");
    }
}

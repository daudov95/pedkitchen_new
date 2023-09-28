<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'menu_id',
        'submenu_id',
        'category_id',
        'tab1_title',
        'tab2_title',
        'tab3_title',
        'tab4_title',
        'tab1_desc',
        'tab2_desc',
        'tab3_desc',
        'tab4_desc',
    ];

    public function authors () {
        return $this->belongsToMany(Author::class);
    }

    public function category () {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}
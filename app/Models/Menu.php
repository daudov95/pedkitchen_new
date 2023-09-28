<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu_lists';
    protected $fillable = ['title', 'content', 'image'];

    public function submenu() {
        return $this->hasMany(Submenu::class, 'parent_id', 'id');
    }

    public function posts() {
        return $this->hasMany(Post::class, 'menu_id', 'id');
    }


    public function subscribers() {
        return $this->hasMany(Subscriber::class, 'menu_id', 'id');
    }

}

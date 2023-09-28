<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Distribution extends Model
{
    use HasFactory;
    protected $fillable = ['menu_id'];

    public function section() {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyContact extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'question_id'];


    public function getCreatedTimeAttribute ()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}

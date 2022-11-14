<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Post extends Model
{
    use HasFactory;
    public $guarded = [];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

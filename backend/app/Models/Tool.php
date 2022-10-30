<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'image',
        'description',
    ];

    public function bookmarks(){
        return $this->hasMany(Bookmark::class);
    }
}

<?php

namespace App\Models\Api\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    //Relación muchos a muchos
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}

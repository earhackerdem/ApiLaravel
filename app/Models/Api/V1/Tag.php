<?php

namespace App\Models\Api\V1;

use App\Traits\ApiTrait;
use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, ApiTrait;

    protected static function newFactory()
    {
        return TagFactory::new();
    }

    //Relación muchos a muchos
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }


}

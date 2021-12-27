<?php

namespace App\Models\Api\V1;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Traits\ApiTrait;

class Post extends Model
{
    use HasFactory, ApiTrait;
    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected static function newFactory()
    {
        return PostFactory::new();
    }

    //Relación uno a muchos inversa

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Relación muchos a muchos
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //Relación uno a muchos polimorfica
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


}

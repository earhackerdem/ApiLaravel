<?php

namespace App\Models\Api\V1;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    protected $fillable = ['name','slug'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

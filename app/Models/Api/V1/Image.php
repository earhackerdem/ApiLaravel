<?php

namespace App\Models\Api\V1;

use Database\Factories\ImageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return ImageFactory::new();
    }

    public function imageable()
    {
        return $this->morphTo();
    }

}

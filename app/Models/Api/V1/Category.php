<?php

namespace App\Models\Api\V1;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    protected $fillable = ['name', 'slug'];

    protected $allowIncluded = ['posts','posts.user'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeIncluded(Builder $query)
    {

        if (empty($this->allowIncluded)||empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included')); //posts,users,posts.users = [posts,users,posts,users]

        $allowIncluded = collect($this->allowIncluded);

        foreach($relations as $key => $relationship){
            if(!$allowIncluded->contains($relationship)){
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }
}

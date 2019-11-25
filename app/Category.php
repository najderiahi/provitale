<?php

namespace App;

use App\Listeners\CategorySaved;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name'];
    protected $appends = ['update_url'];

    public function posts() {
        return $this->hasMany(Post::class);
    }
    public static function getPosts() {
        return static::with(['posts' => function ($query) {
            $query->take(8);
        }])->take(15)->get();
    }

    public function getUpdateUrlAttribute() {
        return route('categories.update', $this->id);
    }
}

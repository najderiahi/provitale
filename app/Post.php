<?php

namespace App;

use App\Contract\Filterable;
use App\QueryFilters\Category;
use App\QueryFilters\Query;
use App\QueryFilters\Sort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use Filterable;

    protected $fillable = ['description', 'category_id', 'image_location', 'created_at'];
    protected $appends = ['url', 'update_url'];

    protected static function getFilters()
    {
        return [
            Sort::class,
            Query::class,
            Category::class
        ];
    }

    public static function filterPosts()
    {
        return static::filterAll()->paginate();
    }

    public static function getPath($image)
    {
        return 'images/' . $image->hashName();
    }

    public function storeImage($image)
    {
        $image_location = $this->image_location;
        $image->storePubliclyAs('public/images', $image->hashName());
        $this->image_location = Post::getPath($image);
        if ($image_location) {
            Storage::disk('public')->delete($image_location);
        }
        return $this->image_location;
    }

    public static function storeFromRequestData(array $data, $image)
    {
        $path = static::getPath($image);

        if ($image->storePubliclyAs('public/images', $image->hashName())) {
            static::create([
                'description' => $data['description'],
                'category_id' => $data['category'],
                'image_location' => $path
            ]);
        }
    }

    public function category() {
        return $this->belongsTo(\App\Category::class);
    }

    public function getUrlAttribute() {
        return url('storage/'.$this->image_location);
    }

    public function getUpdateUrlAttribute() {
        return route('posts.update', $this->id);
    }
}

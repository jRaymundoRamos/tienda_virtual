<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'name','slug','short_description','description','sku','brand','display_price',
        'is_published','published_at','seo_title','seo_description','sort_order'
    ];

    public function categories(): BelongsToMany { return $this->belongsToMany(Category::class, 'product_category'); }
}

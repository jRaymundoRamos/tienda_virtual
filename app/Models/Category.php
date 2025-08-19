<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, BelongsToMany};

class Category extends Model
{
    protected $fillable = ['name','slug','parent_id','is_active','sort_order'];

    public function parent(): BelongsTo { return $this->belongsTo(Category::class, 'parent_id'); }
    public function children(): HasMany { return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order'); }
    public function products(): BelongsToMany { return $this->belongsToMany(Product::class, 'product_category'); }

    public function ancestors()
    {
        $anc = collect(); $n = $this->parent;
        while ($n) { $anc->prepend($n); $n = $n->parent; }
        return $anc;
    }
}

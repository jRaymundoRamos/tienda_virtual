<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function show(string $path)
    {
        $slugs = array_filter(explode('/', $path));
        $parent = null;
        foreach ($slugs as $slug) {
            $parent = Category::where('slug', $slug)
               ->where('parent_id', optional($parent)->id)
               ->where('is_active', true)
               ->firstOrFail();
        }
        $category = $parent;

        // IDs de categorías descendientes (incluye la actual)
        $descCats = $this->descendantCategoryIds($category->id);

        $products = Product::whereHas('categories', fn($q)=>$q->whereIn('categories.id',$descCats))
            ->where('is_published',true)
            ->latest('published_at')
            ->paginate(24);

        return view('category.show', compact('category','products'));
    }

    private function descendantCategoryIds(int $id)
    {
        // MySQL 8+ (CTE recursivo)
        $rows = DB::select("
            WITH RECURSIVE cat_tree AS (
                SELECT id, parent_id FROM categories WHERE id = ?
                UNION ALL
                SELECT c.id, c.parent_id FROM categories c
                INNER JOIN cat_tree ct ON c.parent_id = ct.id
            )
            SELECT id FROM cat_tree
        ", [$id]);

        return collect($rows)->pluck('id');
    }
}

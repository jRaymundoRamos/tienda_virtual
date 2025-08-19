<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::where('slug',$slug)
            ->where('is_published',true)->firstOrFail();
        return view('product.show', compact('product'));
    }

    public function search(Request $r)
    {
        $q = trim($r->get('q',''));
        $products = Product::query()
            ->when($q, fn($qq)=>$qq->where(function($w) use($q){
                $w->where('name','like',"%$q%")
                  ->orWhere('description','like',"%$q%");
            }))
            ->where('is_published',true)
            ->latest('published_at')
            ->paginate(24);
        return view('product.search', compact('products','q'));
    }
}

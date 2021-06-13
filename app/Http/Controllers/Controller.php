<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use App\Models\Post;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
      {
        //its just a dummy data object.
        $productCategory = ProductCategory::all();
        View::share('productCategory', $productCategory);
      }

      public function index(){
        $product = ProductVariant::with('product.category')->orderBy('created_at','DESC')->get()->take(4);
        $post = Post::orderBy('created_at','DESC')->get()->take(3);
        return view('user.index',['product'=> $product, 'posts' => $post]);
      }
}

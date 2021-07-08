<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\ProductCategory;
use App\Models\StoreInformation;
use App\Models\ProductVariant;
use App\Models\Post;
use App\Models\File;
use App\Models\Configuration;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
      {
        $productCategory = ProductCategory::all();
        $program = StoreInformation::where('type','program')->get();
        $config_ui = Configuration::where('name','ui')->first();
        $config_ui->content = json_decode($config_ui->content);
        $config_ui->content->logo = File::where('uuid',$config_ui->content->logo)->first();
        if(count($program) > 0){
            foreach ($program as $key => $value) {
                $value->detail = json_decode($value->detail);
            }
        }
        $info = StoreInformation::where('type','lokasi')->first();
        $info->detail = json_decode($info->detail);
        $data = array(
          'productCategory' => $productCategory,
          'program' => $program,
          'info' => $info,
          'ui' => $config_ui
        );
        View::share('data', $data);
      }

      public function index(){
        $product = ProductVariant::with('product.category')->orderBy('created_at','DESC')->get()->take(4);
        $post = Post::orderBy('created_at','DESC')->with('file')->get()->take(3);
        return view('user.index',['product'=> $product, 'posts' => $post]);
      }
}

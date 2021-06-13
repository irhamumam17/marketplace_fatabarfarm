<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index');
    }
    public function get_data()
    {
        $data = Product::with('category')->withCount('variant')->get();
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses Mendapatkan Data Produk'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id' => 'required',
            'name' => 'required|string',
            'detail' => 'required|string',
            'image' => 'required',
            'image.*' => 'image|max:10000',
        ]);
        if($request->hasfile('image')) {
            // $images = [];
            // foreach($request->file('image') as $file)
            // {
                $path = $request->file('image')->store('uploads/images/products','public');
                $file = File::create([
                    'path' => $path
                ]);
                // array_push($images,$file->uuid);
            // }
            $product = Product::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'detail' => $request->detail,
                'image' => $file->uuid
            ]);
            return redirect(route('product.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $category = ProductCategory::all();
        $product = Product::with('category','file')->where('uuid',$uuid)->first();
        return view('admin.product.edit',['data' => $product,'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $product = Product::where('uuid',$uuid)->first();
        $this->validate($request,[
            'category_id' => 'required',
            'name' => 'required|string',
            'detail' => 'required|string',
        ]);
        $input = $request->only('category_id','name','detail');
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            ]);
            // foreach(json_decode($product->image) as $prod){
                $file = File::where('uuid',$product->image)->first();
                Storage::disk('public')->delete($file->path);
                File::where('uuid',$product->image)->delete();
            // }
            // foreach($request->file('image') as $file)
            // {
                $path = $request->file('image')->store('uploads/images/products','public');
                $file = File::create([
                    'path' => $path
                ]);
                // array_push($images,$file->uuid);
            // }
            $input['image'] = $file->uuid;
        }
        try{
            $product->update($input);
            return redirect(route('product.index'));
        }catch(Exception $x){
            return redirect(back());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            foreach(json_decode($product->image) as $prod){
                $file = File::where('uuid',$prod)->first();
                Storage::disk('public')->delete($file->path);
                File::where('uuid',$prod)->delete();
            }
            $product->delete();
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Data Sukses Dihapus'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $th->getMessage()
            ]);
        }
    }
    public function upload_image(Request $request){
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = $file->store('uploads/images/products','public');
            return $path;
        }
    }
    public function user_product(){
        $product = ProductVariant::with('product.category')->get();
        return view('user.product',['product' => $product]);
    }
    public function user_product_detail(){
        return view('user.product-detail');
    }
    public function user_category($category){
        $product = ProductVariant::with('product.category')->whereHas('product',function($q) use ($category){
                        $q->whereHas('category',function($r) use ($category){
                            $r->where('id',$category);
                        });
                    })->get();
        return view('user.product',['product' => $product]);
    }
}

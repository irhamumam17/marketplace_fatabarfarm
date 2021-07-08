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
        ]);
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'detail' => $request->detail,
        ]);
        return redirect(route('product.index'));
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
        return view('user.product',['product' => $product, 'category' => $category]);
    }

    public function user_category_cari(Request $request, $id){
        $product = ProductVariant::with('product.category')->whereHas('product',function($q) use ($id, $request){
                        $q->whereHas('category',function($r) use ($id){
                            $r->where('id',$id);
                        })->where('name', 'LIKE', '%'.$request->key.'%');
                    })->orWhere('detail', 'LIKE', '%'.$request->key.'%')->get();
        return view('user.product',['product' => $product, 'category' => $id, 'key' => $request->key]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product-variant.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::all();
        return view('admin.product-variant.create',['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->detail = json_decode($request->detail);
        $this->validate($request,[
            'product_id' => 'required',
            'detail' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'detail.*.name' => ['required','string'],
            'detail.*.value' => ['required']
        ]);

        $input = $request->only('product_id','price','stock');
        $input['detail'] = json_encode($request->detail);
        try {
            $path = $request->file('image')->store('uploads/images/products/variants','public');
            $file = File::create([
                'path' => $path
            ]);
            $input['image'] = $file->uuid;
            $pv = ProductVariant::create($input);
            return response()->json([
                'success' => true,
                'data' => $pv,
                'message' => 'Varian Berhasil Dimasukkan'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::all();
        $productVariant = ProductVariant::with('product','file')->where('uuid',$id)->first();
        return view('admin.product-variant.edit',['product' => $product, 'productVariant' => $productVariant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->detail = json_decode($request->detail);
        $productVariant = ProductVariant::where('uuid',$id)->first();
        $this->validate($request,[
            'product_id' => 'required',
            'detail' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'detail.*.name' => ['required','string'],
            'detail.*.value' => ['required']
        ]);
        $input = $request->only('id','uuid','product_id','price','stock');
        $input['detail'] = json_encode($request->detail);
        if($request->hasFile('image'))
        {
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            ]);
            Storage::disk('public')->delete($productVariant->file->path);
            $path = $request->file('image')->store('uploads/images/products/variants','public');
            $file = File::create([
                'path' => $path
            ]);
            $input['image'] = $file->uuid;
        }
        try {
            $productVariant->update($input);
            return response()->json([
                'success' => true,
                'data' => $productVariant,
                'message' => 'Varian Berhasil Diubah'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productVariant = ProductVariant::with('file')->where('uuid',$id)->first();
        try{
            Storage::disk('public')->delete($productVariant->file->path);
            $file_uuid = $productVariant->image;
            $productVariant->delete();
            File::where('uuid',$file_uuid)->delete();
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Data Sukses Dihapus'
            ]);
        }catch(Exception $x){
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Data Gagal Dihapus'
            ]);
        }
    }
    public function get_data()
    {
        $data = ProductVariant::with('product','file')->get();
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses Mendapatkan Data Produk Varian'
        ]);
    }
    public function user_product_detail($id){
        $productVariant = ProductVariant::with('product.category')->where('uuid',$id)->first();
        return view('user.product-detail',compact('productVariant'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

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
        // return $request->all();
        $this->validate($request,[
            'product_id' => 'required',
            'detail' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        return $request->detail;
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
    public function edit(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariant $productVariant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVariant $productVariant)
    {
        //
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
}

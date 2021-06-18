<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role','customer')->get();
        $product_variants = ProductVariant::with('product')->get();
        return view('admin.cart.create',['users' => $users,'product_variants' => $product_variants]);
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
            'product_varian_id' => ['required'],
            'user_id' => ['required'],
            'amount' => ['required', 'integer']
        ]);

        $input = $request->only(
            'product_varian_id',
            'user_id',
            'amount'
        );
        try {
            $cart = Cart::create($input);
            return ([
                'success' => true,
                'message' => 'Berhasil menambahkan data',
                'data' => $cart
            ]);
        } catch (\Throwable $th) {
            return ([
                'success' => false,
                'message' => $th->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        return view('admin.cart.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $this->validate($request,[
            'product_variant_id' => ['required'],
            'user_id' => ['required'],
            'amount' => ['required', 'integer']
        ]);

        $input = $request->only(
            'product_variant_id',
            'user_id',
            'amount'
        );

        try {
            $cart->update($input);
            return ([
                'success' => true,
                'message' => 'Berhasil mengubah data',
                'data' => $cart
            ]);
        } catch (\Throwable $th) {
            return ([
                'success' => false,
                'message' => $th->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        try {
            $cart->delete();
            return ([
                'success' => true,
                'message' => 'Berhasil menghapus data',
                'data' => null
            ]);
        } catch (\Throwable $th) {
            return ([
                'success' => false,
                'message' => $th->getMessage(),
                'data' => null
            ]);
        }
    }

    public function user_cart(){
        $cart = Cart::where('user_id',Auth::user()->uuid)->get();
        return view('user.cart',['carts'=> $cart]);
    }
    public function user_delete_cart_product($product_id){
        Cart::where([['product_id',$product_id],['user_id',Auth::user()->uuid]])->delete();
        return redirect()->route('user.cart');
    }
    public function user_delete_all_cart_product(){
        Cart::where([['user_id',Auth::user()->uuid]])->delete();
        return redirect()->route('user.cart');
    }

    public function get_data(){
        $cart = Cart::with('product_variant.product','user')->get();
        return ([
            'success' => true,
            'message' => 'Berhasil mendapatkan data',
            'data' => $cart
        ]);
    }
}

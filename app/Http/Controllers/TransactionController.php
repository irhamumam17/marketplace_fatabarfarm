<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function index_pending(){
        return view('admin.transaction.pending');
    }
    public function get_pending(){
        $data = Transaction::with('user','product')->where('status','pending')->get();
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses Mendapatkan Data Produk Varian'
        ]);
    }
    public function index_cancel(){
        return view('admin.transaction.cancel');
    }
    public function get_cancel(){
        $data = Transaction::with('user','product')->where('status','cancel')->get();
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses Mendapatkan Data Produk Varian'
        ]);
    }
    public function index_success(){
        return view('admin.transaction.success');
    }
    public function get_success(){
        $data = Transaction::with('user','product')->where('status','success')->get();
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses Mendapatkan Data Produk Varian'
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
    public function user_transaction(){
        $data = (object)[
            'n_keranjang' => Cart::where('user_id',Auth::user()->uuid)->count(),
            'n_transaksi' => Transaction::where('status', '!=', 'success')->orWhere('status','!=','cancel')->count(),
            'n_sukses_transaksi' => Transaction::where('status', 'success')->count(),
            'n_batal_transaksi' => Transaction::where('status', 'cancel')->count(),
            'transaksi' => Transaction::with('product_variant','product_variant.product')->where('user_id', Auth::user()->uuid)->get()
        ];
        return view('user.transaction',['data'=> $data]);
    }
    public function user_transaction_detail(){
        return view('user.transaction-detail');
    }
}

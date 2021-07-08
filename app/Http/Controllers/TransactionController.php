<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Cart;
use App\Models\Bank;
use App\Models\Province;
use App\Models\City;
use App\Models\File;
use App\Models\Ongkir;
use App\Models\ProductVariant;
use App\Models\StoreInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
        $data = Transaction::with('user','bank', 'file_transfer', 'ongkir')->where('status', 0)->get();
        foreach ($data as $value) {
            $data_pv = array();
            foreach ($value->product as $v) {
                $product_detail = ProductVariant::with('product','file')->where('uuid', $v->product_id)->first();
                $product_detail->amount = $v->amount;
                array_push($data_pv, $product_detail);
            }
            $value->product = json_encode($data_pv);
        }
        foreach($data as $d){
            $total=0;
            foreach($d->product as $p){
                $total+=(int)$p->price;
            }
            $d->total = $total;
        }
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses Mendapatkan Data Produk Varian'
        ]);
    }
    public function index_konfirmasi(){
        return view('admin.transaction.konfirmasi');
    }
    public function get_konfirmasi(){
        $data = Transaction::with('user','bank', 'file_transfer', 'ongkir')->where('status', 1)->get();
        foreach ($data as $value) {
            $data_pv = array();
            foreach ($value->product as $v) {
                $product_detail = ProductVariant::with('product','file')->where('uuid', $v->product_id)->first();
                $product_detail->amount = $v->amount;
                array_push($data_pv, $product_detail);
            }
            $value->product = json_encode($data_pv);
        }
        foreach($data as $d){
            $total=0;
            foreach($d->product as $p){
                $total+=(int)$p->price;
            }
            $d->total = $total;
        }
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses Mendapatkan Data Produk Varian'
        ]);
    }
    public function index_packing(){
        return view('admin.transaction.packing');
    }
    public function get_packing(){
        $data = Transaction::with('user','bank', 'file_transfer', 'ongkir')->where('status', 2)->get();
        foreach ($data as $value) {
            $data_pv = array();
            foreach ($value->product as $v) {
                $product_detail = ProductVariant::with('product','file')->where('uuid', $v->product_id)->first();
                $product_detail->amount = $v->amount;
                array_push($data_pv, $product_detail);
            }
            $value->product = json_encode($data_pv);
        }
        foreach($data as $d){
            $total=0;
            foreach($d->product as $p){
                $total+=(int)$p->price;
            }
            $d->total = $total;
        }
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
        $data = Transaction::with('user','bank', 'file_transfer', 'ongkir')->where('status',5)->get();
        foreach ($data as $value) {
            $data_pv = array();
            foreach ($value->product as $v) {
                $product_detail = ProductVariant::with('product','file')->where('uuid', $v->product_id)->first();
                $product_detail->amount = $v->amount;
                array_push($data_pv, $product_detail);
            }
            $value->product = json_encode($data_pv);
        }
        foreach($data as $d){
            $total=0;
            foreach($d->product as $p){
                $total+=(int)$p->price;
            }
            $d->total = $total;
        }
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
        $data = Transaction::with('user','bank', 'file_transfer', 'ongkir')->where('status',4)->get();
        foreach ($data as $value) {
            $data_pv = array();
            foreach ($value->product as $v) {
                $product_detail = ProductVariant::with('product','file')->where('uuid', $v->product_id)->first();
                $product_detail->amount = $v->amount;
                array_push($data_pv, $product_detail);
            }
            $value->product = json_encode($data_pv);
        }
        foreach($data as $d){
            $total=0;
            foreach($d->product as $p){
                $total+=(int)$p->price;
            }
            $d->total = $total;
        }
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses Mendapatkan Data Produk Varian'
        ]);
    }
    public function index_dikirim(){
        return view('admin.transaction.dikirim');
    }
    public function get_dikirim(){
        $data = Transaction::with('user','bank', 'file_transfer', 'ongkir')->where('status',3)->get();
        foreach ($data as $value) {
            $data_pv = array();
            foreach ($value->product as $v) {
                $product_detail = ProductVariant::with('product','file')->where('uuid', $v->product_id)->first();
                $product_detail->amount = $v->amount;
                array_push($data_pv, $product_detail);
            }
            $value->product = json_encode($data_pv);
        }
        foreach($data as $d){
            $total=0;
            foreach($d->product as $p){
                $total+=(int)$p->price;
            }
            $d->total = $total;
        }
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
        $product_variants = ProductVariant::with('product')->get();
        $banks = Bank::all();
        $users = User::all();
        $provinces = Province::all();
        return view('admin.transaction.create', compact('users','product_variants','banks','provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'user_id' => ['required'],
            'bank_id' => ['required'],
            'province_id' => ['required'],
            'city_id' => ['required'],
            'alamat' => ['required'],
            'kodepos' => ['required'],
            'nohp' => ['required'],
            'berat' => ['required'],
            'atas_nama' => ['required'],
            'kurir' => ['required'],
            'note' => ['required'],
            'status' => ['required'],
        ]);
        try{
            $input = $request->only(
                'user_id',
                'bank_id',
                'province_id',
                'city_id',
                'alamat',
                'kodepos',
                'nohp',
                'berat',
                'atas_nama',
                'kurir',
                'note',
                'status',
            );
            $product = json_decode($request->product);
            if($request->hasFile('transfer_evidence')){
                $path = $request->file('transfer_evidence')->store('uploads/images/transaction','public');
                $file = File::create([
                    'path' => $path
                ]);
                $file_id = $file->uuid;
            }else{
                $file_id = null;
            }
            $ongkir = Ongkir::create([
                'service' => $request->ongkir,
                'description' => $request->description,
                'cost_value' => $request->cost_value,
                'cost_etd' => $request->cost_etd,
                'cost_note' => $request->cost_note ?? 'kosong'
            ]);
            $input['transfer_evidence'] = $file_id;
            $input['product'] = json_encode($product);
            $input['ongkir_id'] = $ongkir->id;
            if($input['status'] == '3'){
                $input['delivered_on'] = Carbon::now();
            }elseif($input['status'] == '5'){
                $input['canceled_on'] = Carbon::now();
            }else{
                $input['canceled_on'] = null;
                $input['delivered_on'] = Carbon::now();
            }
            $transaksi = Transaction::create($input);
            foreach($product as $p){
                $pv = ProductVariant::where('uuid',$p->product_id)->first();
                $pv->update([
                    'stock' => (int)$pv->stock-(int)$p->amount
                ]);
            }
            return response()->json([
                'success' => true,
                'data' => $transaksi,
                'message' => 'Transaksi Berhasil Disimpan.'
            ]);
        }catch(Exception $x){
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $x->getMessage()
            ]);
        }
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
    public function edit($uuid)
    {
        $product_variants = ProductVariant::with('product')->get();
        $transaction = Transaction::with('user','bank','file_transfer', 'ongkir')->where('uuid',$uuid)->first();
        $banks = Bank::all();
        $users = User::all();
        $provinces = Province::all();
        $cities = City::where('province_id', $transaction->province_id)->get();

        $lokasi = StoreInformation::where('type','lokasi')->first();
        if($lokasi){
            $lokasi->detail = json_decode($lokasi->detail);
        }
        $ongkir = RajaOngkir::ongkosKirim([
            'origin'        => $lokasi->detail->city_id,     // ID kota/kabupaten asal
            'destination'   => $transaction->city_id,      // ID kota/kabupaten tujuan
            'weight'        => $transaction->berat,    // berat barang dalam gram
            'courier'       => $transaction->kurir    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        $costs = $ongkir[0]['costs'];
        return view('admin.transaction.edit', compact('costs','transaction','users','product_variants','banks','provinces', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'uuid' => ['required'],
            'bank_id' => ['required'],
            'province_id' => ['required'],
            'city_id' => ['required'],
            'alamat' => ['required'],
            'kodepos' => ['required'],
            'nohp' => ['required'],
            'berat' => ['required'],
            'atas_nama' => ['required'],
            'kurir' => ['required'],
            'note' => ['required'],
            'status' => ['required'],
        ]);
        $transaksi = Transaction::with('ongkir','file_transfer')->where('uuid',$request->uuid)->first();
        try{
            $input = $request->only(
                'id',
                'user_id',
                'bank_id',
                'province_id',
                'city_id',
                'alamat',
                'kodepos',
                'nohp',
                'berat',
                'atas_nama',
                'kurir',
                'note',
                'status',
            );
            $product = json_decode($request->product);
            if($request->hasFile('transfer_evidence')){
                $path = $request->file('transfer_evidence')->store('uploads/images/transaction','public');
                $file = File::create([
                    'path' => $path
                ]);
                $file_id = $file->uuid;
                if($transaksi->file_transfer != null){
                    Storage::disk('public')->delete($transaksi->file_transfer->path); 
                    File::where('uuid',$transaksi->file_transfer->uuid)->delete();
                }
            }else{
                $file_id = $transaksi->transfer_evidence;
            }
            if($transaksi->ongkir->service != $request->ongkir){
                $ongkir = Ongkir::create([
                    'service' => $request->ongkir,
                    'description' => $request->description,
                    'cost_value' => $request->cost_value,
                    'cost_etd' => $request->cost_etd,
                    'cost_note' => $request->cost_note ?? 'kosong'
                ]);
                Ongkir::where('id',$transaksi->ongkir_id)->delete();
                $ongkir_id = $ongkir->id;
            }else{
                $ongkir_id = $transaksi->ongkir_id;
            }
            $input['transfer_evidence'] = $file_id;
            $input['product'] = json_encode($product);
            $input['ongkir_id'] = $ongkir_id;
            if($input['status'] == '3'){
                $input['delivered_on'] = Carbon::now();
            }elseif($input['status'] == '5'){
                $input['canceled_on'] = Carbon::now();
            }else{
                $input['canceled_on'] = null;
                $input['delivered_on'] = null;
            }
            $transaksi->update($input);
            foreach($transaksi->product as $p){
                $pv = ProductVariant::where('uuid',$p->product_id)->first();
                $pv->update([
                    'stock' => (int)$pv->stock+(int)$p->amount
                ]);
            }
            foreach($product as $p){
                $pv = ProductVariant::where('uuid',$p->product_id)->first();
                $pv->update([
                    'stock' => (int)$pv->stock-(int)$p->amount
                ]);
            }
            return response()->json([
                'success' => true,
                'data' => $transaksi,
                'message' => 'Transaksi Berhasil Diubah.'
            ]);
        }catch(Exception $x){
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $x->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $transaksi = Transaction::with('user','bank','file_transfer', 'ongkir')->where('uuid',$uuid)->first();
        if($transaksi->file_transfer != null){
            Storage::disk('public')->delete($transaksi->file_transfer->path); 
            File::where('uuid',$transaksi->file_transfer->uuid)->delete();
        }
        if($transaksi->ongkir != null){
            Ongkir::where('id',$transaksi->ongkir_id)->delete();
        }
        try {
            $transaksi->delete();
            return response()->json([
                'success' => true,
                'data' => $transaksi,
                'message' => 'Transaksi Berhasil Dihapus.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $x->getMessage()
            ]);
        }
        
    }
    public function user_transaction(){
        $transaction = Transaction::with('bank', 'user' , 'file_transfer')->where('user_id', Auth::user()->uuid)->get();
        foreach ($transaction as $value) {
            $data = array();
            foreach ($value->product as $v) {
                $product_detail = ProductVariant::with('product','file')->where('uuid', $v->product_id)->first();
                $product_detail->amount = $v->amount;
                array_push($data, $product_detail);
            }
            $value->product = json_encode($data);
        }
        $data_transaksi = (object)[
            'n_keranjang' => Cart::where('user_id',Auth::user()->uuid)->count(),
            'n_transaksi' => Transaction::where('status', '!=', 4)->orWhere('status','!=',5)->count(),
            'n_sukses_transaksi' => Transaction::where('status', 4)->count(),
            'n_batal_transaksi' => Transaction::where('status', 5)->count(),
            'transaksi' => $transaction,
        ];
        return view('user.transaction',['data_transaksi'=> $data_transaksi]);
    }
    public function user_transaction_detail($id){
        // $transaction = Transaction::with('bank', 'user', 'file_transfer')->where([['user_id', Auth::user()->uuid],['uuid',$id]])->first();
        $data_transaksi = (object)[
            'n_keranjang' => Cart::where('user_id',Auth::user()->uuid)->count(),
            'n_transaksi' => Transaction::where('status', '!=', 4)->orWhere('status','!=',5)->count(),
            'n_sukses_transaksi' => Transaction::where('status', 4)->count(),
            'n_batal_transaksi' => Transaction::where('status', 5)->count(),
        ];
        $data_transaksi_detail = Transaction::with('bank', 'user', 'file_transfer', 'ongkir')->where([['user_id', Auth::user()->uuid],['uuid',$id]])->first();
        $data = array();
        foreach ($data_transaksi_detail->product as $key => $v) {
            $product_detail = ProductVariant::with('product','file')->where('uuid', $v->product_id)->first();
            $product_detail->amount = $v->amount;
            array_push($data, $product_detail);
        }
        $data_transaksi_detail->product = json_encode($data);
        return view('user.transaction-detail', compact('data_transaksi_detail','data_transaksi'));
    }
    public function user_checkout(){
        $carts = Cart::where('user_id',Auth::user()->uuid)->get();
        $banks = Bank::all();
        $provinces = Province::all();
        return view('user.checkout',compact('carts', 'banks', 'provinces'));
    }
    public function user_checkout_submit(Request $request){
        $input = $request->only(
            'bank_id', 'alamat', 'province_id', 'city_id', 'kodepos', 'nohp', 'kurir', 'note'
        );
        $input['user_id'] = Auth::user()->uuid;
        $input['status'] = 0;
        $input['transfer_evidence'] = null;

        $product_cart = Cart::where('user_id',$input['user_id'])->get();
        $data_product = array();
        foreach($product_cart as $pc){
            $o = (object)[
                "product_id" => $pc->product_varian_id,
                "amount" => $pc->amount
            ];
            array_push($data_product, $o);

            $pv = ProductVariant::where('uuid',$pc->product_varian_id)->first();
            $pv->stock = (int)$pv->stock - (int)$pc->amount;
            $pv->save();
        }
        $input['product'] = json_encode($data_product);
        try {
            $transaction = Transaction::create($input);
            Cart::where('user_id',$input['user_id'])->delete();
            return response()->json([
                'success' => true,
                'data' => $transaction,
                'message' => 'Sukses Melakukan Transaksi'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function count_ongkir(Request $request){
        $request->validate([
            'city_id' => ['required'],
            'berat' => ['required'],
            'kurir' => ['required']
        ]);
        $lokasi = StoreInformation::where('type','lokasi')->first();
        if($lokasi){
            $lokasi->detail = json_decode($lokasi->detail);
        }
        try {
            $ongkir = RajaOngkir::ongkosKirim([
                'origin'        => $lokasi->detail->city_id,     // ID kota/kabupaten asal
                'destination'   => $request->city_id,      // ID kota/kabupaten tujuan
                'weight'        => $request->berat,    // berat barang dalam gram
                'courier'       => $request->kurir    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            ])->get();
            return response()->json([
                'success' => true,
                'data' => $ongkir,
                'message' => 'Sukses Mendapatkan Ongkir'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function upload_pembayaran(Request $request, $id){
        $request->validate([
            'transfer_evidence' => ['required','mimes:jpeg,jpg,png,gif'],
        ]);
        try {
            $transaksi = Transaction::where([['uuid', $id],['user_id', Auth::user()->uuid]])->first();
            $path = $request->file('transfer_evidence')->store('uploads/images/transaction','public');
            $file = File::create([
                'path' => $path
            ]);
            $file_id = $file->uuid;
            if($transaksi->file_transfer != null){
                Storage::disk('public')->delete($transaksi->file_transfer->path);                    
            }
            $transaksi->update([
                'transfer_evidence' => $file_id,
                'status' => 2
            ]);
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back();
        }
    }

    public function konfirmasi_ongkir($id){
        $transaksi = Transaction::where([['uuid', $id],['user_id', Auth::user()->uuid]])->first();
        $transaksi->update([
            'status' => 1
        ]);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\File;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = User::all();
        return view('admin.pengguna',compact('data'));
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
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|min:3|max:1000'
        ]);
        try{
            $path = $request->file('image')->store('uploads/images/users','public');
            $file = File::create([
                'path' => $path
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'password' => $request->password,
                'role' => $request->role,
                'image' => $file->uuid,
            ]);
            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User Berhasil Dimasukkan, mohon konfirmasi email terlebih dahulu agar akun bisa digunakan.'
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'address' => 'required|min:3|max:1000'
        ]);
        $input = $request->only('name','email','address');
        if($request->has('password')){
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $input['password'] = $request->password;
        }
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            ]);
            Storage::disk('public')->delete($user->file->path);
            $path = $request->file('image')->store('uploads/images/users','public');
            $file = File::create([
                'path' => $path
            ]);
            $input['image'] = $file->uuid;
        }
        try{
            $user->update($input);
            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User Berhasil Diubah.'
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $user = User::where('uuid',$uuid)->first();
        try{
            Storage::disk('public')->delete($user->file->path);
            $file_uuid = $user->image;
            $user->delete();
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

    public function index_admin(){
        return view('admin.admin');
    }
    public function get_admin(){
        $data = User::with('file')->where('role','admin')->get();
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses Mendapatkan Data Admin'
        ]);
    }
    public function index_customer(){
        return view('admin.customer');
    }

    public function get_customer(){
        $data = User::with('file')->where('role','customer')->get();
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses Mendapatkan Data Pengguna'
        ]);
    }
}

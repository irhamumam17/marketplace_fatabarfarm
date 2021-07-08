<?php

namespace App\Http\Controllers;

use App\Models\StoreInformation;
use App\Models\Province;
use App\Models\City;
use Illuminate\Http\Request;

class StoreInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'type' => ['required','string'],
            'detail' => ['required']
        ]);
        if ($request->type == 'lokasi') {
           $this->validate($request, [
                'detail.longitude' => ['required','string'],
                'detail.latitude' => ['required','string'],
                'detail.kontak' => ['required','string'],
                'detail.alamat' => ['required','string'],
                'detail.province_id' => ['required'],
                'detail.city_id' => ['required'],
                'detail.waktu_kerja.hari_mulai' => ['required','string'],
                'detail.waktu_kerja.hari_selesai' => ['required','string'],
                'detail.waktu_kerja.waktu_mulai' => ['required','string'],
                'detail.waktu_kerja.waktu_selesai' => ['required','string'],
            ]); 
           $input['detail'] = json_encode($request->detail);
        }else{
            $input['detail'] = $request->detail;
        }
        try {
            $si = StoreInformation::updateOrCreate(
                ['type' => $request->type],
                ['detail' => $input['detail']]
            );
            return response()->json([
                'success' => true,
                'data' => $si,
                'message' => 'Data Berhasil Disimpan.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreInformation  $storeInformation
     * @return \Illuminate\Http\Response
     */
    public function show(StoreInformation $storeInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreInformation  $storeInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreInformation $storeInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreInformation  $storeInformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreInformation $storeInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreInformation  $storeInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreInformation $storeInformation)
    {
        //
    }

    public function user_sejarah(){
        $sejarah = StoreInformation::where('type','sejarah')->first();
        return view('user.sejarah', compact('sejarah'));
    }
    public function user_visi_misi(){
        $visi_misi = StoreInformation::where('type','visi_misi')->first();
        return view('user.visi-misi', compact('visi_misi'));
    }
    public function user_lokasi(){
        $lokasi = StoreInformation::where('type','lokasi')->first();
        if($lokasi){
            $lokasi->detail = json_decode($lokasi->detail);
        }
        return view('user.lokasi', compact('lokasi'));
    }
    public function sejarah(){
        $sejarah = StoreInformation::where('type','sejarah')->first();
        return view('admin.information.sejarah',compact('sejarah'));
    }
    public function visi_misi(){
        $visi_misi = StoreInformation::where('type','visi_misi')->first();
        return view('admin.information.visi_misi',compact('visi_misi'));
    }
    public function lokasi(){
        $lokasi = StoreInformation::where('type','lokasi')->first();
        $provinces = Province::all();
        $cities = null;
        if($lokasi){
            $lokasi->detail = json_decode($lokasi->detail);
            $cities = City::where('province_id',$lokasi->detail->province_id)->get();
        }
        return view('admin.information.lokasi',compact('lokasi', 'provinces', 'cities'));
    }

    public function program(){
        return view('admin.program.index');
    }

    public function get_program(){
        $data = StoreInformation::where('type','program')->get();
        // return $data[0]->detail;
        if(count($data) > 0){
            foreach ($data as $value) {
                $value->detail = json_decode($value->detail);
            }
        }
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Sukses Mendapatkan Data'
        ]);
    }

    public function program_create(){
        return view('admin.program.create');
    }
    public function program_store(Request $request){
        $this->validate($request, [
            'title' => ['required','string'],
            'detail' => ['required']
        ]); 

        $detail = $request->detail;
        $dom = new \DOMDocument();

        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list($type, $data) = explode(',', $data);
            $data = base64_decode($data);
            $image_name= "/uploads/" . time().$k.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', asset($image_name));
        }
        $detail = $dom->saveHTML();
        try {
            $detail_data = (object)[
                "title" => $request->title,
                "content" => $detail
            ];
            $input['detail'] = json_encode($detail_data);
            $input['type'] = 'program';
            $post = StoreInformation::create($input);
            return response()->json([
                'success' => true,
                'data' => $post,
                'message' => 'Program Berhasil Dimasukkan'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function program_edit($id){
        $data = StoreInformation::where([['type','program'],['id',$id]])->first();
        $data->detail = json_decode($data->detail);
        return view('admin.program.edit', compact('data'));
    }

    public function program_update(Request $request ,$id){
        $storeInformation = StoreInformation::where([['type','program'],['id',$id]])->first();
        $this->validate($request, [
            'title' => ['required','string'],
            'detail' => ['required']
        ]); 

        //save new content
        $detail = $request->detail;
        $dom = new \DOMDocument();

        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list($type, $data) = explode(',', $data);
            $data = base64_decode($data);
            $image_name= "/uploads/" . time().$k.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', asset($image_name));
        }
        $detail = $dom->saveHTML();
        //end save new content

        //delete img old content
        $old_detail = json_decode($storeInformation->detail)->content;
        $dom = new \DOMDocument();

        @$dom->loadHtml($old_detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            $data = parse_url($data, PHP_URL_PATH);
            $data = substr($data,1);
            unlink($data);
        }
        //end delete img old content

        try {
            $detail_data = (object)[
                "title" => $request->title,
                "content" => $detail
            ];
            $input['detail'] = json_encode($detail_data);
            $storeInformation->update($input);
            return response()->json([
                'success' => true,
                'data' => $storeInformation,
                'message' => 'Program Berhasil Diubah'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function program_destroy($id){
        $storeInformation = StoreInformation::where([['type','program'],['id',$id]])->first();
        try {
            //delete img old content
            $old_detail = json_decode($storeInformation->detail)->content;
            $dom = new \DOMDocument();

            @$dom->loadHtml($old_detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            foreach($images as $k => $img){
                $data = $img->getAttribute('src');
                $data = parse_url($data, PHP_URL_PATH);
                $data = substr($data,1);
                unlink($data);
            }
            //end delete img old content

            $storeInformation->delete();
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Data Sukses Dihapus'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function user_program_detail($id){
        $program = StoreInformation::where([['type','program'],['id',$id]])->first();
        $program->detail = json_decode($program->detail);
        return view('user.program_detail', compact('program'));
    }
}

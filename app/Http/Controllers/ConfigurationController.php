<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\File;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
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
            'name' => ['required','string'],
        ]);
        if ($request->name == 'ui') {
           $this->validate($request, [
                'app_name' => ['required','string'],
            ]); 
            if($request->hasFile('logo')){
                $this->validate($request, [
                    'logo' => ['required','mimes:jpeg,jpg,png,gif'],
                ]); 
            }
        }elseif ($request->name == 'pusher') {
            $this->validate($request, [
                'content.driver' => ['required','string'],
                'content.app_id' => ['required','string'],
                'content.app_key' => ['required','string'],
                'content.app_secret' => ['required','string'],
                'content.app_cluster' => ['required','string'],
                'content.useTLS' => ['required','string']
            ]); 
        }elseif ($request->name == 'smtp') {
            $this->validate($request, [
                'content.email' => ['required','string'],
                'content.sender_name' => ['required','string'],
                'content.host' => ['required','string'],
                'content.port' => ['required','string'],
                'content.username' => ['required','string'],
                'content.password' => ['required','string'],
                'content.password_confirmation' => ['required','string'],
                'content.encryption' => ['required','string'],
            ]); 
        }
        try {
            if($request->name == 'ui'){
                $config_ui = Configuration::where('name','ui')->first();
                $content = json_decode($config_ui->content);
                if($request->hasFile('logo')){
                    // if($content->logo){
                    //     $logo_file = File::where('uuid',$content->logo)->first();
                    //     Storage::disk('public')->delete($logo_file->path);
                    // }
                    $path = $request->file('logo')->store('uploads/images/configurations','public');
                    $file = File::create([
                        'path' => $path
                    ]);
                    $content->logo = $file->uuid;
                }
                $input = (object)[
                    'app_name' => $request->app_name,
                    'logo' => $content->logo
                ];
            }else{
                $input = $request->content;
            }
            $si = Configuration::updateOrCreate(
                ['name' => $request->name],
                ['content' => json_encode($input)]
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
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function show(Configuration $configuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuration $configuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuration $configuration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
        //
    }

    public function index_ui(){
        $data_ui = Configuration::where('name','ui')->first();
        $data_ui->content = json_decode($data_ui->content);
        $data_ui->content->logo = File::where('uuid',$data_ui->content->logo)->first();
        return view('admin.configuration.ui', compact('data_ui'));
    }

    public function index_pusher(){
        $data_p = Configuration::where('name','pusher')->first();
        $data_p->content = json_decode($data_p->content);
        return view('admin.configuration.pusher', compact('data_p'));
    }

    public function index_smtp(){
        $data_s = Configuration::where('name','smtp')->first();
        $data_s->content = json_decode($data_s->content);
        return view('admin.configuration.smtp', compact('data_s'));
    }
}

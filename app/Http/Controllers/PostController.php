<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as MyFile; 
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
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
            'title' => ['required','string'],
            'detail' => ['required','string'],
            'image' => ['required','mimes:jpeg,jpg,png,gif'],
            'status' => ['required','string'],
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
            $path = $request->file('image')->store('uploads/images/posts','public');
            $file = File::create([
                'path' => $path
            ]);
            $input = $request->only('title','status');
            $input['image'] = $file->uuid;
            $input['content'] = $detail;
            $post = Post::create($input);
            return response()->json([
                'success' => true,
                'data' => $post,
                'message' => 'Post Berhasil Dimasukkan'
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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('uuid',$id)->with('file')->first();
        return view('admin.blog.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::where('uuid',$id)->with('file')->first();
        $this->validate($request,[
            'title' => ['required','string'],
            'content' => ['required','string'],
            'status' => ['required','string'],
        ]);
        //save new content
        $content = $request->content;
        $dom = new \DOMDocument();

        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            $count_data = explode(';', $data);
            if(count($count_data) > 1){
                list($type, $data) = explode(';', $data);
                list($type, $data) = explode(',', $data);
                $data = base64_decode($data);
            }
            $image_name= "/uploads/" . time().$k.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', asset($image_name));
        }
        $content = $dom->saveHTML();
        //end save new content

        //delete img old content
        $old_detail = $post->content;
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
            $input = $request->only('title','status');
            if($request->hasFile('image')){
                $request->validate([
                    'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
                ]);
                Storage::disk('public')->delete($post->file->path);
                $path = $request->file('image')->store('uploads/images/posts','public');
                $file = File::create([
                    'path' => $path
                ]);
                $input['image'] = $file->uuid;
            }
            $input['content'] = $content;
            $post->update($input);
            return response()->json([
                'success' => true,
                'data' => $post,
                'message' => 'Post Berhasil Diubah'
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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        try {
            //delete img old content
            $old_detail = $post->content;
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

            //delete old img
            Storage::disk('public')->delete($post->file->path);
            //end delete old img

            $file_uuid = $post->image;
            $post->delete();
            File::where('uuid',$file_uuid)->delete();
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

    public function get_blog(){
        $data = Post::with('file')->get();
        return ([
            'data' => $data,
            'message' => 'Berhasil mendapatkan data',
            'success' => true
        ]);
    }

    public function user_blog(){
        $post = Post::orderBy('created_at','DESC')->get();
        return view('user.blog', ['posts' => $post]);
    }
    public function user_blog_detail($id){
        $post = Post::where('uuid',$id)->with('file')->first();
        return view('user.blog-detail',compact('post'));
    }
}

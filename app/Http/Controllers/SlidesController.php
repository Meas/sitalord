<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Intervention\Image\ImageManager;
use Image;
use App\Picture;
use DB;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->admin==1)
        {
            return view('slides.index');
        }
        else
        {
            flash()->error('You do not have the privilege to do that!');
            return redirect ('articles');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function gallery_upload()  
    {

        $img = Image::make('img/forest.jpg')->fit(1920, 640);
        $img->save('img/123.jpg');
        return $img->response('jpg');

        return view('slides.gallery_upload');
    }
      public function upload(Request $request, $id)  
    {   
        /*dd($request->fileInput);*/
        $file=$request->fileInput;
        $img = Image::make($file)->fit(1920, 640);
        $filename  = time() . rand(00000,99999) . '.' . $file->extension();
        Picture::create(['name'=>$filename, 'gallery'=>'0']);
        $img->save('img/'.$filename);
        $pic_id=DB::table('pictures')->where('name', $filename)->first();
        DB::table('picture_slider')->where('slider_id', $id)->update(array('picture_name' => $filename));
        flash()->success('Image successfuly uploaded');
        return redirect('slides');
    }
      public function slide_select($id)  
    {
        
        return view('slides.slide_select',compact('id'));
    }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

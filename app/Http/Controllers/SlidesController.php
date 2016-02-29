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

    public function select_from_gallery($id)  
    {
        $pictures=Picture::get();
        return view('slides.select_from_gallery',compact('id','pictures'));
    }
      public function upload(Request $request, $id)  
    {   
        if (Auth::user()->admin==1)
        {
            $file=$request->fileInput;
            $img = Image::make($file)->fit(1920, 640);
            $img_thumb=Image::make($file)->fit(480,160);

            $filename  = time() . rand(00000,99999) . '.' . $file->extension();
            Picture::create(['name'=>$filename, 'gallery'=>'0']);
            Picture::create(['name'=>'300_' . $filename, 'gallery'=>'0']);

            $img->save('img/'.$filename);
            $img_thumb->save('img/'.'300_'.$filename);

            $pic_id=DB::table('pictures')->where('name', $filename)->first();
            DB::table('picture_slider')->where('slider_id', $id)->update(array('picture_name' => $filename));
            flash()->success('Image successfuly uploaded');
            return redirect('slides');
        }
        else
        {
            flash()->error('You do not have the privilege to do that!');
            return redirect ('articles');
        }
    }
      public function slide_select($id)  
    {
        if (Auth::user()->admin==1)
        {
            return view('slides.slide_select',compact('id'));
        }
        else
        {
            flash()->error('You do not have the privilege to do that!');
            return redirect ('articles');
        }
    }
    public function change(Request $request, $id)
    {

        $pic_name=substr($request->select, 4);
        DB::table('picture_slider')->where('slider_id', $id)->update(array('picture_name' => $pic_name));
        flash()->success('Slide'.$id.' successufly changed!');
        return redirect ('slides');

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

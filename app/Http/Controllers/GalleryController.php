<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Image;
use App\Picture;
use Storage;
use File;
use Auth;

class GalleryController extends Controller
{
    public function index() {
    	$pictures=Picture::where('gallery', '1')->latest('updated_at')->get();
    	return view('gallery.index',compact('pictures'));
    }
    public function upload(Request $request) {

        if(Auth::user()->admin==1)
        {
    	 	$file=$request->fileInput;
            $img = Image::make($file)->fit(1920, 1080);
            $img_thumb=Image::make($file)->fit(480,270);

            $filename  = time() . rand(00000,99999) . '.' . $file->extension();
            $pic=Picture::create(['name'=>$filename, 'gallery'=>'1']);

            $img->save('img/'.$filename);
            $img_thumb->save('img/'. '300_' . $filename);

            flash()->success('Image added to gallery!');
        }
        else
        {
            flash()->error('You do not have the priviledge to upload pictures');
        }
        return redirect('gallery');
        
    }
    public function destroy($id) {
        if(Auth::user()->admin==1)
        {
            $pic=Picture::findorfail($id);
            File::delete('img/'.$pic->name);
            File::delete('img/300_'.$pic->name);
            $pic->delete();           
            flash()->warning('Picture has been deleted!');
        }
        else {
            flash()->error('You do not have the priviledge to do that');
        }
        return redirect('gallery');
        
    }


}

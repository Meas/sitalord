<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Doc;
use File;
use Auth;

class DocsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $docs=Doc::latest('created_at')->get();
        return view('docs.index',compact('docs'));
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
    public function upload(Request $request)
    {
        $file=$request->fileInput;
        $filename  = time() . rand(00000,99999) . '.' . $file->extension();
        $originalName=$file->getClientOriginalName();
        Doc::create(['name' => $filename, 'originalName' => $originalName]);
        $file->move('docs/', $filename);
        flash()->success('Document has been uploaded!');
        return redirect ('documents');
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
        if(Auth::user()->admin==1)
        {
            $doc=Doc::findorfail($id);
            File::delete('docs/'.$doc->name);
            $doc->delete();           
            flash()->warning('Document has been deleted!');
        }
        else {
            flash()->error('You do not have the priviledge to do that');
        }
        return redirect ('documents');
    }
}

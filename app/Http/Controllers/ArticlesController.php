<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Image;

use App\Picture;
use App\Article;


class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $articles= Article::latest('published_at')->published()->get();
        $pictures=Picture::get();
        $slides=DB::table('picture_slider')->get();
        return view('articles.index',compact('articles','slides','pictures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->admin==1)
        {
            return view('articles.create');
        }
        else
        {
            flash()->error('You do not have the privilege to create an article!');
            return redirect ('articles');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        
        $article = Auth::user()->articles()->create($request->all());
        if ($request->fileInput) 
        {
            $file=$request->fileInput;
            $img = Image::make($file)->fit(1920, 640);
            $img_thumb=Image::make($file)->fit(480,160);

            $filename  = time() . rand(00000,99999) . '.' . $file->extension();
            $pic=Picture::create(['name'=>$filename, 'gallery'=>'0']);
            $pic_thumb=Picture::create(['name'=>'300_' . $filename, 'gallery'=>'0']);

            $img->save('img/'.$filename);
            $img_thumb->save('img/'. '300_' . $filename);

            $article->pictures()->attach($pic);
            $article->pictures()->attach($pic_thumb);
            DB::table('article_picture')->where('article_id', $article->id)->update(array('main' => 1));
        }

        flash()->success('Your article has been created!');
        return redirect('articles');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findorfail($id);
        $pictures=Picture::get();
        $has_pic=0;
        $admin=0;
        if(Auth::guest())
        {
            //
        }
        elseif (Auth::user()->admin==1)
        {
            $admin=1;
        }
        return view('articles.show',compact('article','admin','pictures','has_pic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $user=Auth::user();
        if ($user->id == $article->user_id)
        {
            return view('articles.edit', compact('article'));
        }
        else 
        {
            flash()->error('You do not have the permission to edit the article!'); 
            return redirect('articles/show/'.$id);
        }
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
        $article = Article::findOrFail($id);
        $article->update($request->all());

        if ($request->fileInput)
        {
            $file=$request->fileInput;
            $img = Image::make($file)->fit(1920, 640);
            $img_thumb=Image::make($file)->fit(480,160);

            $filename  = time() . rand(00000,99999) . '.' . $file->extension();
            $pic=Picture::create(['name'=>$filename, 'gallery'=>'0']);
            $pic_thumb=Picture::create(['name'=>'300_' . $filename, 'gallery'=>'0']);

            $img->save('img/'.$filename);
            $img_thumb->save('img/'. '300_' . $filename);
            dd($article->pictures());
            $article->pictures()->sync(array('picture_id' => $pic->id))->first();
            $article->pictures()->sync(array('picture_id' => $pic_thumb->id))->second();
            DB::table('article_picture')->where('article_id', $article->id)->update(array('main' => 1));
        }
        flash()->success('Your article has been updated!');
        return redirect('articles');
    }

    public function myarticles()
    {
        if (Auth::guest() || Auth::user()->admin==0)
        {
            flash()->error('You do not have any articles!');
            return redirect('articles');
        }
        else 
        {
            $pictures=Picture::get();
            $articles= Auth::user()->articles()->latest('published_at')->published()->get();
            return view('articles.index',compact('articles', 'pictures'));
        }


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

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
        $slides=DB::table('picture_slider')->get();
        return view('articles.index',compact('articles','slides'));
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
        $file=$request->fileInput;
        $article = Auth::user()->articles()->create($request->all());
        $img = Image::make($file)->fit(1920, 640);
        $filename  = time() . rand(00000,99999) . '.' . $file->extension();
        $pic=Picture::create(['name'=>$filename, 'gallery'=>'0']);
        $img->save('img/'.$filename);

        $article->pictures()->attach($pic);
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
        $admin=0;
        if(Auth::guest())
        {
            //
        }
        elseif (Auth::user()->admin==1)
        {
            $admin=1;
        }
        return view('articles.show',compact('article','admin','pictures'));
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
            $articles= Auth::user()->articles()->latest('published_at')->published()->get();

            return view('articles.index',compact('articles'));
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

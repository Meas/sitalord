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
use File;

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
        $this->middleware('auth', ['except' => ['index', 'show','all']]);
    }

    public function index()
    {
        $articles= Article::latest('created_at')->published()->paginate(5);
        $pictures=Picture::get();
       /* $aaa=Picture::with('articles');
        /*dd($aaa);
        dd($pictures->articles());

        foreach($pictures as $aaaa){echo $aaaa->id;}
        return;
        dd($pictures);
        $slidess=collect(DB::table('article_picture')->select()->get());

        dd($slidess->article_id);*/
        $slides=Picture::has('articles')->latest('created_at')->take(3)->get();
        $textslides=DB::table('textslides')->first();
        
      
        return view('articles.index',compact('articles','slides','pictures','textslides'));
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

            $img->save('img/'.$filename);
            $img_thumb->save('img/'. '300_' . $filename);

            $article->pictures()->attach($pic);

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
        return view('articles.show',compact('article','admin','pictures','has_pic','id'));
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


            $img->save('img/'.$filename);
            $img_thumb->save('img/'. '300_' . $filename);

            $article->pictures()->sync(array('picture_id' => $pic->id));
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
            $articles= Auth::user()->articles()->latest('created_at')->paginate(5);
            return view('articles.index',compact('articles', 'pictures'));
        }


    }
    public function all() 
    {
        $pictures=Picture::get();
        $articles= Article::latest('created_at')->published()->paginate(5);
        return view('articles.index', compact('articles', 'pictures'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if (Auth::guest() || Auth::user()->admin==0)
        {
            flash()->error('You do not have the privilege to do that!');  
        }
        else
        {
            $article=Article::findorfail($id);
            $pic=$article->pictures()->get();
            File::delete('img/'.$pic[0]->name);
            File::delete('img/300_'.$pic[0]->name);
            $article->delete();
            $pic[0]->delete();
            flash()->warning('Article deleted!');
        }
        return redirect('articles');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Auth;

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

        return view('articles.index',compact('articles'));
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
        $admin=0;
        if(Auth::guest())
        {

        }
        elseif (Auth::user()->admin==1)
        {
            $admin=1;
        }
        return view('articles.show',compact('article','admin'));
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

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use  Illuminate\Validation\Validator;
use App\Models\Article;
use Inertia\Inertia;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Article/Index',['user' => Auth::user(),'articles' => Article::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Article/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
             'title' => ['required','string'],
             'content' => ['required'],
        ]);

        $user = Auth::user()->name;
        $article =new Article();

        $article->title = $request['title'];
        $article->content = $request['content'];
        $article->auth = $user;

        $article->save();

        return Redirect::route('Article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return Inertia::render('Article/Show',['article' =>$article,'comments'=> $article->comments()->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request,$id)
    {
        return Inertia::render('Article/Edit',['article' => Article::find($id)]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
             'title' => ['required','string'],
             'content' => ['required'],
        ]);

        $article = Article::find($id);

        $article->title = $request['title'];
        $article->content = $request['content'];

        $article->save();

        return Redirect::route('Article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return Redirect::route('Article.index');
    }
}

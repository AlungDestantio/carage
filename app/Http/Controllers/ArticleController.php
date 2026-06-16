<?php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published()->with('author')->latest('published_at');

        if ($request->filled('cari')) {
            $query->where('title', 'like', '%'.$request->cari.'%');
        }

        $articles = $query->paginate(9)->withQueryString();
        return view('articles.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $related = Article::published()->where('id', '!=', $article->id)->latest('published_at')->take(3)->get();

        return view('articles.show', compact('article', 'related'));
    }
}
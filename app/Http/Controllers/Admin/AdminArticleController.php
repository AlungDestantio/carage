<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author')->latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:200',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'status'  => 'required|in:draft,published',
            'image'   => 'nullable|image|max:2048',
        ]);
        $data['user_id']      = auth()->id();
        $data['slug']         = Str::slug($data['title']);
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit(Article $artikel)
    {
        return view('admin.articles.edit', compact('artikel'));
    }

    public function update(Request $request, Article $artikel)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:200',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'status'  => 'required|in:draft,published',
            'image'   => 'nullable|image|max:2048',
        ]);
        if ($data['status'] === 'published' && !$artikel->published_at) {
            $data['published_at'] = now();
        }
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }
        $artikel->update($data);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $artikel)
    {
        $artikel->delete();
        return back()->with('success', 'Artikel berhasil dihapus!');
    }
}

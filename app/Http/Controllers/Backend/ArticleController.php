<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        return view('backend.article.article',[
        'articles'=> Article::with('Category')->latest()->get()]);
    }

    // public function table()
    // {
    //     $data = Article::paginate(10); // Ganti dengan logika pengambilan data Anda
    //     return view('article', compact('data'));   
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validasi input
         $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable',
            'desc' => 'required|string',
            'img' => 'nullable|image|file|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string',
            'publish_date' => 'required|string',
        ]);

        // Handle upload gambar jika ada
        if ($request->hasFile('img')) {
            $img = $request->file('img')->store('img', 'public');
        } else {
            $img = null;
        }

        // Membuat artikel baru
        $article = new Article;
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article['slug'] = Str::slug($article['name']);
        $article->desc = $request->desc;
        $article->img = $img;
        $article->status = $request->status;
        $article->publish_date = $request->publish_date;
        $article->save();
        
        return redirect()->route('article.index')->with('success', 'Article added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        return view('backend.article.detail', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::get();
        return view('backend.article.update',compact('article','categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable',
            'desc' => 'required|string',
            'img' => 'nullable|image|file|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string',
            'publish_date' => 'required|string',
        ]);

        // Handle upload gambar jika ada
        // if ($request->hasFile('img')) {
        //     $img = $request->file('img')->store('img', 'public');
        // } else {
        //     $img = null;
        // }

        // Membuat artikel baru
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->desc = $request->input('desc');
        $article->status = $request->input('status');
        $article->publish_date = $request->input('publish_date');
        $article->category()->associate($request->input('category_id'));
        $article['slug'] = Str::slug($article['name']);

        if ($request->hasFile('img')) {
            // Hapus gambar lama jika ada
            if ($article->img) {
                Storage::delete('public/' . $article->img);
            }
    
            // Simpan gambar baru
            $path = $request->file('img')->store('img', 'public');
            $article->img = $path;
        }
    
        $article->save();
        return redirect()->route('article.index')->with('success', 'Article Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
    
        // Opsi: Jika ingin menghapus artikel dan sekaligus hapus kategori jika tidak ada artikel lain yang terkait
        // if ($article->category->articles()->count() === 1) {
        //     $article->category->delete();
        // }
    
        $article->delete();
    
        return redirect()->route('article.index')->with('success', 'Article deleted successfully');
    }
        
}

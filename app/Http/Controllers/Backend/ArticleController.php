<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
    
    public function __construct()
    {
        $this->middleware('auth');
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
    public function store(ArticleRequest $request)
    {
        // Handle upload gambar jika ada
        if ($request->hasFile('img')) {
            $img = $request->file('img')->store('img', 'public');
        } else {
            $img = null;
        }
        

        // Membuat artikel baru
        $article = Article::create($request->validated());
        
        return redirect()->route('article.index',$article->slug)->with('success', 'Article added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $article = Article::where('slug',$slug)->findOrFail();
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
    public function update(ArticleUpdateRequest $request, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->update($request->validated());

        // Handle upload gambar jika ada
        // if ($request->hasFile('img')) {
        //     $img = $request->file('img')->store('img', 'public');
        // } else {
        //     $img = null;
        // }
        $article->update($request->validated());
        if ($request->hasFile('img')) {
            // Hapus gambar lama jika ada
            if ($article->img) {
                Storage::delete('public/' . $article->img);
            }
    
            // Simpan gambar baru
            $path = $request->file('img')->store('img', 'public');
            $article->img = $path;
        }
       
        return redirect()->route('article.index',$article->slug)->with('success', 'Article Update successfully');
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;
    protected $fillable =['category_id','title','slug','desc','img','view','status','publish_date'];

    //Relasi ke kategori

    public function Category():BelongsTo{
        return $this->belongsTo(Category::class);
    }
    
    public function index()
    {
        $data = Article::paginate(10); // Ganti dengan logika pengambilan data Anda
        return view('article', compact('data'));
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $article->slug = Str::slug($article->title);
        });

        static::updating(function ($article) {
            $article->slug = Str::slug($article->title);
        });
    }
}

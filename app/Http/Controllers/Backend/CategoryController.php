<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('backend.dashboard.category',[
        //     'categories' => Category::orderBy('id','desc')->get() // categories disini berfungsi untuk memanggil di forech sebagai array di blade category
        // ]);
        // atau

        return view('backend.category.category',[
            'categories' => Category::latest()->get()
             // categories disini berfungsi untuk memanggil di forech sebagai array di blade category
        ]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    // public function table()
    // {
    //     $data = Category::paginate(10); // Ganti dengan logika pengambilan data Anda
    //     return view('category', compact('data'));   
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|min:3'
            ]);

        $data['slug'] = Str::slug($data['name']);

        Category::create($data);

        return back()->with('success', 'Category has been create');
        
        // dd('oke');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|min:3'
            ]);

        $data['slug'] = Str::slug($data['name']);

        Category::find($id)->update($data);

        return back()->with('success', 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();

        return back()->with('success', 'Category has been Deleted');
    }
}

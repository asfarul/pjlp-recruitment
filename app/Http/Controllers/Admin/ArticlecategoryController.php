<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArtCatRequest;
use App\Models\Articlecategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ArticlecategoryController extends Controller
{
    // Only Authenticated User have access to Dashboard
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Articlecategory::all();

        return view('admin.articlecats.cat_list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articlecats.cat_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtCatRequest $request)
    {
        $category = new Articlecategory();
        $category->category = $request->input('category');
        $category->description = $request->input('description');
        $category->save();

        Toastr::success('Berhasil menambahkan kategori artikel');
        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Articlecategory::findOrFail($id);

        return view('admin.articlecats.cat_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArtCatRequest $request, $id)
    {
        $category = Articlecategory::findOrFail($id);
        $category->category = $request->input('category');
        $category->description = $request->input('description');
        $category->save();

        Toastr::success('Berhasil mengubah kategori artikel');
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Articlecategory::findOrFail($id);
        $category->delete();

        Toastr::success('Berhasil menghapus data');
        return redirect()->route('kategori.index');
    }
}

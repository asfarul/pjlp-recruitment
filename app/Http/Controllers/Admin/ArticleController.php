<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Articlecategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::select('articles.*', 'articlecategories.category')
            ->join('articlecategories', 'articlecategories.id', '=', 'articles.category_id')->orderBy('articles.created_at', 'DESC')
            ->get();

        return view('admin.articles.article_list', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Articlecategory::pluck('category', 'id');
        $statusList = ['PUBLISHED', 'DRAFT'];
        return view('admin.articles.article_create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->category_id = $request->input('category_id');
        if ($request->has('image_header')) {
            $image = $request->file('image_header');
            $name = 'image-header_' . time();
            $folder = '/artikel/' . time() . '/';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $article->image_header = $filePath;
        }
        $article->content = $request->input('content');
        $article->status = $request->input('status');
        $article->publish_at =  $request->publish_at != null ? date('Y-m-d', strtotime(strtr($request->input('publish_at'), '/', '-'))) : null;
        $article->save();

        Toastr::success('Berhasil menambahkan artikel');
        return redirect()->route('artikel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Articlecategory::pluck('category', 'id');

        return view('admin.articles.article_edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->category_id = $request->input('category_id');
        if ($request->has('image_header')) {
            $image = $request->file('image_header');
            $name = 'image-header_' . $request->input('title');
            $folder = '/artikel/' . $request->input('title') . '/';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            if ($article->image_header != '' && File::exists('uploads/' . $folder . $name))
                File::delete('uploads/' . $folder . $name);
            $this->uploadOne($image, $folder, 'public', $name);
            $article->image_header = $filePath;
        }
        $article->status = $request->input('status');
        $article->publish_at = $request->publish_at != null ? date('Y-m-d', strtotime(strtr($request->input('publish_at'), '/', '-'))) : null;
        $article->content = $request->input('content');
        $article->save();

        Toastr::success('Berhasil mengubah artikel artikel');
        return redirect()->route('artikel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        Toastr::success('Berhasil menghapus data');
        return redirect()->route('artikel.index');
    }
}

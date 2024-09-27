<?php

namespace App\Http\Controllers;
use App\Models\Article;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        $article = Article::with('scategories') ->get() ->toArray();
        $res = array_reverse($article);
        return response()->json($res);
    }
    public function store(Request $request){
        $article = new Article();
        $article->designation= $request->input('designation');
        $article->marque= $request->input('marque');
        $article->reference= $request->input('reference');
        $article->qtestock= $request->input('qtestock');
        $article->prix= $request->input('prix');
        $article->imageart= $request->input('imageart');
        $article->scategorieID= $request->input('scategorieID');
        $article->save();
        return response()->json($article);
    }
    public function show($id){
        $article= Article::find($id);
        return response()->json($article);
    }
    public function update($id, Request $request){
        $article = Article::find($id);
        $article->update($request->all());
        return response()->json($article);
        }
    public function destroy($id){
        $article = Article::find($id);
        $article->delete();
        return response()->json(['message' => 'Article deleted successfully']);
    }

    public function showArticlesPagination(Request $request){
        $filtre = $request->input('filtre', '');
        $page = $request->input('page', 1);
        $pageSize = $request->input('pageSize', 10);
        $query = Article::where('designation', 'like', '%' . $filtre . '%')
            ->with('scategories')
            ->orderBy('id', 'desc');

        $totalArticles = $query->count();
        $articles = $query->skip(($page - 1) * $pageSize)
            ->take($pageSize)
            ->get();

            $totalPages = ceil($totalArticles / $pageSize);

        return response()->json([
            'products' => $articles,
            'totalPages' => $totalPages,
        ]);
    }
    public function paginationPaginate(){
        $perPage = request()->input('pageSize', 2);

        $filterDesignation = request()->input('filtre');

        $query = Article::with('scategories');
        if ($filterDesignation) {
            $query->where('designation', 'like', '%' . $filterDesignation .
            '%');
        }
        $articles = $query->paginate($perPage);

        return response()->json([
            'products' => $articles->items(),
            'totalPages' => $articles->lastPage(), ]);
    }

}

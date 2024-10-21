<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index() {
        $categories = Categorie::all()->toArray();
        return array_reverse($categories);
    }
    public function store(Request $request) {
        $categorie = new Categorie([
            'nomcategorie' => $request->input('nomcategorie'),
            'imagecategorie' => $request->input('imagecategorie')
        ]);
        $categorie->save();
        return response()->json('Catégorie créée !');
    }
    public function show($id) {
        try{
        $categorie = Categorie::findOrFail($id);
        return response()->json($categorie);
    }catch (\Exception $e){
        return response()->json("impossible de recupérer ");
    }
    }
    public function update(Request $request, $id) {
        $categorie = Categorie::findOrFail($id);
        $categorie->update($request->all());
        return response()->json('Catégorie MAJ !');
    } public function destroy($id) {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return response()->json('Catégorie supprimée !');
    }
    public function showcategoriePagination(Request $request)
    {
        $filtre = $request->input('filtre', '');
        $page = (int) $request->input('page', 1);
        $pageSize = (int) $request->input('pageSize', 10);
        $query = Categorie::where('nomcategorie', 'like', '%' . $filtre . '%')
            ->orderBy('id', 'desc');

        $totalcategorie = $query->count();
        $categorie = $query->skip(($page - 1) * $pageSize)
            ->take($pageSize)
            ->get();

        $totalPages = ceil($totalcategorie / $pageSize);

        return response()->json([
            'products' => $categorie,
            'totalPages' => $totalPages,
        ]);
    }
    public function paginationPaginate()
    {
        $perPage = request()->input('pageSize', 2);

        $filterDesignation = request()->input('filtre');

        $query = Categorie::with('categories');
        if ($filterDesignation) {
            $query->where('nomcategorie', 'like', '%' . $filterDesignation . '%');
        }
        $categorie = $query->paginate($perPage);

        return response()->json([
            'products' => $categorie->items(),
            'totalPages' => $categorie->lastPage(),
        ]);
    }
}

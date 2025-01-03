<?php
use App\Http\Controllers\CategorieController;

use App\Http\Controllers\ScategorieController;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\StripeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::resource('categories', CategorieController::class, );
});
Route::middleware('api')->group(function () {
    Route::resource('scategories', ScategorieController::class);
});
Route::middleware('api')->group(function () {
    Route::resource('articles', ArticleController::class);
});


Route::get('/articles/art/pagination', [
    ArticleController::class,
    'showArticlesPagination'
]);
Route::get('/articles/art/paginationPaginate', [
    ArticleController::class,
    'paginationPaginate'
]);
Route::get('/scategories/scat/pagination', [
    ScategorieController::class,
    'showScategoriePagination'
]);
Route::get('/scategories/scat/paginationPaginate', [
    ScategorieController::class,
    'paginationPaginate'
]);
Route::get('/categories/cat/pagination', [
    CategorieController::class,
    'showcategoriePagination'
]);
Route::get('/categories/cat/paginationPaginate', [
    CategorieController::class,
    'paginationPaginate'
]);

/**Route::get('/categories', [CategorieController::class, 'index']);
Route::post('/categories', [CategorieController::class, 'store']);
Route::get('/categories/{id}', [CategorieController::class, 'show']);
Route::delete('/categories/{id}', [CategorieController::class, 'destroy']);
Route::put('/categories/{id}', [CategorieController::class, 'update']);
 */

Route::get('/scat/{idcat}', [ScategorieController::class, 'showSCategorieByCAT']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'payment'
], function ($router) {
    Route::post('/processpayment', [StripeController::class, 'processpayment']);
});


<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'crawler'], function() {
    // manga
    Route::group(['prefix' => 'manga'], function() {
        Route::get('/', 'Manga\MangaController@index')->name('manga.index');

        Route::get('/add-manga', 'Manga\MangaController@addManga')->name('manga.add');
        Route::post('/add-manga', 'Manga\MangaController@saveManga')->name('manga.save');

        Route::get('/my-manga', 'Manga\MangaController@myManga')->name('manga.my');
        Route::get('/{slug}', 'Manga\MangaController@show')->name('manga.show');
        Route::get('/{slug}/chapter/{chapter}', 'Manga\MangaController@read');
        Route::get('/{slug}/scrape', 'Manga\MangaController@scrape');
    });

    // anime
    Route::group(['prefix' => 'anime'], function() {
        Route::get('/', 'Anime\AnimeController@index')->name('anime.index');
        Route::post('/', 'Anime\AnimeController@save')->name('anime.save');
    });

    // promo
    Route::group(['prefix' => 'promo'], function() {
        Route::get('/', 'Promo\PromoController@index')->name('promo.index');
        Route::get('/{slug}', 'Promo\PromoController@show')->name('promo.show');
    });
});
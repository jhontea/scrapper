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
    $crawler = Goutte::request('GET', 'https://www.komikgue.com/manga/nanatsu-no-taizai/255/1');
    $img = trim($crawler->filter('#ppp > a > img')->attr('src'));
    $name = $crawler->filter('#ppp > a > img')->attr('alt');
    $filename = basename($img);
    //Image::make($img)->save(public_path('img/manga/' . $filename));
    // $imgs = $crawler->filter('#all > img')->each(function ($node) {
    //     $node->attr('data-src')."<br>";
    // });
    return view('welcome');
});

Route::group(['prefix' => 'crawler'], function() {
    //manga
    Route::group(['prefix' => 'manga'], function() {
        Route::get('/', 'Manga\MangaController@index')->name('manga.index');

        Route::get('/add-manga', 'Manga\MangaController@addManga')->name('manga.add');
        Route::post('/add-manga', 'Manga\MangaController@saveManga')->name('manga.save');

        Route::get('/my-manga', 'Manga\MangaController@myManga')->name('manga.my');
        Route::get('/{slug}', 'Manga\MangaController@show')->name('manga.show');
        Route::get('/{slug}/chapter/{chapter}', 'Manga\MangaController@read');
        Route::get('/{slug}/scrape', 'Manga\MangaController@scrape');
    });
});
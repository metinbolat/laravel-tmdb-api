<?php

use Illuminate\Support\Facades\Route;

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

//Sitemaps
Route::get('sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('get.sitemap');
Route::get('/sitemap.xml/movies', [App\Http\Controllers\SitemapController::class, 'movies']);
Route::get('/sitemap.xml/genres', [App\Http\Controllers\SitemapController::class, 'genres']);
Route::get('/sitemap.xml/tags', [App\Http\Controllers\SitemapController::class, 'tags']);
Route::get('/sitemap.xml/casts', [App\Http\Controllers\SitemapController::class, 'casts']);

//Frontend Routes
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('front.welcome');
Route::post('/search', [App\Http\Controllers\WelcomeController::class, 'search'])->name('front.search');
Route::get('/iletisim', [App\Http\Controllers\WelcomeController::class, 'contactForm'])->name('front.contact');
Route::post('/iletisim', [App\Http\Controllers\WelcomeController::class, 'contactFormSubmit'])->name('front.contact.submit');
Route::post('/hata-bildir/{movie}', [App\Http\Controllers\WelcomeController::class, 'errorFormSubmit'])->name('front.error.submit');


//Movie
Route::get('/filmler', [App\Http\Controllers\Front\MovieController::class, 'movies'])->name('front.movie.index');
Route::get('/filmler/{slug}', [App\Http\Controllers\Front\MovieController::class, 'show'])->name('front.movie.show');
//Route::post('/filmler/{slug}/yorum-yap', [App\Http\Controllers\Front\MovieController::class, 'comment_store'])->name('front.comment.store');
Route::post('/filmler/{slug}/yanitla', [App\Http\Controllers\Front\MovieController::class, 'reply_store'])->name('front.reply.store');
Route::get('/en-cok-izlenen-filmler', [App\Http\Controllers\Front\MovieController::class, 'favoriteMovies_index'])->name('front.favorite.index');
//Genre
Route::get('/kategori/{genre:slug}', [App\Http\Controllers\WelcomeController::class, 'genre_index'])->name('front.genre.index');
//Cast
Route::get('/oyuncu/{cast:slug}', [App\Http\Controllers\WelcomeController::class, 'cast_index'])->name('front.cast.index');
//Tag
Route::get('/etiket/{tag:slug}', [App\Http\Controllers\WelcomeController::class, 'tag_index'])->name('front.tag.index');

//TV
Route::get('/diziler', [App\Http\Controllers\Front\TvController::class, 'tvshows'])->name('front.tv.index');
Route::get('/diziler/{slug}', [App\Http\Controllers\Front\TvController::class, 'show'])->name('front.tv.show');
Route::get('/dizi-izle/{episode:slug}', [App\Http\Controllers\Front\TvController::class, 'episode'])->name('front.episode.show');


//Frontend Auth Routes
Route::get('/front/oturum-ac', [App\Http\Controllers\Auth\LoginController::class, 'FrontLogin'])->name('front.user.login');
Route::get('/front/kayit-ol', [App\Http\Controllers\Auth\LoginController::class, 'FrontRegister'])->name('front.user.register');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Backend Routes
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('back.dashboard');

    //Genre
    Route::get('kategoriler', App\Http\Livewire\Admin\Genre\Index::class)->name('back.genre.index');
//    Route::get('kategoriler/oluştur', [App\Http\Controllers\Admin\GenreController::class, 'create'])->name('back.genre.create');
//    Route::post('kategoriler/oluştur', [App\Http\Controllers\Admin\GenreController::class, 'store'])->name('back.genre.add');

    //Movie
    Route::get('filmler', App\Http\Livewire\Admin\Movie\Index::class)->name('back.movie.index');
    Route::get('filmler/{movie}/duzenle', [App\Http\Controllers\Admin\MovieController::class, 'edit'])->name('back.movie.edit');
    Route::post('filmler/{movie}/duzenle', [App\Http\Controllers\Admin\MovieController::class, 'update'])->name('back.movie.update');

    //TvShow
    Route::get('diziler', App\Http\Livewire\Admin\TvShow\Index::class)->name('back.tv.index');
    Route::get('diziler/{tvshow}/duzenle', [App\Http\Controllers\Admin\MovieController::class, 'edit'])->name('back.tv.edit');
    Route::post('diziler/{tvshow}/duzenle', [App\Http\Controllers\Admin\MovieController::class, 'update'])->name('back.tv.update');

    //Cast
    Route::get('oyuncular', App\Http\Livewire\Admin\Cast\Index::class)->name('back.cast.index');

    //Tag
    Route::get('etiketler', App\Http\Livewire\Admin\Tag\Index::class)->name('back.tag.index');

    //Settings
    Route::get('ayarlar', [App\Http\Controllers\Admin\SettingsController::class, 'view'])->name('back.settings.view');
    Route::post('ayarlar', [App\Http\Controllers\Admin\SettingsController::class, 'updateGeneralSettings'])->name('back.settings.update');
    Route::post('ayarlar/logo', [App\Http\Controllers\Admin\SettingsController::class, 'changeSiteLogo'])->name('back.logo.update');
    Route::post('ayarlar/favicon', [App\Http\Controllers\Admin\SettingsController::class, 'changeSiteFavicon'])->name('back.favicon.update');

    //Comments
    Route::get('yorumlar', App\Http\Livewire\Admin\Comment\Index::class)->name('back.comments.index');
});

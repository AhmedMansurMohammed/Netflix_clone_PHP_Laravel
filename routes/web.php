<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediasController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PeoplesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Models\People;

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


Route::redirect('/', '/login');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Logout route
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [RegisterController::class, 'registerUser'])->name('register.submit');

// Other routes
Route::get('/subscription', function () {
    return view('subscription');
})->name('subscription');

// forgot password
Route::get('/forgotPassword', function () {
    return view('forgot-password');
});

Route::post('/forgotPassword', [ForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword.submit');

Route::get('/seed', [MediasController::class, 'seed'])->name('seed');

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [MediasController::class, 'getAllMedias'])->name('home');

    Route::get('/movies', [MediasController::class, 'getMediaListWithGenre'])->name('movies');
    Route::get('/series', [MediasController::class, 'getMediaListWithGenre'])->name('series');
    Route::get('/movies/{id?}', [MediasController::class, 'getMediaListWithGenre'])->name('movieByGenre');
    Route::get('/series/{id?}', [MediasController::class, 'getMediaListWithGenre'])->name('serieByGenre');


    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::put('/update-profile', [ProfileController::class, 'update'])->name('update.profile');
    Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscription.subscribe');
    Route::get('/search', [MediasController::class, 'search'])->name('search');
    Route::get('/favorite', [FavoriteController::class, 'favorite'])->name('favorites');


    Route::get('/detail/{id?}', [MediasController::class, 'seeDetail'])->name('detail');

    //like
    Route::post('/like', [FavoriteController::class, 'like'])->name('like-media');
    
    // Route::controller(StripePaymentController::class)->group(function () {
    //     Route::get('stripe', 'stripe');
    //     Route::post('stripe', 'stripePost')->name('stripe.post');
    // });
});

//route para vip
Route::group(['middleware'=>['auth','check.subscription']],function () {
    Route::get('/detail/video/{id?}', [EpisodesController::class, 'seeVideo'])->name('video');
});

// Routes for admin
Route::group(['middleware' => ['auth', 'check.admin']], function () {

    Route::redirect('/admin', '/admin/movieList');
    //list
    Route::get('/admin/movieList', [MediasController::class, 'getMovieList'])->name('admin.movieList');
    Route::get('/admin/serieList', [MediasController::class, 'getSerieList'])->name('admin.serieList');
    Route::get('/admin/genreList', [GenresController::class, 'getGenreList'])->name('admin.genreList');
    Route::get('/admin/countryList', [CountriesController::class, 'getCountryList'])->name('admin.countryList');
    Route::get('/admin/peopleList', [PeoplesController::class, 'getPeopleList'])->name('admin.peopleList');
    Route::get('/admin/episodeList/{id?}', [EpisodesController::class, 'getEpisodeList'])->name('admin.episodeList');

    //create form
    Route::get('/newMedia', [MediasController::class, 'getNewForm'])->name('admin.new');
    Route::get('/newEpisode/{id?}', [EpisodesController::class, 'getNewEpisodeForm'])->name('admin.new.episode');
    Route::get('/editMedia/{id?}', [MediasController::class, 'getEditForm'])->name('admin.edit.media');
    Route::get('/editEpisode/{id?}', [EpisodesController::class, 'getEpisodeEditForm'])->name('admin.edit.episode');

    //insert or update
    Route::post('/insert/media', [MediasController::class, 'newMedia'])->name('media.insert');
    Route::post('/insert/episode', [EpisodesController::class, 'newEpisode'])->name('media.insert.episode');
    Route::post('/newGenre', [GenresController::class, 'newGenre'])->name('admin.new.genre');
    Route::post('/newCountry', [CountriesController::class, 'newCountry'])->name('admin.new.country');
    Route::post('/newPeople', [PeoplesController::class, 'newPeople'])->name('admin.new.people');

    //delete
    Route::get('/deleteMedia/{id?}', [MediasController::class, 'deleteMedia'])->name('admin.delete.media');
    Route::get('/deleteGenre/{id?}', [GenresController::class, 'deleteGenre'])->name('admin.delete.genre');
    Route::get('/deleteCountry/{id?}', [CountriesController::class, 'deleteCountry'])->name('admin.delete.country');
    Route::get('/deletePeople/{id?}', [PeoplesController::class, 'deletePeople'])->name('admin.delete.people');
    Route::get('/deleteEpisode/{id?}', [EpisodesController::class, 'deleteEpisode'])->name('admin.delete.episode');



});









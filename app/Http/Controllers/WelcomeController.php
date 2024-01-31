<?php

namespace App\Http\Controllers;

use App\Models\{Cast, Contact, Genre, Movie, Tag, User};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    protected Collection $genres;
    private string $adminEmail;

    public function __construct()
    {
        $this->genres = Genre::all();
        $this->adminEmail = User::where('role', 1)->first()->email;
    }
    public function index (): View
    {
        $title = "Anasayfa";
        $sliderMovies = Movie::where('is_public', 1)->where('rating', '>', 8)->orderBy('rating', 'desc')->get();
        $newMovies = Movie::where('is_public', 1)->orderBy('created_at', 'desc')->paginate(6);
        return view('front.welcome', ['sliderMovies' => $sliderMovies, 'newMovies' => $newMovies, 'title' => $title,]);
    }


    public function search (Request $request): View
    {
        $title = "Arama: ". $request->search;
        $movies = Movie::search('title', $request->search)->where('is_public', 1)->orderBy('title', 'asc')->paginate(6);
        return view('front.movies', ['movies' => $movies, 'title' => $title, 'genres' => $this->genres,]);
    }

    public function genre_index (Genre $genre): View
    {
        $title = $genre->name. " Filmleri";
        $movies = $genre->movies()->where('is_public', 1)->orderBy('title', 'asc')->paginate(6);
        return view('front.movies', ['movies' => $movies, 'title' => $title, 'genres' => $this->genres,]);
    }

    public function cast_index (Cast $cast): View
    {
        $title = $cast->name. " Filmleri";
        $movies = $cast->movies()->where('is_public', 1)->orderBy('title', 'asc')->paginate(6);
        return view('front.movies', ['movies' => $movies, 'title' => $title, 'genres' => $this->genres,]);
    }

    public function tag_index (Tag $tag): View
    {
        $title = $tag->tag_name;
        $movies = $tag->movies()->where('is_public', 1)->orderBy('title', 'asc')->paginate(6);
        return view('front.movies', ['movies' => $movies, 'title' => $title, 'genres' => $this->genres,]);
    }

    public function contactForm(): View
    {
        $title = 'İletişim';
        return view('front.contact', ['title' => $title,]);
    }

    public function contactFormSubmit(Request $request): RedirectResponse
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        Contact::create($request->all());
        Mail::send('front.mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_query' => $request->get('message'),
        ), function($message) use ($request){
            $message->from('info@filmdiziplus.club');
            $message->to($this->adminEmail, 'Admin')->subject(config('app.name') . ' İletişim Formu');
        });
        return redirect()->back()->with('status', 'Form başarıyla gönderildi! En kısa sürede dönüş yapılacaktır');
    }

    public function errorFormSubmit($id, Request $request): RedirectResponse
    {
        $movie = Movie::findorFail($id);
        $this->validate($request, [
            'error' => 'required'
        ]);
        $errorMail = Mail::send('front.error-mail', array(
            'movie' => $movie->title,
            'url' => $movie->slug,
            'user_query' => $request->get('error'),
        ), function($message) use ($request){
            $message->from('info@filmdiziplus.club');
            $message->to($this->adminEmail, 'Admin')->subject(config('app.name') . ' Hata Bildirimi');
        });
        if ($errorMail) {
            return redirect()->back()->with('status', 'Hata bildirimi başarıyla gönderildi');
        } else {
            return redirect()->back()->with('error', 'Hata bildirimi gönderilemedi');
        }
    }
}

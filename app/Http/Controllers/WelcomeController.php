<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Contact;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WelcomeController extends Controller
{
    public function index ()
    {
        $title = "Anasayfa";
        $sliderMovies = Movie::where('is_public', 1)->where('rating', '>', 8)->orderBy('rating', 'desc')->get();
        $newMovies = Movie::where('is_public', 1)->orderBy('created_at', 'desc')->paginate(6);
        return view('front.welcome', compact('sliderMovies', 'newMovies', 'title'));
    }


    public function search (Request $request)
    {
        $genres = Genre::all();
        $title = "Arama: ". $request->search;
        $moviesSearch = Cast::search('name', $request->search)->orderBy('name', 'asc');
        $genresSearch = Genre::search('name', $request->search)->where('status', '0')->orderBy('name', 'asc');
        $movies = Movie::search('title', $request->search)->where('is_public', 1)->orderBy('title', 'asc')->union($genresSearch);
//        dd($movies);
        return view('front.movies', compact('movies', 'title', 'genres'));
    }

    public function genre_index (Genre $genre)
    {
        $genres = Genre::all();
        $title = $genre->name. " Filmleri";
        $movies = $genre->movies()->where('is_public', 1)->orderBy('title', 'asc')->paginate(6);
        return view('front.movies', compact('movies', 'title', 'genres'));
    }

    public function cast_index (Cast $cast)
    {
        $genres = Genre::all();
        $title = $cast->name. " Filmleri";
        $movies = $cast->movies()->where('is_public', 1)->orderBy('title', 'asc')->paginate(6);
        return view('front.movies', compact('movies', 'title', 'genres'));
    }

    public function tag_index (Tag $tag)
    {
        $genres = Genre::all();
        $title = $tag->tag_name;
        $movies = $tag->movies()->where('is_public', 1)->orderBy('title', 'asc')->paginate(6);
        return view('front.movies', compact('movies', 'title', 'genres'));
    }

    public function contactForm()
    {
        $title = 'İletişim';
        return view('front.contact', compact('title'));
    }

    public function contactFormSubmit(Request $request)
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
            $message->to('betdiyari@gmail.com', 'Admin')->subject('Filmdiziplus İletişim Formu');
        });
        return redirect()->back()->with('status', 'Form başarıyla gönderildi! En kısa sürede dönüş yapılacaktır');
    }

    public function errorFormSubmit($id, Request $request)
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
            $message->to('betdiyari@gmail.com', 'Admin')->subject('Filmdiziplus Hata Bildirimi');
        });
        if ($errorMail) {
            return redirect()->back()->with('status', 'Hata bildirimi başarıyla gönderildi');
        } else {
            return redirect()->back()->with('error', 'Hata bildirimi gönderilemedi');
        }
    }
}

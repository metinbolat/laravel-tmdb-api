<section class="section section--bg" data-bg="{{asset('assets/front/')}}img/section/section.jpg">
    <div class="container">
        <div class="row">
            <!-- section title -->
            <div class="col-12">
                <h2 class="section__title">En Çok İzlenenler</h2>
            </div>
            <!-- end section title -->

            @foreach($favoriteMovies as $favoriteMovie)
                <!-- card -->
                <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="https://image.tmdb.org/t/p/w500{{$favoriteMovie->poster_path}}" alt="{{$favoriteMovie->title}} izle">
                            <a href="{{route('front.movie.show', $favoriteMovie->slug)}}" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="{{route('front.movie.show', $favoriteMovie->slug)}}">{{$favoriteMovie->title}}</a></h3>
                            <span class="card__category">
                                @foreach($favoriteMovie->genres as $fmGenre)
                                    <a href="#">{{$fmGenre->name}}</a>
                                @endforeach
                            </span>
                            <span class="card__rate"><i class="icon ion-ios-star"></i>{{$favoriteMovie->rating}}</span>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            @endforeach

            <!-- section btn -->
            <div class="col-12">
                <a href="{{route('front.favorite.index')}}" class="section__btn">Daha Fazla ...</a>
            </div>
            <!-- end section btn -->
        </div>
    </div>
</section>

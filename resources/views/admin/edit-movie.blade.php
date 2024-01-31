@extends('layouts.admin')
@section('content')
    @push('style')
        <link rel="stylesheet" href="{{asset('assets/select2/select2.min.css')}}">
    @endpush
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Filmler
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Film Detay
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile"
                                    aria-selected="false">SEO
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab">
                            <form action="{{route('back.movie.update', $movie->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="title">Film Adı:</label>
                                            <input id="title" type="text" class="form-control"
                                                   value="{{ $movie->title }}" name="title">
                                            @error('title')
                                            <small class="text-danger"> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="runtime">Süre:</label>
                                            <input id="runtime" type="text" class="form-control"
                                                   value="{{ $movie->runtime }}" name="runtime">
                                            @error('runtime')
                                            <small class="text-danger"> {{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="slug">Url:</label>
                                            <input id="slug" type="text" class="form-control"
                                                   value="{{ $movie->slug }}" name="slug">
                                            @error('slug')
                                            <small class="text-danger"> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="language">Dil:</label>
                                            <input id="language" type="text" class="form-control"
                                                   value="{{ $movie->lang }}" name="language">
                                            @error('language')
                                            <small class="text-danger"> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="year">Yapım Yılı:</label>
                                            <input id="year" type="text" class="form-control"
                                                   value="{{ $movie->release_date}}" name="year">
                                            @error('language')
                                            <small class="text-danger"> {{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="country">Ülke:</label>
                                            <input id="country" type="text" class="form-control"
                                                   value="{{ $movie->country }}" name="country">
                                            @error('country')
                                            <small class="text-danger"> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="rating">Puan:</label>
                                            <input id="rating" type="text" class="form-control"
                                                   value="{{ $movie->rating }}" name="rating">
                                            @error('rating')
                                            <small class="text-danger"> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="is_public">Durum:</label><br/>
                                            <select class="form-select" name="is_public" id="is_public">
                                                <option {{$movie->is_public == 1 ?
                                                'selected' : ''}} value="1">Yayımlanmış
                                                </option>
                                                <option {{$movie->is_public == 0 ?
                                                'selected' : ''}} value="0">Taslak
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="poster_path">Poster:</label>
                                            <input id="poster_path" type="text" class="form-control"
                                                   value="{{ $movie->poster_path }}" name="poster_path">
                                            @error('poster_path')
                                            <small class="text-danger"> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="backdrop_path">Backdrop:</label>
                                            <input id="backdrop_path" type="text" class="form-control"
                                                   value="{{ $movie->backdrop_path }}" name="backdrop_path">
                                            @error('backdrop_path')
                                            <small class="text-danger"> {{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="overview">Açıklama:</label>
                                            <textarea id="overview" rows="3" name="overview"
                                                      class="form-control lh-sm border border-primary">{{ $movie->overview }}</textarea>
                                            @error('overview')
                                            <small class="text-danger"> {{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="tags">Etiketler:</label>
                                            <select id="tags" class="form-control select2" name="tags[]"
                                                    multiple="multiple">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}" @foreach ($movie->tags as $movieTag)
                                                        @if ($movieTag->id == $tag->id)
                                                            selected
                                                        @endif @endforeach>
                                                        {{ $tag->tag_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('tags')
                                            <small class="text-danger"> {{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="genres">Kategoriler:</label>
                                            <select id="genres" class="form-control select2" name="genres[]" multiple="multiple">
                                                @foreach ($genres as $genre)
                                                    <option value="{{ $genre->id }}"
                                                            @foreach ($movie->genres as $movieGenre)
                                                                @if ($movieGenre->id == $genre->id)
                                                                    selected
                                                        @endif @endforeach>
                                                        {{ $genre->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                             aria-labelledby="pills-profile-tab">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="meta">Meta</label>
                                        <textarea id="meta" rows="3" name="meta"
                                                  class="form-control lh-sm border border-primary">{{$movie->meta}}</textarea>
                                        @error('meta')
                                        <small class="text-danger"> {{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="source">Kaynak</label>
                                        <textarea id="source" rows="3" name="source"
                                                  class="form-control lh-sm border border-primary">{{$movie->source}}</textarea>
                                        @error('source')
                                        <small class="text-danger"> {{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary">Kaydet</button>
                    </div>
                    </form>

                    <div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function () {
                $('.select2').select2({
                    tags: true,
                    placeholder: "Bir öğe seçin",
                    language: {
                        noResults: function () {
                            return "Sonuç bulunamadı";
                        }
                    },
                })
            });
        </script>
        <script src="{{asset('assets/select2/select2.min.js')}}"></script>
    @endpush
@endsection

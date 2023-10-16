@extends('layouts.admin')
@section('content')
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
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Film Detay</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Etiketler & SEO</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
                            data-bs-target="#pills-profile2" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Etiketler</button>
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
                                        <label>Film Adı:</label>
                                        <input type="text" wire:model.defer="title" class="form-control"
                                            value="{{ $movie->title }}" name="title">
                                        @error('title')
                                        <small class="text-danger"> {{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Süre:</label>
                                        <input type="text" wire:model.defer="runtime" class="form-control"
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
                                        <label>Url:</label>
                                        <input type="text" wire:model.defer="slug" class="form-control"
                                            value="{{ $movie->slug }}" name="slug">
                                        @error('slug')
                                        <small class="text-danger"> {{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label>Dil:</label>
                                        <input type="text" wire:model.defer="language" class="form-control"
                                            value="{{ $movie->lang }}" name="language">
                                        @error('language')
                                        <small class="text-danger"> {{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label>Yapım Yılı:</label>
                                        <input type="text" wire:model.defer="language" class="form-control"
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
                                        <label>Ülke:</label>
                                        <input type="text" wire:model.defer="format" class="form-control"
                                            value="{{ $movie->country }}" name="country">
                                        @error('format')
                                        <small class="text-danger"> {{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label>Puan:</label>
                                        <input type="text" wire:model.defer="rating" class="form-control"
                                            value="{{ $movie->rating }}" name="rating">
                                        @error('rating')
                                        <small class="text-danger"> {{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label>Durum:</label><br />
                                        <select class="form-select" name="status" id="status">
                                            <option {{$movie->is_public == 1 ?
                                                'selected' : ''}} value="1">Yayımlanmış</option>
                                            <option {{$movie->is_public == 0 ?
                                                'selected' : ''}} value="0">Taslak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Poster:</label>
                                        <input type="text" wire:model.defer="poster" class="form-control"
                                            value="{{ $movie->poster_path }}" name="poster">
                                        @error('poster')
                                        <small class="text-danger"> {{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Backdrop:</label>
                                        <input type="text" wire:model.defer="backdrop" class="form-control"
                                            value="{{ $movie->backdrop_path }}" name="backdrop">
                                        @error('backdrop')
                                        <small class="text-danger"> {{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Açıklama:</label>
                                        <textarea rows="3" wire:model.defer="overview" name="overview"
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
                                        <label>Etiketler:</label>
                                        <select class="form-control select2" name="tags[]" multiple="multiple">
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
                                        <label>Kategoriler:</label>
                                        <select class="form-control select2" name="genres[]" multiple="multiple">
                                            @foreach ($genres as $genre)
                                            <option value="{{ $genre->id }}" @foreach ($movie->genres as $movieGenre)
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
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Meta</label>
                                    <textarea rows="3" wire:model.defer="meta" name="meta"
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
                                    <label>Kaynak</label>
                                    <textarea rows="3" name="source"
                                        class="form-control lh-sm border border-primary">{{$movie->source}}</textarea>
                                    @error('source')
                                    <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile2" role="tabpanel" aria-labelledby="pills-profile-tab2">

                        ...
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
    $(document).ready(function() {
                $('.select2').select2({
                    tags: true,
                    placeholder: "Etiket seçin",
                })
            });
</script>
@endpush
@endsection

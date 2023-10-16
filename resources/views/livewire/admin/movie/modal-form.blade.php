<!-- Bulk Update Modal -->
<div wire:ignore.self class="modal fade" id="UpdateMovieModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Film Düzenle</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal"
                    aria-label="Kapat"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Yükleniyor...</span>
                </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateMovies">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Durum</label><br />
                                    <input type="checkbox" wire:model.defer="status" style="width: 20px; height: 20px;">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Update Movie Modal -->
<div wire:ignore.self class="modal fade" id="UpdateMovieModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Film Düzenle</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal"
                    aria-label="Kapat"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Yükleniyor...</span>
                </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateMovie">
                    <div class="modal-body">

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Film Detay</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false">Etiketler & SEO</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Film Adı</label>
                                            <input type="text" wire:model.defer="title" class="form-control">
                                            @error('title') <small class="text-danger"> {{$message}}</small> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label>Süre</label>
                                            <input type="text" wire:model.defer="runtime" class="form-control">
                                            @error('runtime')<small class="text-danger"> {{$message}}</small> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Url</label>
                                            <input type="text" wire:model.defer="slug" class="form-control">
                                            @error('slug')<small class="text-danger"> {{$message}}</small> @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Dil</label>
                                            <input type="text" wire:model.defer="language" class="form-control">
                                            @error('language')<small class="text-danger"> {{$message}}</small> @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label>Durum</label><br />
                                            <input type="checkbox" wire:model.defer="status"
                                                style="width: 20px; height: 20px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Format</label>
                                            <input type="text" wire:model.defer="format" class="form-control">
                                            @error('format')<small class="text-danger"> {{$message}}</small> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label>Rating</label>
                                            <input type="text" wire:model.defer="rating" class="form-control">
                                            @error('rating')<small class="text-danger"> {{$message}}</small> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Poster</label>
                                            <input type="text" wire:model.defer="poster" class="form-control">
                                            @error('poster')<small class="text-danger"> {{$message}}</small> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label>Backdrop</label>
                                            <input type="text" wire:model.defer="backdrop" class="form-control">
                                            @error('backdrop')<small class="text-danger"> {{$message}}</small> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Overview</label>
                                            <textarea rows="3" wire:model.defer="overview" name="overview"
                                                class="form-control lh-sm border border-primary"></textarea>
                                            @error('overview')<small class="text-danger"> {{$message}}</small> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Etiketler</label>
                                    <input type="text" name="movie_tags" class="form-control">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                @if($movie)
                                <livewire:admin.tag.movie-tag :movie="$movie" />
                                @endif
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Meta</label>
                                            <textarea rows="3" wire:model.defer="meta" name="meta"
                                                class="form-control lh-sm border border-primary"></textarea>
                                            @error('meta')<small class="text-danger"> {{$message}}</small> @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Show Trailer Modal -->
<div wire:ignore.self class="modal fade" id="ShowTrailerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Fragman Ekle</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal"
                    aria-label="Kapat"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div> Yükleniyor...
            </div>
            <div wire:loading.remove>
                @if($movie)
                @foreach($movie->trailers as $trailer)
                <button wire:click="deleteTrailer({{$trailer->id}})" type="button"
                    class="btn btn-outline-danger ms-2 mt-2" data-bs-dismiss="modal"><span
                        class="btn-close me-1"></span> {{$trailer->name}}</button>
                @endforeach
                @endif
                <form wire:submit.prevent="addTrailer">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Fragman Kaynak</label>
                            <input type="text" wire:model.defer="trailerName" class="form-control">
                            @error('trailerName')<small id="error" class="text-danger"> {{$message}}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Embed HTML</label>
                            <textarea rows="3" wire:model.defer="embedHtml" name="embedHtml"
                                class="form-control lh-sm"></textarea>
                            @error('embedHtml')<small class="text-danger"> {{$message}}</small> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Movie Search Results Modal -->
<div wire:ignore.self class="modal fade" id="SearcResultsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Fragman Ekle</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal"
                    aria-label="Kapat"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div> Yükleniyor...
            </div>
            <div wire:loading.remove>
                @if(session('bot-status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('bot-status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session('bot-error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('bot-error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="row">
                    <div class="row row-cols-4 row-cols-md-4 g-3 my-3 mx-0">
                        @forelse($searchResults as $result)
                        <div class="col">
                            <div class="card h-100">
                                @if($result['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w500{{$result['poster_path']}}"
                                    class="card-img-top">
                                @else
                                <img src="https://placehold.co/300x450?text=Poster+Yok&font=roboto"
                                    class="card-img-top">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{$result['title']}} ({{date('Y',
                                        strtotime($result['release_date']))}})</h5>
                                    <button class="btn btn-sm btn-success float-end"
                                        wire:click="generateMovie({{$result_id = $result['id']}})">Seç</button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>Aramanızla eşleşen film bulunamadı.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


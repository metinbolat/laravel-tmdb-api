<div>
    @include('livewire.admin.tv-show.modal-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Diziler

                        <form class="row g-3 float-end needs-validation">
                            <div class="col-auto">
                                <input placeholder="TMDB Dizi Ara" wire:model.defer="tvTMDB" type="text"
                                       class="form-control form-control-sm @error('tvTMDB') is-invalid @enderror">
                            </div>
                            <div class="col-auto">
                                <button data-bs-toggle="modal" data-bs-target="#SeriesSearcResultsModal"
                                        wire:click="searchResults" type="button" class="btn btn-sm btn-primary">Ara
                                </button>
                            </div>
                        </form>
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
                    <div class="table-responsive">
                        <form class="row g-3 mb-2">
                            <div class="col-auto">
                                <label for="search" class="visually-hidden">Arama</label>
                                <input wire:model.debounce.500ms="search" type="search"
                                       class="form-control form-control-sm" id="search" placeholder="İsme göre ara">
                            </div>

                            <div class="col-auto">
                                <select wire:model="perPage" class="form-select form-select-sm"
                                        aria-label="Default select example">
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                </select>

                            </div>
                            @if($checked)

                                <div class="col-auto">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                id="actionMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Seçilenler ({{count($checked)}})
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="actionMenuButton">
                                            <li><a class="dropdown-item" href="#"
                                                   onclick="confirm('Seçilen kayıtları silmek istiyor musunuz?') || event.stopImmediatePropagation()"
                                                   wire:click="destroyTvShows()">Sil</a></li>
                                            <li><a wire:click="bulkUpdate()" data-bs-toggle="modal"
                                                   data-bs-target="#BulkUpdateModal" class="dropdown-item"
                                                   href="#">Düzenle</a></li>
                                        </ul>
                                    </div>
                                </div>
                        </form>
                        @endif
                        <div style="{{$bulkUpdate}}">
                            <form class="row row-cols-lg-auto g-3 align-items-center">
                                <div class="col-12">
                                    <select class="form-select" wire:model="status" id="status">
                                        <option>Durum Seçin</option>
                                        <option value="0">Taslak</option>
                                        <option value="1">Yayımlanmış</option>
                                    </select>
                                </div>
                                @error('status')<small class="text-danger"> {{$message}}</small> @enderror
                                <div class="col-12">
                                    <button role="button" wire:click="updateMovies"
                                            class="btn btn-success">Kaydet
                                    </button>
                                </div>
                            </form>
                        </div>
                        @if($selectAll)
                            <div class=" col-md-10">
                                @if ($selectAllDB)
                                    <div>
                                        <strong>{{$tvshows->total()}}</strong> satırın tamamını seçtiniz.
                                    </div>
                                @elseif(count($checked) < $tvshows->total())

                                    <div>
                                        <strong>{{count($checked)}}</strong> satır seçtiniz.
                                        <strong>{{$tvshows->total()}}</strong> satırın <a class="text-primary" href="#"
                                                                                          wire:click="selectAllDB">tamamını
                                            seç</a>.
                                    </div>

                                @endif
                            </div>
                        @endif
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>

                                <th width="50"><input wire:model="selectAll" type="checkbox"
                                                      class="form-check-input" style="width: 18px; height:18px"></th>
                                <th wire:click="sortByColumn('name')" role="button">
                                    Dizi Adı
                                    @if($sortColumn == 'name' && $sortDirection == 'desc')
                                        <i class="mdi mdi-arrow-down text-secondary"></i>
                                    @elseif($sortColumn == 'name' && $sortDirection == 'asc')
                                        <i class="mdi mdi-arrow-up text-secondary"> </i>
                                    @endif
                                </th>
                                <th> Sezon Sayısı</th>
                                <th> Başlangıç - Bitiş</th>
                                <th>Durum</th>
                                <th>Görünürlük</th>
                                <th>Poster</th>
                                <th colspan="3" class="text-center">Eylemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tvshows as $tvshow)
                                <tr class="@if($this->isChecked($tvshow->id))
                                    table-primary
                                    @endif">
                                    <td><input wire:model="checked" value="{{$tvshow->id}}" type="checkbox"
                                               class="form-check-input" style="width: 18px; height:18px">
                                    </td>
                                    <td>{{$tvshow->name}}</td>
                                    <td>
                                        {{count($tvshow->seasons)}}
                                    </td>
                                    <td> {{$tvshow->first_aired}} - {{$tvshow->last_aired}} </td>
                                    <td>{{$tvshow->status}}</td>
                                    {{--                                    <td>{{date('H:i', mktime(0, $tvshows->status))}}</td>--}}
                                    <td>@if($tvshow->is_public)
                                            <span class="badge bg-success">Açık</span>
                                        @else
                                            <span class="badge bg-secondary">Gizli</span>
                                        @endif
                                    </td>
                                    <td>
                                        <img
                                            src="https://www.themoviedb.org/t/p/w220_and_h330_face{{$tvshow->poster_path}}"
                                            class="rounded" style="width: 40px; height: 40px;">
                                    </td>
                                    <td style="border-right: none;" width="50px;">
                                        <a href="#" wire:click="showTrailer({{$tvshow->id}})" data-bs-toggle="modal"
                                           data-bs-target="#ShowTrailerModal"
                                           class="btn btn-sm btn-primary">Fragman</a>
                                    </td>
                                    <td style="border-right: none;" width="50px;">
                                        <a href="{{route('back.movie.edit', $tvshow->id)}}"
                                           class="btn btn-sm btn-success">Düzenle</a>
                                    </td>
                                    <td style="border-left: none;" width="50px;">
                                        <a href="#" wire:click="destroyTvShow({{$tvshow->id}})" role="button"
                                           onclick="confirm('Silmek istediğinizden emin misiniz?') || event.stopImmediatePropagation()"
                                           class="btn btn-sm btn-danger ms-2">Sil</a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Hiç dizi bulunamadı.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{$tvshows->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {

            $('#AddMovieModal').modal('hide');
            $('#UpdateMovieModal').modal('hide');
            $('#DeleteMovieModal').modal('hide');
            $('#ShowTrailerModal').modal('hide');
            $('#BulkUpdateModal').modal('hide');
        });
    </script>
@endpush

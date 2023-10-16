<div>
    @include('livewire.admin.genre.modal-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Kategoriler
{{--                        <form class="row g-3 float-end needs-validation">--}}
{{--                            <div class="col-auto">--}}
{{--                                <input placeholder="TMDB Film id" wire:model="genreTMDBId" wire:model.defer="genre_id" type="text" class="form-control form-control-sm @error('tmdb_id') is-invalid @enderror"  placeholder="">--}}
{{--                            </div>--}}
{{--                            <div class="col-auto">--}}
{{--                                <button wire:click="storeGenre" type="button" class="btn btn-sm btn-primary">Film Ekle</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}

                            <a href="#" data-bs-toggle="modal" data-bs-target="#AddGenreModal"
                               class="btn btn-success btn-sm float-end">Kategori Ekle</a>
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
                            <form class="row g-3">
                                <div class="col-auto">
                                    <label for="search" class="visually-hidden">Arama</label>
                                    <input wire:model="search" type="search" class="form-control form-control-sm" id="search" placeholder="Başlığa göre ara">
                                </div>
                                <div class="col-auto">
                                    <select wire:model="sort" class="form-select form-select-sm" aria-label="Default select example">
                                        <option value="asc">A-Z</option>
                                        <option value="desc">Z-A</option>
                                    </select>

                                </div>
                                <div class="col-auto">
                                    <select wire:model="perPage" class="form-select form-select-sm" aria-label="Default select example">
                                       <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>

                                </div>
                                <div class="col-auto">
                                    <button wire:click="resetFilters" type="button" class="btn btn-sm btn-secondary mb-3">Filtreleri Temizle</button>
                                </div>
                            </form>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Url</th>
                                    <th>Yayın Durumu</th>
                                    <th colspan="2" class="text-center">Eylemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($genres as $genre)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$genre->name}}</td>
                                        <td>{{$genre->slug}}</td>
                                        <td>{{$genre->status == '1' ? 'Yayınlanmış' : 'Yayınlanmamış'}}</td>
                                        <td style="border-right: none;" width="50px;">
                                            <a href="#" wire:click="editGenre({{$genre->id, $genre->tmdb_id}})" data-bs-toggle="modal" data-bs-target="#UpdateGenreModal" class="btn btn-sm btn-success">Düzenle</a>

                                        </td>
                                        <td style="border-left: none;" width="50px;">
                                            <a href="#" wire:click="deleteGenre({{$genre->id}})" data-bs-toggle="modal" data-bs-target="#DeleteGenreModal" class="btn btn-sm btn-danger ms-2">Sil</a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Hiç kategori bulunamadı.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{$genres->links()}}
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

            $('#AddGenreModal').modal('hide');
            $('#UpdateGenreModal').modal('hide');
            $('#DeleteGenreModal').modal('hide');
        });
        $(document).ready(function() {
            $('#example').DataTable();
        } );

    </script>
@endpush

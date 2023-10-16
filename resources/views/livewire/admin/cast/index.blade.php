<div>
    @include('livewire.admin.cast.modal-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Oyuncular
                        <form class="row g-3 float-end needs-validation">
                            <div class="col-md-6">
                                <input placeholder="TMDB oyuncu id" wire:model="castTMDBId" wire:model.defer="tmdb_id" type="text" class="form-control form-control-sm @error('tmdb_id') is-invalid @enderror"  placeholder="">
                            </div>
                            <div class="col-md-6">
                                <button wire:click="generateCast" type="button" class="btn btn-primary">Oyuncu Ekle</button>
                            </div>
                        </form>
                </div>
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
                                <input wire:model="search" type="search" class="form-control form-control-sm" id="search" placeholder="İsme göre ara">
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
                                <th>#</th>
                                <th>Oyuncu</th>
                                <th>Url</th>
                                <th>Afiş Url</th>
                                <th colspan="2" class="text-center">Eylemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($casts as $cast)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$cast->name}}</td>
                                    <td>{{$cast->slug}}</td>
                                    <td><img src="https://image.tmdb.org/t/p/w500/{{$cast->poster_path}}" class="rounded" style="width: 40px; height: 40px;"></td>
                                    <td style="border-right: none;" width="50px;">
                                        <a href="#" wire:click="editCast({{$cast->id}})" data-bs-toggle="modal" data-bs-target="#UpdateCastModal" class="btn btn-sm btn-success">Düzenle</a>
                                    </td>
                                    <td style="border-left: none;" width="50px;">
                                        <a href="#" wire:click="deleteCast({{$cast->id}})" data-bs-toggle="modal" data-bs-target="#DeleteCastModal" class="btn btn-sm btn-danger ms-2">Sil</a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Hiç oyuncu bulunamadı.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{$casts->links()}}
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

            $('#AddCastModal').modal('hide');
            $('#UpdateCastModal').modal('hide');
            $('#DeleteCastModal').modal('hide');
        });

    </script>
@endpush

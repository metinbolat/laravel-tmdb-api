<div>
    <div>
        @include('livewire.admin.tag.modal-form')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Etiketler
                            <a href="#" data-bs-toggle="modal" data-bs-target="#AddTagModal"
                               class="btn btn-primary btn-sm float-end">Etiket Ekle</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
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
                                    <th>#</th>
                                    <th>Etiket</th>
                                    <th>Url</th>
                                    <th colspan="2" class="text-center">Eylemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($tags as $tag)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$tag->tag_name}}</td>
                                        <td>{{$tag->slug}}</td>
                                        <td style="border-right: none;" width="50px;">
                                            <a href="#" wire:click="editTag({{$tag->id}})" data-bs-toggle="modal" data-bs-target="#UpdateTagModal" class="btn btn-sm btn-success">Düzenle</a>
                                        </td>
                                        <td style="border-left: none;" width="50px;">
                                            <a href="#" wire:click="deleteTag({{$tag->id}})" data-bs-toggle="modal" data-bs-target="#DeleteTagModal" class="btn btn-sm btn-danger ms-2">Sil</a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Hiç etiket bulunamadı.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{$tags->links()}}
                            </div>
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            window.addEventListener('close-modal', event => {

                $('#AddTagModal').modal('hide');
                $('#UpdateTagModal').modal('hide');
                $('#DeleteTagModal').modal('hide');
            });

        </script>
    @endpush

</div>

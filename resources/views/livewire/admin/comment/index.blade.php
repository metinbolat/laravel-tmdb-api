<div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Yorumlar
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
                                                       wire:click="destroyComments()">Sil</a></li>
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
                                        <button role="button" wire:click="updateComments"
                                                class="btn btn-success">Kaydet</button>
                                    </div>
                                </form>
                            </div>
                            @if($selectAll)
                                <div class=" col-md-10">
                                    @if ($selectAllDB)
                                        <div>
                                            <strong>{{$comments->total()}}</strong> satırın tamamını seçtiniz.
                                        </div>
                                    @elseif(count($checked) < $comments->total())

                                        <div>
                                            <strong>{{count($checked)}}</strong> satır seçtiniz.
                                            <strong>{{$comments->total()}}</strong> satırın <a class="text-primary" href="#"
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
                                    <th wire:click="sortByColumn('user_name')" role="button">
                                        Yazar
                                        @if($sortColumn == 'user_name' && $sortDirection == 'desc')
                                            <i class="mdi mdi-arrow-down text-secondary"></i>
                                        @elseif($sortColumn == 'user_name' && $sortDirection == 'asc')
                                            <i class="mdi mdi-arrow-up text-secondary"> </i>
                                        @endif
                                    </th>
                                    <th wire:click="sortByColumn('comment')" role="button">
                                        Yorum
                                        @if($sortColumn == 'comment' && $sortDirection == 'asc')
                                            <i class="mdi mdi-arrow-up text-secondary"></i>
                                        @elseif($sortColumn == 'comment' && $sortDirection == 'desc')
                                            <i class="mdi mdi-arrow-down text-secondary"></i>
                                        @endif
                                    </th>
                                    <th>
                                        Film
                                    </th>
                                    <th wire:click="sortByColumn('created_at')" role="button">
                                        @if($sortColumn == 'created_at' && $sortDirection == 'asc')
                                            <i class="mdi mdi-arrow-up text-secondary"></i>
                                        @elseif($sortColumn == 'created_at' && $sortDirection == 'desc')
                                            <i class="mdi mdi-arrow-down text-secondary"></i>
                                        @endif
                                        Yorum Tarihi
                                    </th>
                                    <th colspan="3" class="text-center">Eylemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($comments as $comment)
                                    <tr class="@if($this->isChecked($comment->id))
                                    table-primary
                                    @endif">
                                        <td><input wire:model="checked" value="{{$comment->id}}" type="checkbox"
                                                   class="form-check-input" style="width: 18px; height:18px">
                                        </td>
                                        <td>{{$comment->user_name}}</td>
                                        <td>{{$comment->comment}}</td>
                                        <td>{{$comment->movie->title}}</td>
                                        <td>{{$comment->created_at}}</td>
                                        <td>@if($comment->is_public)
                                                <span class="badge bg-success">Açık</span>
                                            @else
                                                <span class="badge bg-secondary">Gizli</span>
                                            @endif
                                        </td>
                                        <td style="border-right: none;" width="50px;">
                                            <a href="{{route('back.movie.edit', $comment->id)}}"
                                               class="btn btn-sm btn-success">Düzenle</a>
                                        </td>
                                        <td style="border-left: none;" width="50px;">
                                            <a href="#" wire:click="destroyComment({{$comment->id}})" role="button"
                                               onclick="confirm('Silmek istediğinizden emin misiniz?') || event.stopImmediatePropagation()"
                                               class="btn btn-sm btn-danger ms-2">Sil</a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Hiç yorum bulunamadı.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{$comments->links()}}
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
            $('#BulkUpdateModal').modal('hide');
        });
    </script>
@endpush

<!-- Series Search Results Modal -->
<div wire:ignore.self class="modal fade" id="SeriesSearcResultsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Dizi Ekle</h1>
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
                                        <h5 class="card-title">{{$result['original_name']}} ({{date('Y',
                                        strtotime($result['first_air_date']))}})</h5>
                                        <button class="btn btn-sm btn-success float-end"
                                                wire:click="generateTvShow({{$seriesId = $result['id']}})">Seç</button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Aramanızla eşleşen dizi bulunamadı.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

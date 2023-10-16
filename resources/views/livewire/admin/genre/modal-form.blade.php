<!-- Add Genre Modal -->
<div wire:ignore.self class="modal fade" id="AddGenreModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kategori Ekle</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <form wire:submit.prevent="storeGenre">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Kategori</label>
                    <input type="text" wire:model.defer="name" class="form-control">
                    @error('name')<small id="error" class="text-danger"> {{$message}}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Kategori Url</label>
                    <input type="text" wire:model.defer="slug" class="form-control">
                    @error('slug')<small class="text-danger"> {{$message}}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Yayın Durumu</label> <br/>
                    <input type="checkbox" wire:model.defer="status" style="width: 20px; height: 20px;">
                    <div class="alert alert-warning">Bu kutucuğa onay verdiğinizde bu kategori görünür olur.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Genre Modal -->
<div wire:ignore.self class="modal fade" id="UpdateGenreModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kategori Düzenle</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div> Yükleniyor...
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateGenre">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kategori</label>
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error('name') <small class="text-danger"> {{$message}}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Kategori Url</label>
                            <input type="text" wire:model.defer="slug" class="form-control">
                            @error('slug')<small class="text-danger"> {{$message}}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Yayın Durumu</label> <br/>
                            <input type="checkbox" wire:model.defer="status" style="width: 20px; height: 20px;">
                            <div class="alert alert-warning">Bu kutucuğa onay verdiğinizde bu kategori görünür olur.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Genre Modal -->
<div wire:ignore.self class="modal fade" id="DeleteGenreModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kategori Sil</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div> Yükleniyor...
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="destroyGenre">
                    <div class="modal-body">
                        <h4>Bu kategoriyi silmek istiyor musunuz?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Sil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

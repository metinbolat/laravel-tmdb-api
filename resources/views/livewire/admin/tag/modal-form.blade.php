<!-- Add Tag Modal -->
<div wire:ignore.self class="modal fade" id="AddTagModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Etiket Ekle</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <form wire:submit.prevent="storeTag">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Etiket</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name')<small id="error" class="text-danger"> {{$message}}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Etiket Url</label>
                        <input type="text" wire:model.defer="slug" class="form-control">
                        @error('slug')<small class="text-danger"> {{$message}}</small> @enderror
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

<!-- Update Tag Modal -->
<div wire:ignore.self class="modal fade" id="UpdateTagModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Etiket Düzenle</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div> Yükleniyor...
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateTag">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Etiket</label>
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error('name') <small class="text-danger"> {{$message}}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Etiket Url</label>
                            <input type="text" wire:model.defer="slug" class="form-control">
                            @error('slug')<small class="text-danger"> {{$message}}</small> @enderror
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

<!-- Delete Tag Modal -->
<div wire:ignore.self class="modal fade" id="DeleteTagModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Etiket Sil</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div> Yükleniyor...
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="destroyTag">
                    <div class="modal-body">
                        <h4>Bu etiketi silmek istiyor musunuz?</h4>
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

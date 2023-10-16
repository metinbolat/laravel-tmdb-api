<!-- Update Cast Modal -->
<div wire:ignore.self class="modal fade" id="UpdateCastModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Oyuncu Düzenle</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div> Yükleniyor...
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateCast">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Oyuncu</label>
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error('name') <small class="text-danger"> {{$message}}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Oyuncu Url</label>
                            <input type="text" wire:model.defer="slug" class="form-control">
                            @error('slug')<small class="text-danger"> {{$message}}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Afiş Url</label>
                            <input type="text" wire:model.defer="poster" class="form-control">
                            @error('poster')<small class="text-danger"> {{$message}}</small> @enderror
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

<!-- Delete Cast Modal -->
<div wire:ignore.self class="modal fade" id="DeleteCastModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form wire:submit.prevent="destroyCast">
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

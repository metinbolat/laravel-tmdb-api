<div class="modal-body">

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                type="button" role="tab" aria-controls="pills-home" aria-selected="true">Film Detay</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Etiketler &
                SEO</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Film Adı</label>
                        <input type="text" wire:model.defer="title" class="form-control">
                        @error('title')
                        <small class="text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Süre</label>
                        <input type="text" wire:model.defer="runtime" class="form-control">
                        @error('runtime')
                        <small class="text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Url</label>
                        <input type="text" wire:model.defer="slug" class="form-control">
                        @error('slug')
                        <small class="text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label>Dil</label>
                        <input type="text" wire:model.defer="language" class="form-control">
                        @error('language')
                        <small class="text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label>Durum</label><br />
                        <input type="checkbox" wire:model.defer="status" style="width: 20px; height: 20px;">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Format</label>
                        <input type="text" wire:model.defer="format" class="form-control">
                        @error('format')
                        <small class="text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Rating</label>
                        <input type="text" wire:model.defer="rating" class="form-control">
                        @error('rating')
                        <small class="text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Poster</label>
                        <input type="text" wire:model.defer="poster" class="form-control">
                        @error('poster')
                        <small class="text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Backdrop</label>
                        <input type="text" wire:model.defer="backdrop" class="form-control">
                        @error('backdrop')
                        <small class="text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label>Overview</label>
                        <textarea rows="3" wire:model.defer="overview" name="overview"
                            class="form-control lh-sm border border-primary"></textarea>
                        @error('overview')
                        <small class="text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label>Etiketler</label>
                <select class="form-control select2" name="movie_tags" multiple="multiple">
                    <option value="AL">Alabama</option>
                    <option value="WY">Wyoming</option>
                </select>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label>Meta</label>
                        <textarea rows="3" wire:model.defer="meta" name="meta"
                            class="form-control lh-sm border border-primary"></textarea>
                        @error('meta')
                        <small class="text-danger"> {{ $message }}</small>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
@push('script')
<script>
    $(document).ready(function() {
            $('.select2').select2()
        });
</script>
@endpush
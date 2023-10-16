<div>
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
    <input wire:model="queryTag" type="search" class="form-control form-control-sm col-sm-5" id="search" placeholder="İsme göre ara">
    @if(!empty($queryTag))
        <div>
            @if(!empty($tags))
                @foreach($tags as $tag)
                    <ul class="list-group">
                        <li role="button" wire:click="addTag({{$tag->id}})" class="list-group-item border-0">{{$tag->tag_name}}</li>
                    </ul>
                @endforeach
            @endif
        </div>
    @endif
</div>

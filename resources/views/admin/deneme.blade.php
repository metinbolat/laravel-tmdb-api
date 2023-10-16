@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
<div class="form-group">

                    <form action="{{url('deneme')}}" method="POST">
                        @csrf
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Oyuncular</label>
                        <input value="actor" type="text" name="actors[]" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Kategoriler</label>
                        <input type="text" name="categories[]" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Yönetmen</label>
                        <input type="text" name="director" class="form-control">
                        </div>

                    </form>

</div>
        </div>
    </div>
@endsection

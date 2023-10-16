@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Ayarlar
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
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Genel Ayarlar</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Logo & Favicon</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <form action="{{route('back.settings.update')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Site Adı</label>
                                                    <input type="text" name="site_name" class="form-control" value="{{$settings->site_name}}">
                                                    @error('site_name') <small class="text-danger"> {{$message}}</small> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label>Site E-posta</label>
                                                    <input type="email" name="site_email" class="form-control" value="{{$settings->site_email}}">
                                                    @error('site_email') <small class="text-danger"> {{$message}}</small> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label>Site Açıklaması</label>
                                                    <textarea name="site_description" rows="3" class="form-control lh-sm">{{$settings->site_description}}</textarea>
                                                    @error('site_description') <small class="text-danger"> {{$message}}</small> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label>Site Footer Metni</label>
                                                    <textarea name="site_footertext" rows="3" class="form-control lh-sm">{{$settings->site_footertext}}</textarea>
                                                    @error('site_footertext') <small class="text-danger"> {{$message}}</small> @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label>Ayraç</label>
                                                    <select class="form-select mb-3" name="site_separator" id="separator">
                                                        <option value="|" {{$settings->site_separator == '|' ? 'selected' : ''}}>|</option>
                                                        <option value="-" {{$settings->site_separator == '-' ? 'selected' : ''}}>-</option>
                                                        <option value="/" {{$settings->site_separator == '/' ? 'selected' : ''}}>/</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Yorum Otomatik Onay</label>
                                                    <select class="form-select mb-3" name="comment_approval">
                                                        <option value="0" {{$settings->comment_approval == 0 ? 'selected' : ''}}>Onaysız</option>
                                                        <option value="1" {{$settings->comment_approval == 1 ? 'selected' : ''}}>Onaylı</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary mb-3">Güncelle</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Site logosu değiştir</label>
                                            <div style="max-width: 200px;">
                                                <img src="" alt="" class="img-thumbnail" id="logo-image-preview" data-ijabo-default-img="{{\App\Models\Setting::find(1)->site_logo}}">
                                            </div>
                                            <form action="{{route('back.logo.update')}}" method="post" id="changeBlogLogoForm" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-2">
                                                    <input type="file" name="site_logo" class="form-control" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Logo Değiştir</button>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Site favicon değiştir</label>
                                            <div style="max-width: 100px;">
                                                <img src="" alt="" class="img-thumbnail" id="favicon-image-preview" data-ijabo-default-img="{{\App\Models\Setting::find(1)->site_favicon}}">
                                            </div>
                                            <form action="{{route('back.favicon.update')}}" method="post" id="changeBlogFaviconForm" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-2">
                                                    <input type="file" name="site_favicon" class="form-control" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Logo Değiştir</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('input[name="site_logo"]').ijaboViewer({
            preview: '#logo-image-preview',
            imageShape: 'rectangular',
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            onErrorShape: function (message, element) {
                alert(message);
            },
            onInvalidType: function (message, element){
                alert(message);
            },
            onSuccess: function (message, element) {

            }
        });

        $('input[name="site_favicon"]').ijaboViewer({
            preview: '#favicon-image-preview',
            imageShape: 'square',
            allowedExtensions: ['ico'],
            onErrorShape: function (message, element) {
                alert(message);
            },
            onInvalidType: function (message, element){
                alert(message);
            },
            onSuccess: function (message, element) {

            }
        });
    </script>
@endpush

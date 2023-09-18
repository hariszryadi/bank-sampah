@extends('layouts.admin.app')

@section('content')
<!-- Inner content -->
<div class="content-inner">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>Sampah</h4>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item">Master</span>
                    <span class="breadcrumb-item">Sampah</span>
                    <span class="breadcrumb-item active">{{ isset($waste) ? 'Edit Sampah' : 'Tambah Sampah' }}</span>
                </div>

            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ isset($waste) ? 'Edit Sampah' : 'Tambah Sampah' }}</h3>
            </div>
            
            <div class="card-body">
                @isset($waste)
                <form class="form-horizontal" id="form" action="{{ route('waste.update', $waste->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                @else
                <form class="form-horizontal" id="form" action="{{ route('waste.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                @endisset
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 @error('category') text-danger @enderror" for="category">Jenis</label>
                        <div class="col-lg-10">
                            <select name="category" class="form-control" id="category">
                                <option value="" selected disabled>Pilih</option>
                                @foreach ($category as $item)
                                    @isset($waste)
                                        <option value="{{ $item->id }}" {{ old('category') == $item->id ? 'selected' : ($waste->category_id == $item->id ? 'selected' : '') }}>{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}" {{ old('category') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endisset
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 @error('name') text-danger @enderror" for="name">Nama</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name')!== null ? old('name') : (isset($waste) ? $waste->name : '') }}" placeholder="Nama">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 @error('description') text-danger @enderror" for="description">Deskripsi</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" value="{{ old('description')!== null ? old('description') : (isset($waste) ? $waste->description : '') }}" placeholder="Deskripsi">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 @error('price') text-danger @enderror" for="price">Harga/kg</label>
                        <div class="col-lg-10">
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price')!== null ? old('price') : (isset($waste) ? $waste->price : 0) }}" min="0">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 @error('photo') text-danger @enderror" for="photo">Foto</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="photo" class="custom-file-input form-control @error('photo') is-invalid @enderror" id="customFile" accept=".jpg,.jpeg,.png">
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <span id="temp_photo">
                                @if (isset($waste))
                                    <img src="{{ asset('storage/'.$waste->photo) }}" class="img-thumbnail" style="margin-top: 12px;"/>
                                @endif
                            </span>
                        </div>
                    </div>
    
                    <div class="form-group" style="margin-top: 50px; margin-left: 10px;">
                        <a class="btn btn-danger" href="{{ route('waste.index') }}">Kembali</a>
                        <button type="submit" class="btn btn-primary">{{ isset($waste) ? 'Update' : 'Simpan' }}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /content area -->

</div>
<!-- /inner content -->
@endsection

@section('scripts')
<script>
    var previews = $('#temp_photo');

    $(".custom-file-input").on("change", function(e){
        $('.custom-file-label').text(e.target.files[0].name);
    });

    $("input[type=file]").on("change", function (e) {
        if (this.files[0].size > 2097152) {
            alert('Upload file max 2 MB');
            this.value = null;
        }
        previews.empty();
        Array.prototype.slice.call(e.target.files)
            .forEach(function (file, idx) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    $("<img/>", {
                            "src": event.target.result,
                            "class": idx,
                            "class": "img-thumbnail",
                            "style": "margin-top: 12px"
                        }).appendTo(previews);
                };
                reader.readAsDataURL(file);
            })
    })
</script>
@endsection

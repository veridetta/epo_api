@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Ubah Kategori') }}</div>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-body">
                    <div class="row mt-2 mb-5">
                        <div class="col-lg-12 margin-tb">
                            <div class="float-right">
                                <a class="btn btn-secondary" href="{{ route('ratings.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                 
                    <form action="{{ route('ratings.update',$rating->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                 
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Judul:</strong>
                                    <input type="text" name="name" value="{{ $rating->name }}" class="form-control" >
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Kategori:</strong>
                                        <select name="cat_id" class="custom-select form-control">
                                            <option selected>Pilih...</option>
                                        @foreach ($cats as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Deskripsi:</strong>
                                    <textarea name="description" class="form-control">{{$rating->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Alamat:</strong>
                                    <textarea name="address" class="form-control">{{$rating->address}}</textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Harga:</strong>
                                    <input type="text" name="price" class="form-control" placeholder="Harga" value="{{ $rating->price }}" >
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Telp:</strong>
                                    <input type="number" name="phone" class="form-control" placeholder="Telp" value="{{ $rating->phone }}" >
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Jam Buka:</strong>
                                    <input type="text" name="open" class="form-control" placeholder="Jam Buka" value="{{ $rating->open }}" >
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Fasilitas:</strong>
                                    <textarea name="facility" class="form-control">{{$rating->facility}}</textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Link Maps:</strong>
                                    <input type="text" name="map" class="form-control" placeholder="Link Maps"value="{{ $rating->map }}" >
                                </div>
                            </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

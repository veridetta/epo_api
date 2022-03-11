@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Tambah Makanan') }}</div>

                <div class="card-body">
                    <div class="row mt-5 mb-5">
                        <div class="col-lg-12 margin-tb">
                            <div class="float-left">
                                <h2> Show Rating</h2>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-secondary" href="{{ route('ratings.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                 
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nama:</strong>
                                {{ $rating->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <?php 
                         $cats= \App\Models\cat::where('id','=',$rating->cat_id)->first();?>
                                <strong>Kategori:</strong>
                                {{ $cats->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                               <p> <strong>Cover:</strong></p>
                                <image class="img-responsive img-fluid" style="width:100px;" src="{{ $rating->cover }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

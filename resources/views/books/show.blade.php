@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Tambah Buku') }}</div>

                <div class="card-body">
                    <div class="row mt-5 mb-5">
                        <div class="col-lg-12 margin-tb">
                            <div class="float-left">
                                <h2> Show Post</h2>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-secondary" href="{{ route('books.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                 
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Judul:</strong>
                                {{ $book->title }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Penulis:</strong>
                                {{ $book->author }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

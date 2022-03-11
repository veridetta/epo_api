@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Ubah Buku') }}</div>

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
                                <a class="btn btn-secondary" href="{{ route('books.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                 
                    <form action="{{ route('books.update',$book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                 
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" value="{{ $book->title }}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Penulis:</strong>
                                    <input type="text" name="author" value="{{ $book->author }}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tahun Terbit:</strong>
                                    <input type="number" name="release_year" value="{{ $book->release_year }}" class="form-control" >
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

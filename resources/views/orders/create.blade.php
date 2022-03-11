@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Tambah Order') }}</div>

                <div class="card-body">
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

                    <div class="row mt-2 mb-5">
                        <div class="col-lg-12 margin-tb">
                            <div class="float-right">
                                <a class="btn btn-secondary" href="{{ route('orders.submitted') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                     
                    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                     
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Pilih Siswa:</strong>
                                    <select name="user_id" class="form-control">
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id}}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Pilih Buku:</strong>
                                    <select name="book_id" class="form-control">
                                        @foreach ($books as $book)
                                        <option value="{{ $book->id}}">{{ $book->title }} -> {{ $book->author }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            </div>

                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tanggal:</strong>
                                    <input type="date"   name="tanggal" id="tanggal" class="form-control">
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Waktu:</strong>
                                    <input type="time"   name="jam" id="jam" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                     
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

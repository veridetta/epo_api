@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Tambah Review') }}</div>

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
                                <a class="btn btn-secondary" href="{{ route('foods.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                     
                    <form action="{{ route('ratings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                     
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>User:</strong>
                                    <select name="user_id" class="custom-select form-control">
                                        <option selected>Pilih...</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Makanan:</strong>
                                    <select name="food_id" class="custom-select form-control">
                                        <option selected>Pilih...</option>
                                    @foreach ($foods as $food)
                                        <option value="{{$food->id}}">{{$food->name}}
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Review:</strong>
                                    <textarea name="comment" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Rating:</strong>
                                    <input type="number" max="5" min="1" name="rating" class="form-control" placeholder="Rating 0-5">
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

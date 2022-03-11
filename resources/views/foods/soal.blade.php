@extends('layouts.app')
 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Daftar Soal') }}</div>

                <div class="card-body">
                     
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <div class="row mt-2 mb-5">
                        <div class="col-lg-12 margin-tb">
                            <div class="float-right">
                                <a class="btn btn-success" href="{{ route('foods.create') }}">Tambah Soal</a>
                            </div>
                        </div>
                    </div>
                 
                    <table class="table table-bordered">
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th>Soal </th>
                            <th>Kunci</th>
                            <th>A</th>
                            <th>B</th>
                            <th>C</th>
                            <th>D</th>
                            <th width="280px"class="text-center">Action</th>
                        </tr>
                        @if ($foods->count())
                        @foreach ($foods as $key => $food)
                        <tr>
                            <td class="text-center">{{ ++$i }}</td>
                            <td><img class="col-12 img" src="{{$food->gambar_soal}}"/><br>{{ $food->soal }}</td>
                            <td>{{ $food->kunci }}</td>
                            <td><img class="col-12 img" src="{{$food->a_gambar}}"/><br>{{ $food->kunci }}</td>
                            <td><img class="col-12 img" src="{{$food->b_gambar}}"/><br>{{ $food->a }}</td>
                            <td><img class="col-12 img" src="{{$food->c_gambar}}"/><br>{{ $food->b }}</td>
                            <td><img class="col-12 img" src="{{$food->d_gambar}}"/><br>{{ $food->c }}</td>
                            <td class="text-center">
                                <form action="{{ route('foods.destroy',$food->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="8">Tidak ada data</td>
                            </tr>
                        @endif
                    </table>

                    {!! $foods ?? ''->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
@extends('layouts.app')
 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Daftar Kategori') }}</div>

                <div class="card-body">
                     
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <div class="row mt-2 mb-5">
                        <div class="col-lg-12 margin-tb">
                            <div class="float-right">
                                <a class="btn btn-success" href="{{ route('cats.create') }}">Tambah Kategori</a>
                            </div>
                        </div>
                    </div>
                 
                    <table class="table table-bordered">
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th>Id </th>
                            <th>Nama</th>
                            <th>Jumlah Soal</th>
                            <th width="280px"class="text-center">Action</th>
                        </tr>
                        @foreach ($cats as $cat)
                        <tr>
                        <?php 
                         $cats= \App\Models\food::where('cat_id','=',$cat->id)->count();?>
                            <td class="text-center">{{ ++$i }}</td>
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->name }}</td>
                            <td><a class="btn btn-sm btn-warning" href="{{ route('foods.soal',$cat->id) }}">{{ $cats }} <i class="bi-eye-fill"></i></a> <a class="btn btn-sm btn-success" href="{{ route('foods.create') }}">+</a></td>
                            <td class="text-center">
                                <form action="{{ route('cats.destroy',$cat->id) }}" method="POST">
                 
                                    <a class="btn btn-info btn-sm" href="{{ route('cats.show',$cat->id) }}">Show</a>
                 
                                    <a class="btn btn-primary btn-sm" href="{{ route('cats.edit',$cat->id) }}">Edit</a>
                 
                                    @csrf
                                    @method('DELETE')
                 
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                </form>                        
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    {!! $cats ?? ''->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
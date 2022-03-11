@extends('layouts.app')
 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Daftar Makanan') }}</div>

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
                            <th>Nama </th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Alamat</th>
                            <th>Harga</th>
                            <th>Telp</th>
                            <th>Buka</th>
                            <th>Fasilitas</th>
                            <th>Maps</th>
                            <th width="280px"class="text-center">Action</th>
                        </tr>
                        @foreach ($foods as $food)
                        <?php 
                         $cats= \App\Models\cat::where('id','=',$food->cat_id)->first();
                         if($cats){
                            ?>
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{ $food->name }}</td>
                                <td>{{ $cats->name }}</td>
                                <td>{{ $food->description }}</td>
                                <td>{{ $food->address }}</td>
                                <td>{{ $food->price }}</td>
                                <td>{{ $food->phone }}</td>
                                <td>{{ $food->open }}</td>
                                <td>{{ $food->facility }}</td>
                                <td><a href="{{ $food->map }}">Buka Maps</a></td>
                                <td class="text-center">
                                    <form action="{{ route('foods.destroy',$food->id) }}" method="POST">
                                    
                                        <a class="btn btn-info btn-sm" href="{{ route('foods.show',$food->id) }}">Show</a>
                     
                                        <a class="btn btn-primary btn-sm" href="{{ route('foods.edit',$food->id) }}">Edit</a>
                     
                                        @csrf
                                        @method('DELETE')
                     
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
    
                                        <a class="btn btn-sm btn-warning" href="{{ url('review/'.$food->id) }}" style="margin-top:8px;">Review</a>
                                    </form>
                                </td>
                            </tr>
                            <?php
                         }
                         ?>
                        
                        @endforeach
                    </table>

                    {!! $foods ?? ''->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
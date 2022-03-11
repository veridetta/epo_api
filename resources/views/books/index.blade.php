@extends('layouts.app')
 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Daftar Buku') }}</div>

                <div class="card-body">
                     
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <div class="row mt-2 mb-5">
                        <div class="col-lg-12 margin-tb">
                            <div class="float-right">
                                <a class="btn btn-success" href="{{ route('books.create') }}">Tambah Buku</a>
                            </div>
                        </div>
                    </div>
                 
                    <table class="table table-bordered">
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Tahun Terbit</th>
                            <th width="280px"class="text-center">Action</th>
                        </tr>
                        @foreach ($books as $book)
                        <tr>
                            <td class="text-center">{{ ++$i }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->release_year }}</td>
                            <td class="text-center">
                                <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                 
                                    <a class="btn btn-info btn-sm" href="{{ route('books.show',$book->id) }}">Show</a>
                 
                                    <a class="btn btn-primary btn-sm" href="{{ route('books.edit',$book->id) }}">Edit</a>
                 
                                    @csrf
                                    @method('DELETE')
                 
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    {!! $books ?? ''->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
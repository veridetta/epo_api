@extends('layouts.app')
 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Daftar Review') }}</div>

                <div class="card-body">
                     
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <div class="row mt-2 mb-5">
                        <div class="col-lg-12 margin-tb">
                            <div class="float-right">
                                <a class="btn btn-success" href="{{ route('ratings.create') }}">Tambah Review</a>
                            </div>
                        </div>
                    </div>
                 
                    <table class="table table-bordered">
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th>Review </th>
                            <th>Food</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th width="280px"class="text-center">Action</th>
                        </tr>
                        @foreach ($ratings as $rating)  
                        <?php 
                         $user= \App\Models\User::where('id','=',$rating->user_id)->first();
                         $food= \App\Models\food::where('id','=',$rating->food_id)->first();?>  
                                         
                        <tr>
                            <td class="text-center">{{ ++$i }}</td>
                            <td>{{ $rating->comment }}</td>
                            
                            <td>{{ $food->name }}</td>
                            
                            <td>{{ $user->name }}</td>
                            <td>{{ $rating->rating }}</td>
                            <td class="text-center">
                                <form action="{{ route('ratings.destroy',$rating->id) }}" method="POST">
                 
                                    @csrf
                                    @method('DELETE')
                 
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    {!! $ratings ?? ''->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
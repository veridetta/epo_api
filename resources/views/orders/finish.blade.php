@extends('layouts.app')
 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Daftar Pinjaman Selesai') }}</div>

                <div class="card-body">
                     
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <div class="row mt-2 mb-5">
                        <div class="col-lg-12 margin-tb">
                            <div class="float-right">
                                <a class="btn btn-success" href="{{ route('orders.create') }}">Tambah Order</a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th>User</th>
                            <th>Buku</th>
                            <th>Waktu Booking</th>
                            <th>Dibuat</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($orders as $order)
                        <tr>
                            <td class="text-center">{{ ++$i }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->book->title }}</td>
                            <td>{{ $order->tanggal }} - {{ $order->jam }}</td>
                            <td>{{ $order->book->created_at }}</td>
                            <td class="text-center ">
                                <div class="row justify-content-center">
                                    @if($order->status=="Selesai")
                                    <a href="#" class="btn btn-success btn-sm">Selesai</a>
                                    @else
                                    <a href="#" class="btn btn-danger btn-sm">Rejected</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    {!! $orders ?? ''->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
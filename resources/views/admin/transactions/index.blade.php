@extends('admin/admin')
@section('title','Transactions')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Transaction
                </h3>
                <div class="card-tools">
                    <a href="{{ url('/admin/transactions/create') }}"><i class="fa fa-plus"></i>Add Trnsaction</a>
                </div>
            </div>
            <div class="coard-body">
                @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check"></i>&nbsp; {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="table-resposive">
                    @include('admin.transactions.table')
                </div>
                {{-- <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Product</td>
                            <td>Date</td>
                            <td>Price</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->products->name }}</td>
                                <td>{{ $item->trx_date }}</td>
                                <td>{{ $item->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
                {{-- {{$dataTable->table()}} --}}
            </div>
        </div>
    </div>
</div>


@endsection
{{-- @push('scripts')
{{$dataTable->scripts()}}
@endpush --}}
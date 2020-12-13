@extends('admin.admin')
@section('title','Kategori')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Categories</h3>
                <div class="card-tools">
                    {{-- <a href="{{ url('admin/category/create') }} "> <i class="fa fa-plus float-right">
                         </i>Add</a> --}}
                         <a href="{{ url('admin/category/create') }}">
                            <i class="fa fa-plus float-right"></i>
                        </a>
                </div>
            </div>
            <div class="card-body">

                @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ Session::get('message') }}
                </div>
                @endif
                <table class=" table table-bordered table-hover ">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key => $item)
                        <tr class="text-center">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <form action="{{ url('admin/category/'.$item->id) }}" method="post">
                                    {{-- <div class="btn-group" role="group" aria-label="Button-group">

                                        {{ csrf_field() }}

                                    <a href="{{ url('admin/category/'. $item->id) }}" class="btn btn-sm btn-info"
                                        style="color:#fff"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('admin/category/'. $item->id .'/edit') }}"
                                        class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                    <button type="submit" class="btn btn-sm btn-danger "
                                        onclick="return confirm('Are You Sure to Delete this item?')"><i
                                            class="fa fa-trash"></i></button>

            </div> --}}
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <div class="btn-group" role="group" aria-label="Button group">
                <a href="{{ url('admin/category/'. $item->id) }}" class="btn btn-sm btn-info" style="color: #fff"><i
                        class="fa fa-eye"></i></a>
                <a href="{{ url('admin/category/'. $item->id.'/edit') }}" class="btn btn-sm btn-warning"
                    style="color: #fff"><i class="fa fa-edit"></i></a>
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure ?')"
                    style="color: #fff"><i class="fa fa-trash"></i></button>
            </div>
            </form>
            </td>
            </tr>

            @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
@extends('/admin/admin')
@section('title','Tambah Kategori')
@section('content')
    
<div class="row">
    <div class="col-12">
        <form action="{{ url('admin/category') }}" method="POST">
            @csrf
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Category</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Category</label>
                        <input  type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('/admin/category') }}" class="btn btn-outline-info">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>
            </div>
        
    </div>
</div>
    
@endsection
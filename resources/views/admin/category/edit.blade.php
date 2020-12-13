@extends('/admin/admin')
@section('content')
@section('title','Edit Data')

<div class="row">
    <div class="col-12">
        <form action="{{ url('admin/category/'.$category->id) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Category</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Category</label>
                        <input type="text" name="name"  value="{{ $category->name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="" class="form-control">
                            <option {{  $category->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                            <option {{  $category->status == 'inactive' ? 'selected' : '' }} value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('/admin/category') }}" class="btn btn-outline-info">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@extends('/admin/admin')
@section('content')
@section('title','Show Data')

<div class="row">
    <div class="col-12">

        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Category</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Category</label>
                    <input value="{{ $category->name }}" type="text" name="name" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" value="{{ $category->status }} " readonly class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ url('admin/category/') }}" class="btn btn-outline-info">Back</a>
            </div>
        </div>

    </div>
</div>

@endsection
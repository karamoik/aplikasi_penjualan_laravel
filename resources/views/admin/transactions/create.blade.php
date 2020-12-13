@extends('admin/admin')
@section('title','Transaction')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Transaction
                </h3>
            </div>
            {!! Form::open(['route'=>'transacstion.import','method'=>'post','files'=>true]) !!}
            <div class="card-body">
                @if (!empty($errors->all()))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="form-group col-sm-12">
                        <div class="form-group col-sm-12">
                            {!! Form::label('file','File Excel') !!}
                            {!! Form::file('file', ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('/admin/transactions') }}" class="btn btn-outline-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Upload</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


@endsection
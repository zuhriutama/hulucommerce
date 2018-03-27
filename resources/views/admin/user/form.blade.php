@extends('layouts.admin')

@section('title')
<h1>
    User
    <small>Form</small>
</h1>
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    @if (isset($item))
    <form action="{{ url('admin/users/'.$item->id) }}" method="post" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="PUT">
    @else
    <form action="{{ url('admin/users') }}" method="post" enctype="multipart/form-data">
    @endif

        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-body pad">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ isset($item) ? $item->name : old('name') }}" >
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ isset($item) ? $item->email : old('email') }}" >
                    </div>

                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" >
                    </div>

                    <div class="form-group">
                        <label for="">Confirm new password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter new password" >
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.box -->
        </div>

        
    </form>
@endsection

@section('script')
<!-- CK Editor -->
<script src="{{ asset('backend/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
    $(function () {
        CKEDITOR.replace('description')
    })
</script>
@endsection
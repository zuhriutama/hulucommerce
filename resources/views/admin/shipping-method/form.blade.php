@extends('layouts.admin')

@section('style')
@endsection

@section('header')
    <h1>
        Shipping Method
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
        <div class="col-md-12">
            <div class="box box-info">
                @if (isset($item))
                <form action="{{ url('admin/shipping-methods/'.$item->id) }}" method="post" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                @else
                <form action="{{ url('admin/shipping-methods') }}" method="post" enctype="multipart/form-data">
                @endif
                    <div class="box-body pad">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" value="{{ isset($item) ? $item->name : old('name') }}" >
                        </div>

                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" id="image" name="image" >
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col-->
    </div>
@endsection
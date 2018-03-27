@extends('layouts.admin')

@section('style')
@endsection

@section('header')
    <h1>
        User Address
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
                <form action="{{ url('admin/user-addresses/'.$item->id) }}" method="post" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                @else
                <form action="{{ url('admin/user-addresses') }}" method="post" enctype="multipart/form-data">
                @endif
                    <div class="box-body pad">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="">User</label>
                            <select class="form-control" name="user_id">
                                <option selected disabled>-- Select User --</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{isset($item) && $item->user_id==$user->id?'selected':''}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ isset($item) ? $item->name : old('name') }}" >
                        </div>

                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" value="{{ isset($item) ? $item->phone : old('phone') }}" >
                        </div>

                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea class="form-control" name="address">{{ isset($item) ? $item->address : old('address') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Province</label>
                            <select class="form-control" name="province_id">
                                <option selected disabled>-- Select Province --</option>
                                @foreach($provinces as $province)
                                    <option value="{{$province->id}}" {{isset($item) && $item->province_id==$province->id?'selected':''}}>{{$province->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">City</label>
                            <select class="form-control" name="city_id">
                                <option selected disabled>-- Select City --</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{isset($item) && $item->city_id==$user->id?'selected':''}}>{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Zipcode</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter zipcode" value="{{ isset($item) ? $item->zipcode : old('zipcode') }}" >
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
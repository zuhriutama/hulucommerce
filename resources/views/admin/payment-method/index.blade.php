@extends('layouts.admin')

@section('title')
<h1>Payment Methods<small>list</small></h1>
@endsection

@section('content')
    @if (session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{ session('status') }}
    </div>
    @endif

    <div class="row">
        <div class="col-xs-12">
            <a href="{{ url('admin/payment-methods/create') }}" class="btn btn-lg btn-primary" style="margin-bottom:10px">Add Item</a>

            <div class="box">
                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped mt-3">
                        <thead>
                            <tr>
                                <th>Created at</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ date('j M Y H:i', strtotime($item->created_at)) }}</td>
                                <td>{{ $item->name }}</td>
                                <td><img src="{{ asset($item->image) }}" class="img-responsive" alt="{{$item->name}}" /></td>
                                <td>
                                    <form action="{{ url('admin/payment-methods/'.$item->id) }}" method="post" onsubmit="return confirm('Do you really want to delete?');">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <div class="btn-group">
                                            <a href="{{ url('admin/payment-methods/'.$item->id.'/edit') }}" class="btn btn-flat btn-warning pull-left"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-flat btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#data').DataTable({
                "order": [
                    [ 0, "desc" ]
                ],
                "aoColumns": [
                    { "sType": "date" },
                    null,
                    null,
                    null,
                ]
            })
        })
    </script>
@endsection
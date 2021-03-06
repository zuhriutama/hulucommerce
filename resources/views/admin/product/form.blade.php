@extends('layouts.admin')

@section('style')
@endsection

@section('header')
    <h1>
        Products
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
                <form action="{{ url('admin/products/'.$item->id) }}" method="post" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                @else
                <form action="{{ url('admin/products') }}" method="post" enctype="multipart/form-data">
                @endif
                    <div class="box-body pad">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" value="{{ isset($item) ? $item->name : old('name') }}" >
                        </div>

                        <div class="form-group">
                            <label for="">Short Description</label>
                            <textarea id="short_desc" name="short_desc" class="editor" rows="10" cols="80">
                                {{ isset($item) ? $item->short_desc : '' }}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea id="description" name="description" class="editor" rows="10" cols="80">
                                {{ isset($item) ? $item->description : '' }}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Price</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" value="{{ isset($item) ? $item->price : old('price') }}" min=0 >
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Weight</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="weight" name="weight" placeholder="Enter weight" value="{{ isset($item) ? $item->weight : old('weight') }}" min=0 >
                                <span class="input-group-addon">gram</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Seen</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-eye"></i></span>
                                <input type="number" class="form-control" id="seen" name="seen" value="{{ isset($item) ? $item->seen : old('seen') }}" min=0 >
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Product Images</label>
                            <input id="file" type="file" class="form-control" id="images" name="images[]" multiple>
                        </div>

                        <div class="row images">
                            @if(isset($item))
                            @foreach($item->images as $image)
                                <div class="col-md-2">
                                    <img src="{{asset($image->url)}}" class="img-responsive">
                                    <a href="#" class="remove-image" data-id="{{$image->id}}">remove</a>
                                </div>
                            @endforeach
                            @endif
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

@section('script')
    <!-- CK Editor -->
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function () {
            CKEDITOR.replace('short_desc')
            CKEDITOR.replace('description')            

            $('.product-img').click(function(){
                $('#file').trigger('click')
            })

            $('#file').change(function(e){
                var files = event.target.files; //FileList object
                var output = $('.images');
                for(var i = 0; i< files.length; i++)
                {
                    var file = files[i];
                    //Only pics
                    if(!file.type.match('image'))
                        continue;
                    var picReader = new FileReader();
                    picReader.addEventListener("load",function(event){
                        var picFile = event.target;
                        var container = '<div class="col-md-2">'+
                                '<img class="product-img img-responsive" src="'+picFile.result+'" />'+
                            '</div>';
                        output.append(container);
                    });
                    //Read the image
                    picReader.readAsDataURL(file);
                }
            })

            @if(isset($item))
            $('.remove-image').click(function(e){
                e.preventDefault()
                let data = {
                    _token : "{{csrf_token()}}",
                    image_id : $(this).data('id'),
                }

                $.post("{{route('remove-image-product', ['id'=>$item->id])}}", data, function(res){
                    location.reload()
                }).fail(function(xhr, status, error) {
                    swal('Error!', 'Failed remove image!', 'error')
                })
            })
            @endif
        })
    </script>
@endsection
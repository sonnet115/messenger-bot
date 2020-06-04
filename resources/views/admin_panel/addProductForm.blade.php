@extends("admin_panel.main")
@section("body-content")
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Adminox</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Form Validation</li>
                    </ol>
                </div>
                <h4 class="page-title">Products</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="col-sm-6">
        <div class="card-box">
            <h4 class="header-title">Add New Product</h4>
            <br>

            <form method="post" action="{{route('product.store')}}" class="parsley-examples"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="userName">Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" parsley-trigger="change"
                           placeholder="Enter user name" class="form-control" id="userName" value="{{old('name')}}">
                    @if($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif

                </div>
                <div class="form-group">
                    <label for="emailAddress">Code<span class="text-danger">*</span></label>
                    <input type="text" name="code" parsley-trigger="change"
                           placeholder="Enter product code" class="form-control">
                    @if($errors->has('code'))
                        <p class="text-danger">{{ $errors->first('code') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="pass1">Unit of measurement<span class="text-danger">*</span></label>
                    <input id="pass1" name="uom" type="text" placeholder="Enter unit of measurement"
                           class="form-control">
                    @if($errors->has('uom'))
                        <p class="text-danger">{{ $errors->first('uom') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="passWord2">Price<span class="text-danger">*</span></label>
                    <input type="text"
                           placeholder="enter price" name="price" class="form-control">
                    @if($errors->has('price'))
                        <p class="text-danger">{{ $errors->first('price') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="passWord2">Stock<span class="text-danger">*</span></label>
                    <input data-parsley-equalto="#pass1" type="text"
                           placeholder="Password" name="stock" class="form-control">
                    @if($errors->has('stock'))
                        <p class="text-danger">{{ $errors->first('stock') }}</p>
                    @endif
                </div>
                <div class="clone hide">
                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                        <input type="file" name="filenames[]" class="myfrm form-control" multiple>
                    </div>
                    @if($errors->has('filenames'))
                        <p class="text-danger">{{ $errors->first('filenames') }}</p>
                    @endif
                    <p class="text-danger">{{ Session::get('error_image_count') }}</p>
                </div>
                <br>
                <button class="btn btn-primary">Add product</button>

            </form>
        </div>
    </div>
@endsection

@section('product-js')
    <!-- Validation init js-->
    {{--    <script src="{{asset('assets/admin/js/pages/form-validation.init.js')}}"></script>--}}
    <!-- Plugin js-->
    <script src="{{asset('assets/admin/libs/parsleyjs/parsley.min.js')}}"></script>
@endsection

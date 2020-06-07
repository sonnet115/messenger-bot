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
                    <label>Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name_id"
                           placeholder="Enter user name" class="form-control" value="{{old('name')}}">
                    <p class="text-danger" id="name_error_message"></p>
                    @if($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Code<span class="text-danger">*</span></label>
                    <input type="text" name="code" id="code_id" placeholder="Enter product code" class="form-control"
                           value="{{old('code')}}">
                    <p class="text-danger" id="code_error_message"></p>
                    @if($errors->has('code'))
                        <p class="text-danger">{{ $errors->first('code') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Unit of measurement<span class="text-danger">*</span></label>
                    <input name="uom" type="text"  placeholder="Enter unit of measurement"
                           class="form-control" value="{{old('uom')}}">
                    @if($errors->has('uom'))
                        <p class="text-danger">{{ $errors->first('uom') }}</p>
                    @endif
                    <p class="text-danger" id="uom_error_message"></p>
                </div>
                <div class="form-group">
                    <label>Price<span class="text-danger">*</span></label>
                    <input type="text" placeholder="enter price" name="price" class="form-control"
                           value="{{old('price')}}" id="price_id">
                    @if($errors->has('price'))
                        <p class="text-danger">{{ $errors->first('price') }}</p>
                    @endif
                    <p id="price_error_message" class="text-danger"></p>
                </div>
                <div class="form-group">
                    <label>Stock<span class="text-danger">*</span></label>
                    <input type="text" id="stock_id"
                           placeholder="Password" name="stock" class="form-control" value="{{old('stock')}}">
                    @if($errors->has('stock'))
                        <p class="text-danger">{{ $errors->first('stock') }}</p>
                    @endif
                    <p id="stock_error_message" class="text-danger"></p>
                </div>
                <div class="clone hide">
                    <label>Product image</label>
                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                        <input type="file" name="filenames[]" class="myfrm form-control" multiple>
                    </div>
                    @if($errors->has('filenames'))
                        <p class="text-danger">{{ $errors->first('filenames') }}</p>
                    @endif
                    <p class="text-danger" id="image_error_message">{{ Session::get('error_image_count') }}</p>
                </div>
                <br>
                <button class="btn btn-primary">Add product</button>

            </form>
        </div>
    </div>
@endsection

@section('product-js')
    <script src="{{asset('assets/admin/libs/parsleyjs/parsley.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#stock_id").on("keyup", function () {
                let stock = $('input[name=stock]').val();
                if(isNaN(stock)){
                    $("#stock_error_message").html("The stock must be number");
                }
            });
            $("#price_id").on("keyup",function () {
                let price = $('input[name=price]').val();
                if (isNaN(price)) {
                    $("#price_error_message").html("The price field must be a number");
                }

            });

            $("form").submit(function () {

                let stock = $('input[name=stock]').val();
                let price = $('input[name=price]').val();
                let name = $('input[name=name]').val();
                let code=$('input[name=code]').val();
                let uom=$('input[name=uom]').val();

                let name_error_message = $("#name_error_message");
                let code_error_message = $("#code_error_message");
                let uom_error_message = $("#uom_error_message");
                let price_error_message = $("#price_error_message");
                let stock_error_message = $("#stock_error_message");

                name_error_message.html("");
                code_error_message.html("");
                uom_error_message.html("");
                price_error_message.html("");
                stock_error_message.html("");

                let error_count = 0;

                if(name===""){
                    name_error_message.html('name field is required');
                    error_count++;
                }
                if(code===""){
                    code_error_message.html('code field is required');
                    error_count++;
                }

                if(uom===""){
                    uom_error_message.html('uom field is required');
                    error_count++;
                }

                if(price===""){
                    price_error_message.html('price field is required');
                    error_count++;
                }
                if(stock===""){
                    stock_error_message.html('stock field is required');
                    error_count++;
                }

                if (isNaN(price)) {
                    price_error_message.html("The price must be a number");
                    error_count++;
                }

                if (isNaN(stock)) {
                    stock_error_message.html("The stock must be a number");
                    error_count++;
                }

             if (error_count > 0) {
                 return false;
             }

            });
        });
    </script>
@endsection

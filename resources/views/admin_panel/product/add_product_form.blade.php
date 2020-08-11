@extends("admin_panel.main")
@section("product-css")
    <link href="{{asset("assets/admin_panel/vendors/select2/dist/css/select2.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <style>
        .select2-container .select2-selection--single {
            height: 40px !important;
        }

        .select2-selection__arrow {
            top: 6px !important;
        }
    </style>
@endsection

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-30 mt-sm-30 mt-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-plus">
                    {{$product_details !== null ? "Update" : "Add New" }} Product</i>
            </h2>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-7">
                <section class="hk-sec-wrapper" style="padding-bottom: 0px">
                    <div class="row">
                        <div class="col-sm">
                            <form
                                action="{{$product_details !== null ? route('product.update') : route('product.store')}}"
                                method="post" novalidate enctype="multipart/form-data" id="order_form">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-10">Product Name<span
                                            class="text-danger font-16">*</span></label>
                                    <span class="text-muted font-12">[Max 30 Characters]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>

                                        <input type="text" id="product_name" name="product_name"
                                               placeholder="Enter Product Name" class="form-control"
                                               value="{{ $product_details !== null ? $product_details->name : old('product_name')}}">
                                    </div>
                                    <label for="product_name" class="error text-danger"></label>
                                    @if($errors->has('product_name'))
                                        <p class="text-danger font-14">{{ $errors->first('product_name') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Product Code<span
                                            class="text-danger font-16">*</span></label>
                                    <span class="text-muted font-12">[Max 15 Characters]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-present"></i></span>
                                        </div>
                                        <input type="text" id="product_code" name="product_code"
                                               placeholder="Enter Product Code" class="form-control"
                                               value="{{ $product_details !== null ? $product_details->code : old('product_code')}}">
                                    </div>
                                    <label for="product_code" class="error text-danger"></label>
                                    @if($errors->has('product_code'))
                                        <p class="text-danger font-14">{{ $errors->first('product_code') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Stock Amount</label>
                                    <span class="text-muted font-12">[Max 1,000,00]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <input type="text" id="product_stock" name="product_stock"
                                               placeholder="Enter Product Stock Amount" class="form-control"
                                               value="{{ $product_details !== null ? $product_details->stock : old('product_stock')}}">
                                    </div>
                                    <label for="product_stock" class="error text-danger"></label>
                                    @if($errors->has('product_stock'))
                                        <p class="text-danger font-14">{{ $errors->first('product_stock') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Unit of Measurement (UoM)<span
                                            class="text-danger font-16">*</span></label>
                                    <span class="text-muted font-12">[Max 10 Characters]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <input type="text" id="product_uom" name="product_uom"
                                               placeholder="Enter Product UoM" class="form-control"
                                               value="{{ $product_details !== null ? $product_details->uom : old('product_uom')}}">
                                    </div>
                                    <label for="product_uom" class="error text-danger"></label>
                                    @if($errors->has('product_uom'))
                                        <p class="text-danger font-14">{{ $errors->first('product_uom') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Product Price<span
                                            class="text-danger font-16">*</span></label>
                                    <span class="text-muted font-12">[Max 5,000,00]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <input type="text" id="product_price" name="product_price"
                                               placeholder="Enter Product Price" class="form-control"
                                               value="{{ $product_details !== null ? $product_details->price : old('product_price')}}">
                                    </div>
                                    <label for="product_price" class="error text-danger"></label>
                                    @if($errors->has('product_price'))
                                        <p class="text-danger font-14">{{ $errors->first('product_price') }}</p>
                                    @endif
                                </div>

                                <label class="control-label mb-10">Product Images<span
                                        class="text-danger font-16">*</span></label>
                                <span class="text-muted font-12">[Max 1 MB | Upload at least 1 image]</span>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <img
                                                src="{{$product_details !== null ? asset("images/products")."/".$product_details->images[0]->image_url : asset("images/products/no.png")}}"
                                                height="200" width="200" alt="N/A"
                                                style="float: left" class="mb-2 product_images">
                                            <a href="javascript:void(0)" class="btn-xs btn-danger remove_image_btn"
                                               style="float:left;margin: 5px 0 0 -25px;display: none;padding: 1px 7px">X</a>
                                        </div>

                                        <input type="file" name="product_image_1" class="image_files"/>

                                        <p class="text-danger font-14 image_error_message mb-3"></p>
                                        @if($errors->has('product_image_1'))
                                            <p class="text-danger font-14 mb-3">{{ $errors->first('product_image_1') }}</p>
                                        @endif
                                    </div>

                                    <div class="col-sm-6">
                                        <div>
                                            <img
                                                src="{{$product_details !== null ? count($product_details->images) > 1 ? asset("images/products")."/".$product_details->images[1]->image_url : asset("images/products/no.png") : asset("images/products/no.png")}}"
                                                height="200" width="200" alt="N/A"
                                                style="float: left" class="mb-2 product_images">
                                            <a href="javascript:void(0)" class="btn-xs btn-danger remove_image_btn"
                                               style="float:left;margin: 5px 0 0 -25px;display: none;padding: 1px 7px">X</a>
                                        </div>

                                        <input type="file" name="product_image_2" class="image_files"/>

                                        <p class="text-danger font-14 image_error_message mb-3"></p>
                                        @if($errors->has('product_image_2'))
                                            <p class="text-danger font-14 mb-3">{{ $errors->first('product_image_2') }}</p>
                                        @endif
                                    </div>
                                </div>

                                @if ($product_details !== null)
                                    <div class="form-group">
                                        <label class="control-label mb-10">Product State</label>
                                        <div class="d-flex flex-row justify-content-between">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-magnet"></i></span>
                                            </div>
                                            <select id="product_state" name="product_state">
                                                <option
                                                    value="0" {{$product_details->state === 0 ? "selected" : ""}}>
                                                    Inactive
                                                </option>
                                                <option
                                                    value="1" {{$product_details->state === 1 ? "selected" : ""}}>
                                                    Active
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <input type="hidden" name="product_id"
                                       value="{{$product_details !== null ? $product_details->id : ""}}">

                                <input type="hidden" name="old_product_code"
                                       value="{{$product_details !== null ? $product_details->code : ""}}">

                                <input type="hidden" name="image_1_id"
                                       value="{{$product_details !== null ? $product_details->images[0]->id : ""}}">

                                <input type="hidden" name="image_2_id"
                                       value="{{$product_details !== null ? count($product_details->images) > 1 ? $product_details->images[1]->id : "" : ""}}">
                                <hr>

                                @if (auth()->user()->page_added > 0)
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i> {{ $product_details !== null ? "Update" : "Add" }}
                                            Product
                                        </button>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-success rounded-20 pl-20 pr-20" href="javascript:void(0)" onclick="connectPage()">
                                            <i class="fa fa-facebook"></i> Connect Page to Add Product
                                        </a>
                                    </div>
                                @endif
                                <br>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- /Row -->
    </div>
    <!-- /Container -->
@endsection

@section('product-js')
    {{--Select 2--}}
    <script src="{{asset("assets/admin_panel/vendors/select2/dist/js/select2.full.min.js")}}"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#product_state').select2();

            jQuery.validator.setDefaults({
                debug: true,
                success: "valid"
            });

            $("#order_form").validate({
                rules: {
                    product_name: {
                        required: true,
                        maxlength: 30
                    },
                    product_code: {
                        required: true,
                        maxlength: 15
                    },
                    product_stock: {
                        max: 100000,
                        digits: true
                    },
                    product_uom: {
                        required: true,
                        maxlength: 10
                    },
                    product_price: {
                        required: true,
                        max: 500000,
                        number: true
                    },
                },
                messages: {
                    product_name: {
                        required: "Name is required",
                        maxlength: "Max {0} Characters"
                    },
                    product_code: {
                        required: "Code is required",
                        maxlength: "Max {0} Characters"
                    },
                    product_stock: {
                        maxlength: "Max value {0}"
                    },
                    product_uom: {
                        required: "UoM is required",
                        maxlength: "Max {0} Characters"
                    },
                    product_price: {
                        required: "Price is required",
                        maxlength: "Max value {0}"
                    },
                },
                submitHandler: function (form) {
                    form.submit();
                },
            });

            $(".image_files").on('change', function () {
                displayImage($(this));
            });

            $(".remove_image_btn").on("click", function () {
                $(this).parent().find('.product_images').attr('src', '{{asset("images/products/no.png")}}');
                $(this).parent().parent().find('.image_files').val('');
                $(this).parent().parent().find('.image_error_message').html('');
                $(this).hide();
            });

            function displayImage(input_object) {
                let input_field = input_object[0];
                let image_file = input_field.files[0];
                let file_type = image_file["type"];
                let valid_image_types = ["image/jpg", "image/jpeg", "image/png"];

                if (input_field.files && image_file && $.inArray(file_type, valid_image_types) > 0) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        input_object.parent().find('.product_images').attr('src', e.target.result);
                        input_object.parent().find('.remove_image_btn').show();
                        input_object.parent().find('.image_error_message').html('');
                    };
                    reader.readAsDataURL(input_field.files[0]); // convert to base64 string
                } else {
                    input_object.parent().find('.image_error_message').html('Invalid Image! Only png, jpg, jpeg allowed');
                }
            }
        });
    </script>
@endsection

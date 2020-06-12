@extends("admin_panel.main")

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
                            <form action="{{route('product.store')}}" method="post" novalidate
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-10">Product List</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <input type="text" name="product_name" placeholder="Enter Product Name"
                                               class="form-control"
                                               value="{{ $product_details !== null ? $product_details->name : old('product_name')}}"
                                               required>
                                    </div>
                                    <p class="text-danger" id="product_name_error_message"></p>
                                    @if($errors->has('product_name'))
                                        <p class="text-danger">{{ $errors->first('product_name') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Product Code</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-present"></i></span>
                                        </div>
                                        <input type="text" name="product_code" placeholder="Enter Product Code"
                                               class="form-control"
                                               value="{{ $product_details !== null ? $product_details->code : old('product_code')}}"
                                               required>
                                    </div>
                                    <p class="text-danger" id="product_code_error_message"></p>
                                    @if($errors->has('product_code'))
                                        <p class="text-danger">{{ $errors->first('product_code') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Stock Amount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <input type="text" name="product_stock" placeholder="Enter Product Stock Amount"
                                               class="form-control"
                                               value="{{ $product_details !== null ? $product_details->stock : old('product_stock')}}"
                                               required>
                                    </div>
                                    <p class="text-danger" id="product_stock_error_message"></p>
                                    @if($errors->has('product_stock'))
                                        <p class="text-danger">{{ $errors->first('product_stock') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Unit of Measurement (UoM)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <input type="text" name="product_uom" placeholder="Enter Product UoM"
                                               class="form-control"
                                               value="{{ $product_details !== null ? $product_details->uom : old('product_uom')}}"
                                               required>
                                    </div>
                                    <p class="text-danger" id="product_uom_error_message"></p>
                                    @if($errors->has('product_uom'))
                                        <p class="text-danger">{{ $errors->first('product_uom') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Product Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <input type="text" name="product_price" placeholder="Enter Product Price"
                                               class="form-control"
                                               value="{{ $product_details !== null ? $product_details->price : old('product_price')}}"
                                               required>
                                    </div>
                                    <p class="text-danger" id="product_price_error_message"></p>
                                    @if($errors->has('product_price'))
                                        <p class="text-danger">{{ $errors->first('product_price') }}</p>
                                    @endif
                                </div>


                                    <label class="control-label mb-10">Product Images</label>

                                    @for ($i = 0; $i < 2; $i++)
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <input type="file" name="product_images_{{$i}}" id="input-file-now"
                                                       multiple/>
                                                @if($errors->has('product_images_'.$i))
                                                    <p class="text-danger">{{ $errors->first('product_images'.$i) }}</p>
                                                @endif
                                            </div>

                                            <div class="col-sm-5 text-left">
                                                <img
                                                    src="{{$product_details !== null ? asset("images/products")."/".$product_details->images[$i]->image_url : asset("images/products/no.png")}}"
                                                    id="profile-img-tag"
                                                    height="100" width="100" alt="N/A">
                                                <a href="javascript:void(0)" class="btn-xs btn-danger"
                                                   style="display: block;width: 100px;margin: 0 auto">Delete</a>
                                            </div>
                                            <br>
                                            <br>
                                        </div>
                                    @endfor

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary mr-10">
                                        <i class="fa fa-plus-circle"></i> {{ $product_details !== null ? "Update" : "Add" }}
                                        Product
                                    </button>
                                </div>
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
    <script>
        $(document).ready(function () {
            $("#stock_id").on("keyup", function () {
                let stock = $('input[name=product_stock]').val();
                if (isNaN(stock)) {
                    $("#product_stock_error_message").html("The stock must be number");
                }
            });
            $("#price_id").on("keyup", function () {
                let price = $('input[name=product_price]').val();
                if (isNaN(price)) {
                    $("#product_price_error_message").html("The price field must be a number");
                }

            });

            $("form").submit(function () {
                let name = $('input[name=product_name]').val();
                let code = $('input[name=product_code]').val();
                let stock = $('input[name=product_stock]').val();
                let price = $('input[name=product_price]').val();
                let uom = $('input[name=product_uom]').val();

                let name_error_message = $("#product_name_error_message");
                let code_error_message = $("#product_code_error_message");
                let uom_error_message = $("#product_uom_error_message");
                let price_error_message = $("#product_price_error_message");
                let stock_error_message = $("#product_stock_error_message");

                name_error_message.html("");
                code_error_message.html("");
                uom_error_message.html("");
                price_error_message.html("");
                stock_error_message.html("");

                let error_count = 0;

                if (name === "") {
                    name_error_message.html('name field is required');
                    error_count++;
                }
                if (code === "") {
                    code_error_message.html('code field is required');
                    error_count++;
                }

                if (uom === "") {
                    uom_error_message.html('uom field is required');
                    error_count++;
                }

                if (price === "") {
                    price_error_message.html('price field is required');
                    error_count++;
                }
                if (stock === "") {
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

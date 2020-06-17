@extends("admin_panel.main")

@section('discount-css')
    <link href="{{asset("assets/admin_panel/vendors/select2/dist/css/select2.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href={{asset("assets/admin_panel/vendors/daterangepicker/daterangepicker.css")}} rel="stylesheet"
          type="text/css"/>
    <style>
        .select2-container .select2-selection--single {
            height: 40px !important;
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
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
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-plus">{{$discount_details!==null?"Update Discount":"Add Discount"}}</i>
            </h2>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-7">
                <section class="hk-sec-wrapper" style="padding-bottom: 0px">
                    <div class="row">
                        <div class="col-sm">
                            <form action="{{$discount_details!==null?route('discount.update'):route('discount.store')}}"
                                  method="post" id="discount_form">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-10">Discount name<span
                                            class="text-danger">*</span></label>
                                    <span style="font-size: 12px"> [Max 50 characters]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <input type="text" id="discount_name" name="discount_name"
                                               placeholder="Enter Discount Name" class="form-control"
                                               value="{{$discount_details!==null?$discount_details->name:old('name')}}"
                                               required>
                                    </div>
                                    <label for="discount_name" class="error text-danger"></label>
                                    @if($errors->has('discount_name'))
                                        <p class="text-danger">{{ $errors->first('discount_name') }}</p>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Discount Form<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-present"></i></span>
                                        </div>
                                        <input class="form-control discount_date" type="text" name="discount_from"
                                               value="{{$discount_details!==null?$discount_details->dis_from:old('discount_from')}}"
                                               id="discount_from"/>
                                    </div>
                                    <label for="discount_from" class="error text-danger"></label>
                                    @if($errors->has('discount_from'))
                                        <p class="text-danger">{{ $errors->first('discount_from') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Discount To<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <input class="form-control discount_date" type="text" name="discount_to"
                                               id="discount_to"
                                               value="{{$discount_details!==null?$discount_details->dis_to:old('discount_to')}}"/>
                                    </div>
                                    <label class="error text-danger" for="discount_to"></label>
                                    @if($errors->has('discount_to'))
                                        <p class="text-danger">{{ $errors->first('discount_to') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Select Product<span class="text-danger">*</span></label>
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>

                                        @if($discount_details===null)
                                            <select class="js-example-basic-multiple" name="product_id" id="product_id">
                                                <option value="" selected disabled>Choose product</option>
                                                @foreach($product_names as $names)
                                                    <option value="{{$names->id}}">{{$names->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if($discount_details!==null)
                                            <select class="js-example-basic-multiple" name="product_id" id="product_id">
                                                <option value="" selected>choose product</option>
                                                @foreach($product_names as $names)
                                                    <option
                                                        value="{{$names->id}}" {{$names->id == $discount_details->pid ? "selected": ""}}>{{$names->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <label class="error text-danger" for="product_id"></label>
                                    @if($errors->has('product_id'))
                                        <p class="text-danger">{{ $errors->first('product_id') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label class="control-label mb-10">Discounts Percentages<span
                                            class="text-danger">*</span><span
                                            style="font-size: 12px"> [Range 1% to 100%]</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <input type="text" name="discount_percentage"
                                               placeholder="Enter Product Discount Percentage" class="form-control"
                                               id="discount_percentage"
                                               value="{{$discount_details!==null?$discount_details->dis_percentage:old('discount_percentage')}}">
                                    </div>
                                    <label class="error text-danger" for="discount_percentage"></label>
                                    @if($errors->has('discount_percentage'))
                                        <p class="text-danger">{{ $errors->first('discount_percentage') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Maximum Customers</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <input type="text" name="max_customer"
                                               placeholder="Enter Product Discount Percentage" class="form-control"
                                               value="{{$discount_details!==null?$discount_details->max_customers:old('max_customer')}}">
                                    </div>

                                    @if($errors->has('max_customer'))
                                        <p class="text-danger">{{ $errors->first('max_customer') }}</p>
                                    @endif
                                </div>
                                <input type="hidden" name="discount_id"
                                       value="{{$discount_details !== null ? $discount_details->id : ""}}">

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary mr-10">
                                        {{$discount_details!==null?"Update":"Store Discount"}}
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

@section('discount-js')
    <!-- Daterangepicker JavaScript -->
    <script src={{asset("assets/admin_panel/vendors/moment/min/moment.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/daterangepicker/daterangepicker.js")}}></script>
    <script src={{asset("assets/admin_panel/dist/js/daterangepicker-data.js")}}></script>


    <!-- validation cdn--->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.discount_date').daterangepicker({

                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();

            jQuery.validator.setDefaults({
                debug: true,
                success: "valid"
            });

            $("#discount_form").validate({
                rules: {
                    discount_name: {
                        required: true,
                        maxlength: 50
                    },

                    discount_from: {
                        required: true
                    },

                    discount_to: {
                        required: true
                    },

                    product_id: {
                        required: true
                    },
                    discount_percentage: {
                        required: true,
                        min: 1,
                        max: 100
                    }
                },
                messages: {
                    discount_name: {
                        required: "Name is required",
                    },
                    discount_from: {
                        required: "Date is required",
                    },
                    discount_to: {
                        required: "Date is required",
                    },

                    product_id: {
                        required: "Product is required",
                    },
                    discount_percentage: {
                        required: "Discount percentage is required",
                        min: "minimum 1% is required",
                        max: "minimum 100% is required"

                    },
                },

                submitHandler: function (form) {
                    form.submit();
                }
            });
        });

    </script>

@endsection

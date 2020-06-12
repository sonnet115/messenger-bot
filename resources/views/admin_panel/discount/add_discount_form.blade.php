@extends("admin_panel.main")

@section('discount-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link href={{asset("assets/admin_panel/vendors/daterangepicker/daterangepicker.css")}} rel="stylesheet"
          type="text/css"/>

@endsection

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-30 mt-sm-30 mt-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-plus">Add Discount</i>
            </h2>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-7">
                <section class="hk-sec-wrapper" style="padding-bottom: 0px">
                    <div class="row">
                        <div class="col-sm">
                            <form action="{{route('discount.store')}}" method="post" novalidate
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-10">Discount name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <input type="text" name="discount_name" placeholder="Enter Discount Name" class="form-control" value="" required>
                                    </div>
                                    <p class="text-danger" id="product_name_error_message"></p>
                                    @if($errors->has('discount_name'))
                                        <p class="text-danger">{{ $errors->first('discount_name') }}</p>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Discount Form</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-present"></i></span>
                                        </div>
                                        <input class="form-control discount_date" type="text" name="discount_from"/>
                                    </div>
                                    <p class="text-danger" id="product_code_error_message"></p>
                                    @if($errors->has('discount_from'))
                                        <p class="text-danger">{{ $errors->first('discount_from') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Discount To</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <input class="form-control discount_date" type="text" name="discount_to"/>
                                    </div>
                                    <p class="text-danger" id="product_stock_error_message"></p>
                                    @if($errors->has('discount_to'))
                                        <p class="text-danger">{{ $errors->first('discount_to') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Select Product</label>
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <select class="js-example-basic-multiple" name="product_id">
                                            <option value="0">product1</option>
                                            <option value="1">user 2</option>
                                            <option value="2">watch</option>
                                            <option value="3">three piece</option>
                                        </select>
                                    </div>
                                    <p class="text-danger" id="user_role_error_message"></p>
                                    @if($errors->has('product_id'))
                                        <p class="text-danger">{{ $errors->first('product_id') }}</p>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Discounts Percentages</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <input type="text" name="discount_percentage" placeholder="Enter Product Discount Percentage" class="form-control"
                                               value="" required>
                                    </div>
                                    <p class="text-danger" id="product_price_error_message"></p>
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
                                        <input type="text" name="max_customer" placeholder="Enter Product Discount Percentage" class="form-control" value=""
                                               required>
                                    </div>
                                    <p class="text-danger" id="product_price_error_message"></p>
                                    @if($errors->has('max_customer'))
                                        <p class="text-danger">{{ $errors->first('max_customer') }}</p>
                                    @endif
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary mr-10">
                                        store discounts
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
        });

    </script>

@endsection

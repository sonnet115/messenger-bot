<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form | Shop Name</title>
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/orders/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/orders/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/orders/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/orders/css/iofrm-theme24.css">
</head>
<body style="overflow-x: hidden">

<div class="text-center" style="margin-top: 20px">
    <h3 class="text-muted">Place Order</h3>
</div>

<div class="form-body on-top" style="padding-top:0px">
    <div class="row">
        <div class="form-holder">
            <div class="form-content" style="padding: 10px">
                <div class="form-items">
                    <div class="row">
                        <div class="col-4 col-sm-4">
                            <hr>
                        </div>
                        <div class="col-4 col-sm-4 text-danger text-center">
                            Basic Info
                        </div>
                        <div class="col-4 col-sm-4">
                            <hr>
                        </div>

                        <div class="col-12 col-sm-12">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="First name"
                                   value="{{$customer_info->first_name != null ? $customer_info->first_name : ""}}"
                                   name="first_name" required>
                        </div>

                        <div class="col-12 col-sm-12">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Last name"
                                   value="{{$customer_info->last_name != null ? $customer_info->last_name : ""}}"
                                   name="last_name" required>
                        </div>

                        <div class="col-12 col-sm-12">
                            <label>Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Mobile Number"
                                   value="{{$customer_info->contact != null ? $customer_info->contact : ""}}"
                                   name="mobile_number" required>
                        </div>

                        <div class="col-12">
                            <label>Shipping Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" placeholder="Shipping Address"
                                      name="shipping_address">{{$customer_info->shipping_address != null ? $customer_info->shipping_address : ""}}</textarea>
                        </div>

                        <div class="col-12">
                            <label>Billing Address <span class="text-danger"
                                                         style="font-size: 11px">[Optional]</span></label>
                            <textarea class="form-control" placeholder="Billing Address"
                                      name="billing_address">{{$customer_info->billing_address != null ? $customer_info->billing_address : ""}}</textarea>
                        </div>

                        <div class="col-4 col-sm-4">
                            <hr>
                        </div>
                        <div class="col-4 col-sm-4 text-danger text-center">
                            Product Info
                        </div>
                        <div class="col-4 col-sm-4">
                            <hr>
                        </div>

                        <div class="col-12 col-sm-12">
                            <label>Product Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Product Code" name="product_code[]">
                        </div>

                        <div class="col-12 col-sm-12">
                            <label>Product Name <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" value="1" placeholder="Product Quantity"
                                   name="product_qty[]"
                                   required>
                        </div>

                        <div id="product_info_container" class="row" style="padding-right: 5px;padding-left: 5px">

                        </div>
                        <div class="col-12 col-sm-6 text-right" style="padding-right: 5px">
                            <button class="btn btn-sm btn-success" id="add_more_btn"
                                    style="padding: 5px 13px;font-size: 12px;border-radius: 2px">
                                <i class="fa fa-plus"></i> ADD
                            </button>
                        </div>
                        <div class="col-12 col-sm-12 text-left">
                            <div class="form-button text-left">
                                <button id="submit" type="submit" style="border-radius: 2px"
                                        class="btn btn-danger extra-padding">Order Product
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--hidden fields--}}
            <input type="hidden" value="{{$customer_info->fb_id}}" name="customer_fb_id">

        </div>
    </div>
</div>

<!-- The Modal Starts-->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 14px">

            </div>
        </div>
    </div>
</div>
<!-- The Modal Ends-->

<script src="{{env("APP_URL")}}assets/orders/js/jquery.min.js"></script>
<script src="{{env("APP_URL")}}assets/orders/js/popper.min.js"></script>
<script src="{{env("APP_URL")}}assets/orders/js/bootstrap.min.js"></script>
<script src="{{env("APP_URL")}}assets/orders/js/main.js"></script>
<script>
    $(document).ready(function () {
        $("#add_more_btn").on("click", function () {
            let product_info_field = '  <div class="col-12 col-sm-12" style="margin-top: 20px">\n' +
                '                            <label>Product Code <span class="text-danger">*</span></label>\n' +
                '                            <input type="text" class="form-control" placeholder="Product Code" name="product_code[]">\n' +
                '                       </div>\n' +
                '                       <div class="col-12 col-sm-12">\n' +
                '                            <label>Product Qty <span class="text-danger">*</span></label>\n' +
                '                            <input type="number" class="form-control" value="1" placeholder="Product Quantity" name="product_qty[]"\n' +
                '                                   required>\n' +
                '                       </div>';

            $("#product_info_container").append(product_info_field);
        });

        $("#submit").on("click", function () {
            let base_url = window.location.host;

            let first_name = $("input[name=first_name]").val();
            let last_name = $("input[name=last_name]").val();
            let mobile_number = $("input[name=mobile_number]").val();
            let shipping_address = $("textarea[name=shipping_address]").val();
            let billing_address = $("textarea[name=billing_address]").val();
            let customer_fb_id = $("input[name=customer_fb_id]").val();

            let product_code = $("input[name='product_code[]']").map(function () {
                return $(this).val();
            }).get();
            let product_qty = $("input[name='product_qty[]']").map(function () {
                return $(this).val();
            }).get();

            $.ajax({
                url: '/store-order',
                type: "GET",
                data: {
                    'first_name': first_name,
                    'last_name': last_name,
                    'mobile_number': mobile_number,
                    'shipping_address': shipping_address,
                    'billing_address': billing_address,
                    'product_code': product_code,
                    'product_qty': product_qty,
                    'customer_fb_id': customer_fb_id,
                },
                success: function (result) {
                    $(".modal-body").html(result);

                    $('#myModal').modal('toggle');

                    setTimeout(function () {
                        $('#myModal').modal('hide');
                    }, 4000);
                }
            });
        })
    })
</script>
</body>
</html>

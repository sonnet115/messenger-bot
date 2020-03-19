<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form | Shop Name</title>
    <link rel="stylesheet" type="text/css" href="{{env("TUNNEL")}}assets/orders/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{env("TUNNEL")}}assets/orders/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{env("TUNNEL")}}assets/orders/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="{{env("TUNNEL")}}assets/orders/css/iofrm-theme24.css">
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
                                   value="{{$user_info->first_name != null ? $user_info->first_name : ""}}"
                                   name="first_name" required>
                        </div>

                        <div class="col-12 col-sm-12">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Last name"
                                   value="{{$user_info->last_name != null ? $user_info->last_name : ""}}"
                                   name="last_name" required>
                        </div>

                        <div class="col-12 col-sm-12">
                            <label>Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number"
                                   required>
                        </div>

                        <div class="col-12">
                            <label>Shipping Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" placeholder="Shipping Address"
                                      name="shipping_address"></textarea>
                        </div>

                        <div class="col-12">
                            <label>Billing Address <span class="text-danger"
                                                         style="font-size: 11px">[Optional]</span></label>
                            <textarea class="form-control" placeholder="Billing Address"
                                      name="billing_address"></textarea>
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
                            <label>Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Product Name" name="product_name[]"
                                   required>
                        </div>

                        <div class="col-12 col-sm-12">
                            <label>Product Code <span class="text-danger"
                                                      style="font-size: 11px">[Optional]</span></label>
                            <input type="text" class="form-control" placeholder="Product Code" name="product_code[]">
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="validatedCustomFile"
                                       name="product_image[]">
                                <label class="custom-file-label" for="validatedCustomFile">Product Image <span
                                        class="text-danger" style="font-size: 11px">[Optional]</span></label>
                            </div>
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
        </div>
        <script src="{{env("TUNNEL")}}assets/orders/js/jquery.min.js"></script>
        <script src="{{env("TUNNEL")}}assets/orders/js/popper.min.js"></script>
        <script src="{{env("TUNNEL")}}assets/orders/js/bootstrap.min.js"></script>
        <script src="{{env("TUNNEL")}}assets/orders/js/main.js"></script>
        <script>
            $(document).ready(function () {
                $("#add_more_btn").on("click", function () {
                    let product_info_field = '<div class="col-12 col-sm-12" style="margin-top: 20px">\n' +
                        '                            <label>Product Name <span class="text-danger">*</span></label>\n' +
                        '                            <input type="text" class="form-control" placeholder="Product Name" name="product_name[]"\n' +
                        '                                   required>\n' +
                        '                        </div>\n' +
                        '                        <div class="col-12 col-sm-12">\n' +
                        '                            <label>Product Code <span class="text-danger"\n' +
                        '                                                      style="font-size: 11px">[Optional]</span></label>\n' +
                        '                            <input type="text" class="form-control" placeholder="Product Code" name="product_code[]">\n' +
                        '                        </div>\n' +
                        '                        <div class="col-12 col-sm-6">\n' +
                        '                            <div class="custom-file">\n' +
                        '                                <input type="file" class="custom-file-input" id="validatedCustomFile"\n' +
                        '                                       name="product_image[]">\n' +
                        '                                <label class="custom-file-label" for="validatedCustomFile">Product Image <span\n' +
                        '                                        class="text-danger" style="font-size: 11px">[Optional]</span></label>\n' +
                        '                            </div>\n' +
                        '                        </div>';

                    $("#product_info_container").append(product_info_field);
                });

                $("#submit").on("click", function () {
                    let first_name = $("input[name=first_name]").val();
                    let last_name = $("input[name=last_name]").val();
                    let mobile_number = $("input[name=mobile_number]").val();
                    let product_name = $("input[name=product_name]").val();
                    let product_code = $("input[name=product_code]").val();
                    let product_image = $("input[name=product_image]").val();
                    let shipping_address = $("textarea[name=shipping_address]").val();
                    let billing_address = $("textarea[name=billing_address]").val();
                })
            })
        </script>
</body>
</html>

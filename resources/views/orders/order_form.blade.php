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
                            <p id="first_name_error" class="text-danger" style="font-size: 13px"></p>
                        </div>

                        <div class="col-12 col-sm-12">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Last name"
                                   value="{{$customer_info->last_name != null ? $customer_info->last_name : ""}}"
                                   name="last_name" required>
                            <p id="last_name_error" class="text-danger" style="font-size: 13px"></p>
                        </div>

                        <div class="col-12 col-sm-12">
                            <label>Contact Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Mobile Number"
                                   value="{{$customer_info->contact != null ? $customer_info->contact : ""}}"
                                   name="contact" required>
                            <p id="contact_error" class="text-danger" style="font-size: 13px"></p>
                        </div>

                        <div class="col-12">
                            <label>Shipping Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" placeholder="Shipping Address"
                                      name="shipping_address">{{$customer_info->shipping_address != null ? $customer_info->shipping_address : ""}}</textarea>
                            <p id="shipping_address_error" class="text-danger" style="font-size: 13px"></p>
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
                            <div class="row">
                                <div class="col-6 col-sm-6">
                                    <label>Product Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Product Code"
                                           name="product_code[]"
                                           required>
                                    <p class="product_code_error text-danger" style="font-size: 13px"></p>
                                </div>

                                <div class="col-4 col-sm-4">
                                    <label>Product Qty <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Product Quantity"
                                           name="product_qty[]"
                                           required>
                                    <p class="product_qty_error text-danger" style="font-size: 13px"></p>
                                </div>
                            </div>
                        </div>

                        <div id="product_info_container" class="col-12 col-sm-12"
                             style="padding-right: 5px;padding-left: 5px">

                        </div>
                        <div class="col-12 col-sm-12 text-right" style="padding-right: 5px">
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
            let product_info_field = '<div class="row">\n' +
                '                                <div class="col-6 col-sm-6">\n' +
                '                                    <label>Product Code <span class="text-danger">*</span></label>\n' +
                '                                    <input type="text" class="form-control" placeholder="Product Code"\n' +
                '                                           name="product_code[]"\n' +
                '                                           required>\n' +
                '                                   <p class="product_code_error text-danger" style="font-size: 13px"></p>' +
                '                                </div>\n' +
                '\n' +
                '                                <div class="col-4 col-sm-4">\n' +
                '                                    <label>Product Qty <span class="text-danger">*</span></label>\n' +
                '                                    <input type="number" class="form-control" placeholder="Product Quantity"\n' +
                '                                           name="product_qty[]"\n' +
                '                                           required>\n' +
                '                                    <p class="product_qty_error text-danger" style="font-size: 13px"></p>' +
                '                                </div>\n' +
                '\n' +
                '                                <div class="col-2 col-sm-2 text-right" style="padding-right: 10px;padding-top: 30px">\n' +
                '                                    <button class="btn btn-sm btn-danger delete_btn"\n' +
                '                                            style="padding: 5px 10px;font-size: 12px;border-radius: 2px">\n' +
                '                                        <i class="fa fa-trash"></i>\n' +
                '                                    </button>\n' +
                '                                </div>\n' +
                '                            </div>\n';

            $("#product_info_container").append(product_info_field);

            $(".delete_btn").on("click", function () {
                $(this).parent().parent().remove();
            });

            $("input[name='product_code[]']").keyup(function () {
                $("#submit").attr("disabled", true);
                let product_code_container = $(this);
                product_code_container.parent().parent().find("input[name='product_qty[]']").val("");

                let error_field = product_code_container.parent().find('.product_code_error');

                let code = product_code_container.val();
                if (code === "") {
                    error_field.html("Code Cannot be empty.");
                    return false;
                } else {
                    $.ajax({
                        url: '/check-product',
                        type: "GET",
                        data: {
                            "product_code": product_code_container.val()
                        },

                        success: function (result) {
                            if (!result) {
                                error_field.html("Invalid Product Code");
                            } else {
                                let count = 0;
                                $.each($(".product_qty_error"), function () {
                                    if ($(this).html() !== "") {
                                        count++;
                                    }
                                });

                                if (count === 0) {
                                    $("#submit").attr("disabled", false);
                                }
                                error_field.html("");
                            }
                        }
                    });
                }
            });

            $("input[name='product_qty[]']").keyup(function () {
                $("#submit").attr("disabled", true);

                let product_qty_container = $(this);
                let qty = product_qty_container.val();
                let error_code_field = product_qty_container.parent().parent().find('.product_code_error').html();
                let error_field = product_qty_container.parent().find('.product_qty_error');
                let code = product_qty_container.parent().parent().find("input[name='product_code[]']").val();

                if (code === "" || error_code_field !== "") {
                    error_field.html("Please enter valid product code");
                    return false;
                }

                if (qty === "") {
                    error_field.html("Qty Cannot be empty.");
                    return false;
                } else if (!/^[1-9][0-9]*$/.test(qty)) {
                    error_field.html("Qty will contain only digits (1-9).");
                    return false;
                } else {
                    $.ajax({
                        url: '/check-qty',
                        type: "GET",
                        data: {
                            "product_code": code
                        },

                        success: function (result) {
                            if (parseInt(qty) > parseInt(result.stock)) {
                                error_field.html("Not enough in stock.");
                            } else {
                                let count = 0;
                                $.each($(".product_code_error"), function () {
                                    if ($(this).html() !== "") {
                                        count++;
                                    }
                                });

                                if (count === 0) {
                                    $("#submit").attr("disabled", false);
                                }
                                error_field.html("");
                            }
                        }
                    });
                }
            });
        });

        $("#submit").on("click", function () {
            let first_name = $("input[name=first_name]").val();
            let last_name = $("input[name=last_name]").val();
            let contact = $("input[name=contact]").val();
            let shipping_address = $("textarea[name=shipping_address]").val();
            let billing_address = $("textarea[name=billing_address]").val();
            let customer_fb_id = $("input[name=customer_fb_id]").val();

            let product_code = $("input[name='product_code[]']").map(function () {
                return $(this).val();
            }).get();
            let product_qty = $("input[name='product_qty[]']").map(function () {
                return $(this).val();
            }).get();


            if (!validate("First Name", first_name, "first_name_error", 1)) {
                return;
            }

            if (!validate("Last Name", last_name, "last_name_error", 1)) {
                return;
            }

            if (!validate("Contact Number", contact, "contact_error", 3)) {
                return;
            }

            if (!validate("Shipping Address", shipping_address, "shipping_address_error", 2)) {
                return;
            }

            $.ajax({
                url: '/store-order',
                type: "GET",
                data: {
                    'first_name': first_name,
                    'last_name': last_name,
                    'contact': contact,
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
        });

        $("input[name='product_code[]']").keyup(function () {
            $("#submit").attr("disabled", true);
            let product_code_container = $(this);
            product_code_container.parent().parent().find("input[name='product_qty[]']").val("");

            let error_field = product_code_container.parent().find('.product_code_error');

            let code = product_code_container.val();
            if (code === "") {
                error_field.html("Code Cannot be empty.");
                return false;
            } else {
                $.ajax({
                    url: '/check-product',
                    type: "GET",
                    data: {
                        "product_code": product_code_container.val()
                    },

                    success: function (result) {
                        if (!result) {
                            error_field.html("Invalid Product Code");
                        } else {
                            let count = 0;
                            $.each($(".product_qty_error"), function () {
                                if ($(this).html() !== "") {
                                    count++;
                                }
                            });

                            if (count === 0) {
                                $("#submit").attr("disabled", false);
                            }
                            error_field.html("");
                        }
                    }
                });
            }
        });

        $("input[name='product_qty[]']").keyup(function () {
            $("#submit").attr("disabled", true);

            let product_qty_container = $(this);
            let qty = product_qty_container.val();
            let error_code_field = product_qty_container.parent().parent().find('.product_code_error').html();
            let error_field = product_qty_container.parent().find('.product_qty_error');
            let code = product_qty_container.parent().parent().find("input[name='product_code[]']").val();

            if (code === "" || error_code_field !== "") {
                error_field.html("Please enter valid product code");
                return false;
            }

            if (qty === "") {
                error_field.html("Qty Cannot be empty.");
                return false;
            } else if (!/^[1-9][0-9]*$/.test(qty)) {
                error_field.html("Qty will contain only digits (1-9).");
                return false;
            } else {
                $.ajax({
                    url: '/check-qty',
                    type: "GET",
                    data: {
                        "product_code": code
                    },

                    success: function (result) {
                        if (parseInt(qty) > parseInt(result.stock)) {
                            error_field.html("Not enough in stock.");
                        } else {
                            let count = 0;
                            $.each($(".product_code_error"), function () {
                                if ($(this).html() !== "") {
                                    count++;
                                }
                            });

                            if (count === 0) {
                                $("#submit").attr("disabled", false);
                            }
                            error_field.html("");
                        }
                    }
                });
            }
        });

        function validate(field_name, value, error_field, validation_type) {
            switch (validation_type) {
                case 1:
                    if (value === "") {
                        $('#' + error_field).html(field_name + " cannot be empty.");
                        return false;
                    } else if (!/^[a-zA-Z\s]+$/.test(value)) {
                        $('#' + error_field).html(field_name + " will only contain alphabet.");
                        return false;
                    } else {
                        $('#' + error_field).html("");
                        return true;
                    }
                    break;

                case 2:
                    if (value === "") {
                        $('#' + error_field).html(field_name + " cannot be empty.");
                        return false;
                    } else {
                        $('#' + error_field).html("");
                        return true;
                    }
                    break;
                case 3:
                    if (!/\+?(88)?0?1[56789][0-9]{8}\b/g.test(value)) {
                        $('#' + error_field).html(field_name + " is invalid");
                        return false;
                    } else if (value === "") {
                        $('#' + error_field).html(field_name + " cannot be empty.");
                        return false;
                    } else {
                        $('#' + error_field).html("");
                        return true;
                    }
                    break;
            }

        }
    })
</script>
</body>
</html>

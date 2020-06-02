<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form | Shop Name</title>
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/bot/orders/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/bot/orders/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/bot/orders/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/bot/orders/css/iofrm-theme24.css">
    <style>
        .product_details {
            font-size: 13px !important;
            margin: 5px 0px !important;
            font-weight: 700;
        }

        .basic_info {
            display: none;
        }

        .outline_btn {
            border: 1px solid !important;
        }
    </style>
</head>
<body style="overflow-x: hidden">

<div class="text-center" style="margin-top: 20px">
    <h3 class="text-muted">Checkout</h3>
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
                        <div class="col-4 col-sm-4 text-muted text-center">
                            Cart Info
                        </div>
                        <div class="col-4 col-sm-4">
                            <hr>
                        </div>

                        <div id="product_info_container" class="col-12 col-sm-12" style="margin-bottom: 20px">

                        </div>

                        <div class="col-4 col-sm-4 basic_info">
                            <hr>
                        </div>
                        <div class="col-4 col-sm-4 text-muted text-center basic_info">
                            Basic Info
                        </div>
                        <div class="col-4 col-sm-4 basic_info">
                            <hr>
                        </div>

                        <div class="col-12 col-sm-12 basic_info">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="First name"
                                   value="{{$customer_info->first_name != null ? $customer_info->first_name : ""}}"
                                   name="first_name" required>
                            <p id="first_name_error" class="text-danger" style="font-size: 13px"></p>
                        </div>

                        <div class="col-12 col-sm-12 basic_info">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Last name"
                                   value="{{$customer_info->last_name != null ? $customer_info->last_name : ""}}"
                                   name="last_name" required>
                            <p id="last_name_error" class="text-danger" style="font-size: 13px"></p>
                        </div>

                        <div class="col-12 col-sm-12 basic_info">
                            <label>Contact Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Mobile Number"
                                   value="{{$customer_info->contact != null ? $customer_info->contact : ""}}"
                                   name="contact" required>
                            <p id="contact_error" class="text-danger" style="font-size: 13px"></p>
                        </div>

                        <div class="col-12 basic_info">
                            <label>Shipping Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" placeholder="Shipping Address"
                                      name="shipping_address">{{$customer_info->shipping_address != null ? $customer_info->shipping_address : ""}}</textarea>
                            <p id="shipping_address_error" class="text-danger" style="font-size: 13px"></p>
                        </div>

                        <div class="col-12 basic_info">
                            <label>Billing Address <span class="text-danger"
                                                         style="font-size: 11px">[Optional]</span></label>
                            <textarea class="form-control" placeholder="Billing Address"
                                      name="billing_address">{{$customer_info->billing_address != null ? $customer_info->billing_address : ""}}</textarea>
                        </div>

                        <div class="col-12 col-sm-12 basic_info">
                            <div class="form-button text-center">
                                <button id="submit" type="submit" style="border-radius: 20px" class="btn btn-success">
                                    <i class="fa fa-clipboard-check"></i> Confirm Order
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

<!-- The Notification Modal Starts-->
<div class="modal fade" id="notification_modal">
    <div class="modal-dialog modal-dialog-centered" style="padding: 10px;">
        <div class="modal-content">
            <div class="modal-body shadow-lg" style="font-size: 14px;padding: 10px 10px 0px 10px;">
                <p id="notification_modal_body" class="text-center"></p>
            </div>
        </div>
    </div>
</div>
<!-- The Notification Modal Ends-->

<script src="{{env("APP_URL")}}assets/bot/orders/js/jquery.min.js"></script>
<script src="{{env("APP_URL")}}assets/bot/orders/js/popper.min.js"></script>
<script src="{{env("APP_URL")}}assets/bot/orders/js/bootstrap.min.js"></script>
<script src="{{env("APP_URL")}}assets/bot/orders/js/main.js"></script>
<script>
    $(document).ready(function () {
        let customer_fb_id = $("input[name=customer_fb_id]").val();
        let product_search_url = '{{env("APP_URL")."product-search-form/"}}' + customer_fb_id;

        $.ajax({
            url: '/get-cart-products',
            type: "GET",
            data: {
                "customer_fb_id": customer_fb_id
            },

            success: function (result) {
                $("#product_info_container").html("");
                if (result.length > 0) {
                    for (let i = 0; i < result.length; i++) {
                        let delete_btn_content = deleteButton(result[i].products.code);
                        let increment_decrement_btn_content = incrementDecrementButton(result[i].products.code);
                        let product_details_content = productDetails(result[i].products.name, result[i].products.code, result[i].products.price);

                        let cart_products = '<div style="padding: 10px 0px;">' +
                            '                      <div class="card shadow" style="padding: 10px 0px;">\n' +
                            '                           <div class="row">\n' +
                            '' + delete_btn_content +
                            '' + product_details_content +
                            '' + increment_decrement_btn_content +
                            '                           </div>\n' +
                            '                      </div>\n' +
                            '                 </div>';

                        $("#product_info_container").append(cart_products);

                        $("#delete_btn_" + result[i].products.code).on("click", function () {
                            let delete_btn = $(this);
                            $.ajax({
                                url: '/remove-cart-product',
                                type: "GET",
                                data: {
                                    "product_code": result[i].products.code,
                                    "customer_fb_id": customer_fb_id
                                },

                                success: function (result, jqXHR) {
                                    delete_btn.parent().parent().parent().parent().hide(500, function () {
                                        $(this).remove();
                                        let count = $("#product_info_container").children().length;

                                        if (count < 2) {
                                            $("#product_info_container").html("");
                                            let add_more_product = noProductFound(product_search_url);
                                            $("#product_info_container").append(add_more_product);
                                            $(".basic_info").hide(500);
                                        }
                                    });
                                },
                                error: function (error, jqXHR) {
                                    showNotification(error.responseJSON, "text-danger", 2000);
                                }
                            });

                        });

                        $("#increment_btn_" + result[i].products.code).on("click", function () {
                            $("#submit").attr("disabled", true);
                            let increment_btn = $(this);
                            let decrement_btn = $("#decrement_btn_" + result[i].products.code);
                            increment_btn.attr("disabled", true);

                            let qty_container = $(this).parent().find('.product_qty');
                            let qty_input_field = $(this).parent().find('#qty_' + result[i].products.code);
                            let new_qty = parseInt(qty_container.text()) + 1;
                            $.ajax({
                                url: '/check-qty',
                                type: "GET",
                                data: {
                                    "product_code": result[i].products.code
                                },

                                success: function (result) {
                                    if (new_qty > parseInt(result.stock)) {
                                        showNotification("Not enough in stock", "text-danger", 3000);
                                    } else {
                                        qty_container.html(new_qty);
                                        qty_input_field.val(new_qty);
                                        increment_btn.attr("disabled", false);
                                        decrement_btn.attr("disabled", false);
                                    }
                                    $("#submit").attr("disabled", false);
                                }
                            });
                        });

                        $("#decrement_btn_" + result[i].products.code).on("click", function () {
                            $("#submit").attr("disabled", true);
                            let decrement_btn = $(this);
                            let increment_btn = $("#increment_btn_" + result[i].products.code);
                            decrement_btn.attr("disabled", true);

                            let qty_container = $(this).parent().find('.product_qty');
                            let qty_input_field = $(this).parent().find('#qty_' + result[i].products.code);
                            let new_qty = parseInt(qty_container.text()) - 1;

                            if (new_qty <= 0) {
                                qty_container.html(1);
                                qty_input_field.val(1);
                                $("#submit").attr("disabled", false);
                            } else {
                                $.ajax({
                                    url: '/check-qty',
                                    type: "GET",
                                    data: {
                                        "product_code": result[i].products.code
                                    },

                                    success: function (result) {
                                        if (new_qty > parseInt(result.stock)) {
                                            showNotification("Not enough in stock", "text-danger", 3000);
                                        } else {
                                            qty_container.html(new_qty);
                                            qty_input_field.val(new_qty);
                                            decrement_btn.attr("disabled", false);
                                            increment_btn.attr("disabled", false);
                                        }
                                        $("#submit").attr("disabled", false);
                                    }
                                });

                            }
                        });
                    }

                    let add_more_product = addMoreAndCheckoutButton(product_search_url);

                    $("#product_info_container").append(add_more_product);

                    $("#checkout_btn").on("click", function () {
                        $(".basic_info").show(1000);
                    });

                    $("#submit").on("click", function () {
                        $(this).attr("disabled", true);

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
                            url: '/order-store',
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
                                showNotification(result, "text-success", 4000);
                                setTimeout(function () {
                                    $("#product_info_container").html("");
                                    let add_more_product = noProductFound(product_search_url);
                                    $("#product_info_container").append(add_more_product);
                                    $(".basic_info").hide(500);
                                }, 5000);
                            }
                        });
                    });
                } else {
                    let no_product = noProductFound(product_search_url);
                    $("#product_info_container").html(no_product);
                }
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
            }

        }

        function deleteButton(product_code) {
            return '<div class="col-2 col-sm-2 text-right" style="padding: 30px 10px 0 25px">\n' +
                '        <button id="delete_btn_' + product_code + '" class="btn btn-sm btn-danger"\n' +
                '            style="padding: 5px 10px;font-size: 12px;border-radius: 2px">\n' +
                '             <i class="fa fa-trash-alt"></i>\n' +
                '         </button>\n' +
                '   </div>\n';
        }

        function productDetails(name, code, price) {
            return '<div class="col-7 col-sm-7">\n' +
                '        <p class="product_details"><b class="text-primary"> Name:</b> ' + name + '\n' +
                '        </p>\n' +
                '        <p class="product_details"><b class="text-primary"> Code:</b> ' + code + ' </p>\n' +
                '        <p class="product_details"><b class="text-primary"> Price:</b> ' + price + ' </p>\n' +
                '        <input type="hidden" class="form-control" placeholder="Product Code" required\n' +
                '                                               name="product_code[]" value="' + code + '">\n' +
                '   </div>\n';
        }

        function incrementDecrementButton(product_code) {
            return '<div class="col-3 col-sm-3 text-right" style="padding-right: 25px">\n' +
                '        <button id="increment_btn_' + product_code + '" class="outline_btn btn btn-sm btn-outline-success shadow-sm"\n' +
                '               style="padding: 5px 10px;font-size: 12px;border-radius: 2px">\n' +
                '               <i class="fa fa-plus-square"></i>\n' +
                '        </button>\n' +
                '        <p style="text-align: center;font-size: 15px;margin: 5px 5px 5px 0" class="product_qty">1</p>\n' +
                '        <input type="hidden" class="form-control" placeholder="Product Qty" required\n' +
                '                                               name="product_qty[]" id="qty_' + product_code + '">\n' +
                '        <button id="decrement_btn_' + product_code + '" class="outline_btn btn btn-sm btn-outline-danger shadow-sm"\n' +
                '                style="padding: 5px 10px;font-size: 12px;border-radius: 2px;">\n' +
                '                <i class="fa fa-minus-square"></i>\n' +
                '        </button>\n' +
                '   </div>\n';
        }

        function showNotification(message, text_class, display_time) {
            $("#notification_modal").modal('toggle');

            $("#notification_modal_body").html(message);
            $("#notification_modal_body").addClass(" " + text_class);

            setTimeout(function () {
                $('#notification_modal').modal('hide');
            }, display_time);
        }

        function addMoreAndCheckoutButton(more_product_url) {
            return '<div class="row" style="margin-top: 20px">\n' +
                '         <div class="col-6 col-sm-6" style="margin-bottom: 20px;">\n' +
                '              <a href="' + more_product_url + '" style="border-radius: 50px;"\n' +
                '                  class="btn btn-outline-primary outline_btn">\n' +
                '                  <i class="fa fa-shopping-cart"></i> More Products\n' +
                '              </a>\n' +
                '         </div>\n' +
                '         <div class="col-6 col-sm-6 text-right" style="margin-bottom: 20px;">\n' +
                '              <button id="checkout_btn" style="border-radius: 50px;"\n' +
                '                    class="btn btn-outline-success outline_btn">\n' +
                '                     <i class="fa fa-check-circle"></i> Checkout\n' +
                '               </button>\n' +
                '         </div>\n' +
                '   </div>';
        }

        function noProductFound(product_search_url) {
            return '<p class="text-danger text-center" style="font-size: 14px;margin-bottom: 10px">No products are found in cart</p>\n' +
                '   <div class="text-center" style="margin-bottom: 20px">\n' +
                '         <a href="' + product_search_url + '" style="border-radius: 50px;color: white" class="btn btn-success">\n' +
                '              <i class="fa fa-shopping-cart"></i> Add Products\n' +
                '         </a>\n' +
                '   </div>';
        }
    });
</script>
</body>
</html>

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

<div class="form-body on-top" style="padding-top:0px">
    <div class="row">
        <div class="form-holder">
            <div class="form-content" style="padding: 10px">
                <div class="form-items">
                    <div class="row">
                        <div class="col-3 col-sm-3">
                            <hr>
                        </div>
                        <div class="col-6 col-sm-6 text-danger text-center">
                            Track Order
                        </div>
                        <div class="col-3 col-sm-3">
                            <hr>
                        </div>

                        <div class="col-12 col-sm-12">
                            <label>Order Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter Order Code..."
                                   name="order_code" required>
                            <p id="order_code_error" class="text-danger" style="font-size: 13px"></p>
                        </div>

                        <div class="col-12 col-sm-12 text-center">
                            <button id="search" class="btn btn-success" style="border-radius: 5px;padding: 10px 20px"><i
                                    class="fa fa-search"></i> Track Order
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Starts-->
<div class="modal fade" id="order_details_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">You Order Code "<span id="searched_order_code"></span>"</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <div class="container" id="order_status_container">
                    {{--Order Details will be displayed here--}}
                </div>
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
        $("#search").on('click', function () {
            let order_code = $("input[name='order_code']").val();
            $("#searched_order_code").html(order_code);

            $.ajax({
                url: '/get-order-status',
                type: "GET",
                data: {
                    'order_code': order_code,
                },
                success: function (result) {
                    $("#order_status_container").html("");
                    console.log(result);
                    if (result.length > 0) {
                        let products = productDetails(result);
                        $("#order_status_container").append(products);
                    } else {
                        $("#order_status_container").append('<p class="text-danger text-center">No order found</p>');
                    }

                    $("#order_details_modal").modal('toggle');
                }
            });

        })
    })

    function orderStatus(status_code) {
        let status = "Pending";
        let color = "text-danger";

        if (status_code === 1) {
            status = "Processing";
            color = "text-primary";
        } else if (status_code === 2) {
            status = "On the way";
            color = "text-warning";
        } else if (status_code === 3) {
            status = "Delivered";
            color = "text-success";
        } else if (status_code === 4) {
            status = "Cancelled";
            color = "text-danger";
        }

        return '<span style="margin-left: 15px" class="' + color + '">' + status + '</span>\n'
    }

    function productDetails(products) {
        let product = "";

        for (let i = 0; i < products.length; i++) {
            product += '<div class="row">\n' +
                '        <div class="col-sm-12">\n' +
                '             <p><strong>Product Name:</strong> <span>' + products[i].products.name + '</span>' + orderStatus(products[i].order_status) + '</p>\n' +
                '             <p><strong>Product Qty: </strong> <span>' + products[i].product_qty + '</span></p>\n' +
                '        </div>\n' +
                '  </div>';
        }
        return product;
    }
</script>
</body>
</html>

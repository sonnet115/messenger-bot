<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form | Shop Name</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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
                        <div class="col-6 col-sm-6">
                            <h3 class="text-danger text-center">Your Orders</h3>
                        </div>
                        <div class="col-3 col-sm-3">
                            <hr>
                        </div>

                        {{--                        <div class="col-12 col-sm-12">--}}
                        {{--                            <label>Order Code <span class="text-danger">*</span></label>--}}
                        {{--                            <input type="text" class="form-control" placeholder="Enter Order Code..."--}}
                        {{--                                   name="order_code" required>--}}
                        {{--                            <p id="order_code_error" class="text-danger" style="font-size: 13px"></p>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="col-12 col-sm-12 text-center">--}}
                        {{--                            <button id="search" class="btn btn-success" style="border-radius: 5px;padding: 10px 20px"><i--}}
                        {{--                                    class="fa fa-search"></i> Track Order--}}
                        {{--                            </button>--}}
                        {{--                        </div>--}}

                        <div class="row" style="margin:0 auto">
                            <div id="accordion" style="padding: 10px">
                                <?php
                                $duplicate_order_code = "";
                                ?>
                                @foreach($orders as $order)
                                    @if($duplicate_order_code !== $order->order_code)
                                        <div class="card shadow" style="min-width: 400px">
                                            <div class="card-header">
                                                <a class="card-link code_container"
                                                   href="#order_{{$order->order_code}}">
                                                    ORDER CODE: <span
                                                        class="text-muted code">{{$order->order_code}}</span>
                                                </a>
                                            </div>
                                            <div id="order_{{$order->order_code}}"
                                                 class="collapse"
                                                 data-parent="#accordion">
                                                <div class="card-body"
                                                     id="order_status_container_{{$order->order_code}}">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <p><strong>Product Name:</strong> <span></span>
                                                            </p>
                                                            <p><strong>Product Qty: </strong> <span></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <?php
                                        $duplicate_order_code = $order->order_code
                                        ?>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".code_container").on('click', function () {
            // let order_code = $("input[name='order_code']").val();
            let order_code = $(this).find('.code').html();
            let code_container = $(this);
            $("#searched_order_code").html(order_code);

            if ($("#order_status_container_" + order_code).children().length <= 0) {
                $.ajax({
                    url: '/get-order-status',
                    type: "GET",
                    data: {
                        'order_code': order_code,
                    },
                    success: function (result) {
                        console.log(result);
                        $("#order_status_container_" + order_code).html("");
                        if (result.length > 0) {
                            let products = productDetails(result);
                            $("#order_status_container_" + order_code).append(products);
                        } else {
                            $("#order_status_container_" + order_code).append('<p class="text-danger text-center">No order found</p>');
                        }
                        $('#order_' + order_code).collapse('toggle');
                    }
                });
            }else{
                $('#order_' + order_code).collapse('toggle');
            }

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

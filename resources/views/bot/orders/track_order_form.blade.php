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

    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/bot/orders/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/bot/orders/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/bot/orders/css/iofrm-theme24.css">
    <style>
        .ordered_products {
            font-size: 13px !important;
            margin: 5px 0 !important;
        }
        .sk-circle {
            position: absolute;
            top: 48%;
            left: 48%;
            width: 40px;
            height: 40px;
        }

        .sk-circle .sk-child {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
        }

        .sk-circle .sk-child:before {
            content: '';
            display: block;
            margin: 0 auto;
            width: 15%;
            height: 15%;
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
            animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
        }

        .sk-circle .sk-circle2 {
            -webkit-transform: rotate(30deg);
            -ms-transform: rotate(30deg);
            transform: rotate(30deg);
        }

        .sk-circle .sk-circle3 {
            -webkit-transform: rotate(60deg);
            -ms-transform: rotate(60deg);
            transform: rotate(60deg);
        }

        .sk-circle .sk-circle4 {
            -webkit-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            transform: rotate(90deg);
        }

        .sk-circle .sk-circle5 {
            -webkit-transform: rotate(120deg);
            -ms-transform: rotate(120deg);
            transform: rotate(120deg);
        }

        .sk-circle .sk-circle6 {
            -webkit-transform: rotate(150deg);
            -ms-transform: rotate(150deg);
            transform: rotate(150deg);
        }

        .sk-circle .sk-circle7 {
            -webkit-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        .sk-circle .sk-circle8 {
            -webkit-transform: rotate(210deg);
            -ms-transform: rotate(210deg);
            transform: rotate(210deg);
        }

        .sk-circle .sk-circle9 {
            -webkit-transform: rotate(240deg);
            -ms-transform: rotate(240deg);
            transform: rotate(240deg);
        }

        .sk-circle .sk-circle10 {
            -webkit-transform: rotate(270deg);
            -ms-transform: rotate(270deg);
            transform: rotate(270deg);
        }

        .sk-circle .sk-circle11 {
            -webkit-transform: rotate(300deg);
            -ms-transform: rotate(300deg);
            transform: rotate(300deg);
        }

        .sk-circle .sk-circle12 {
            -webkit-transform: rotate(330deg);
            -ms-transform: rotate(330deg);
            transform: rotate(330deg);
        }

        .sk-circle .sk-circle2:before {
            -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s;
        }

        .sk-circle .sk-circle3:before {
            -webkit-animation-delay: -1s;
            animation-delay: -1s;
        }

        .sk-circle .sk-circle4:before {
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s;
        }

        .sk-circle .sk-circle5:before {
            -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s;
        }

        .sk-circle .sk-circle6:before {
            -webkit-animation-delay: -0.7s;
            animation-delay: -0.7s;
        }

        .sk-circle .sk-circle7:before {
            -webkit-animation-delay: -0.6s;
            animation-delay: -0.6s;
        }

        .sk-circle .sk-circle8:before {
            -webkit-animation-delay: -0.5s;
            animation-delay: -0.5s;
        }

        .sk-circle .sk-circle9:before {
            -webkit-animation-delay: -0.4s;
            animation-delay: -0.4s;
        }

        .sk-circle .sk-circle10:before {
            -webkit-animation-delay: -0.3s;
            animation-delay: -0.3s;
        }

        .sk-circle .sk-circle11:before {
            -webkit-animation-delay: -0.2s;
            animation-delay: -0.2s;
        }

        .sk-circle .sk-circle12:before {
            -webkit-animation-delay: -0.1s;
            animation-delay: -0.1s;
        }

        @-webkit-keyframes sk-circleBounceDelay {
            0%, 80%, 100% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }
            40% {
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes sk-circleBounceDelay {
            0%, 80%, 100% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }
            40% {
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        .spinner-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ff6347;
            z-index: 999999;
        }
    </style>
</head>
<body style="overflow-x: hidden">
<div class="spinner-wrapper">
    <div class="sk-circle">
        <div class="sk-circle1 sk-child"></div>
        <div class="sk-circle2 sk-child"></div>
        <div class="sk-circle3 sk-child"></div>
        <div class="sk-circle4 sk-child"></div>
        <div class="sk-circle5 sk-child"></div>
        <div class="sk-circle6 sk-child"></div>
        <div class="sk-circle7 sk-child"></div>
        <div class="sk-circle8 sk-child"></div>
        <div class="sk-circle9 sk-child"></div>
        <div class="sk-circle10 sk-child"></div>
        <div class="sk-circle11 sk-child"></div>
        <div class="sk-circle12 sk-child"></div>
    </div>
</div>

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

                        <div class="row" style="margin:0 auto">
                            <div id="accordion" style="padding: 10px">
                                <?php
                                $duplicate_order_code = "";
                                ?>
                                @foreach($orders as $order)
                                    @if($duplicate_order_code !== $order->order_code)
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <a class="text-muted text-center card-link code_container"
                                                   href="#order_{{$order->order_code}}">
                                                    ORDER CODE: <span
                                                        class="text-dark code">{{$order->order_code}}</span>
                                                </a>
                                            </div>
                                            <div id="order_{{$order->order_code}}"
                                                 class="collapse"
                                                 data-parent="#accordion">
                                                <div class="card-body"
                                                     id="order_status_container_{{$order->order_code}}">
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
        let preloaderFadeOutTime = 1000;

        function hidePreloader() {
            let preloader = $('.spinner-wrapper');
            preloader.fadeOut(preloaderFadeOutTime);
        }

        hidePreloader();

        $(".code_container").on('click', function () {
            let order_code = $(this).find('.code').html();
            $("#searched_order_code").html(order_code);

            if ($("#order_status_container_" + order_code).children().length <= 0) {
                $.ajax({
                    url: '/bot/get-order-status',
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
            } else {
                $('#order_' + order_code).collapse('toggle');
            }

        })
    })

    function orderStatus(status_code) {
        let status = "Pending";
        let color = "badge-danger";

        if (status_code === 1) {
            status = "Processing";
            color = "badge-primary";
        } else if (status_code === 2) {
            status = "On the way";
            color = "badge-warning";
        } else if (status_code === 3) {
            status = "Delivered";
            color = "badge-success";
        } else if (status_code === 4) {
            status = "Cancelled";
            color = "badge-danger";
        }

        return '<p class="ordered_products"><b>Status: </b> <span style="padding: 3px 10px" class="badge badge-pill ' + color + '">' + status + '</span></p>';
    }

    function productDetails(products) {
        let product = "";

        for (let i = 0; i < products.length; i++) {
            product += '<div class="row" style="padding: 10px">\n' +
                '        <div class="col-sm-12 card shadow" style="padding: 10px">\n' +
                '             <p class="ordered_products"><b>Product Name:</b>' + products[i].products.name + '</span></p>\n' +
                '             <p class="ordered_products"><b>Product Qty: </b> <span class="badge badge-pill badge-dark">' + products[i].product_qty + '</span></p>\n' +
                '' + orderStatus(products[i].order_status) +
                '        </div>\n' +
                '  </div>';
        }
        return product;
    }
</script>
</body>
</html>

@extends('bot.main')

@section('main-content')
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
                                    @foreach($orders as $order)
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <a class="text-muted text-center card-link code_container"
                                                   href="#order_{{$order->code}}">
                                                    ORDER CODE: <span
                                                        class="text-dark code">{{$order->code}}</span>
                                                </a>
                                            </div>
                                            <div id="order_{{$order->code}}" class="collapse" data-parent="#accordion">
                                                <div class="card-body" id="order_status_container_{{$order->code}}">
                                                </div>
                                                <div id="total_calculation_container" class="col-12 col-sm-12"
                                                     style="margin-bottom: 20px">
                                                    {{--<div class="row">
                                                        <div class="col-6">
                                                            <p class="total_title">Subtotal: </p>
                                                            <p class="total_title">Discount: </p>
                                                            <p class="total_title">Delivery Charge:</p>
                                                            <hr>
                                                            <p class="total_title"><b>Total: </b></p>
                                                        </div>
                                                        <div class="col-5">
                                                            <p class="total_value"><span id="subtotal">100000 </span> Tk
                                                            </p>
                                                            <p class="total_value">-<span id="discount">100000 </span>
                                                                Tk</p>
                                                            <p class="total_value">+<span
                                                                    id="delivery_charge_value">0 </span> Tk</p>
                                                            <hr>
                                                            <p class="total_value"><b id="total">100060 </b> Tk</p>
                                                        </div>
                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{$app_id}}" id="app_id">
@endsection

@section('track-order-js')
    <script>
        $(document).ready(function () {
            let base_url = '{{env("APP_URL")}}';

            let preloaderFadeOutTime = 1000;

            function hidePreloader() {
                let preloader = $('.spinner-wrapper');
                preloader.fadeOut(preloaderFadeOutTime);
            }

            hidePreloader();

            $(".code_container").on('click', function () {
                let order_code = $(this).find('.code').html();
                $("#searched_order_code").html(order_code);

                let code_container = $(this);
                code_container.html("<p style='font-size:17px' class='text-center text-success'>Loading order <i class='fas fa-spinner fa-pulse'></i></p>")

                if ($("#order_status_container_" + order_code).children().length <= 0) {
                    $.ajax({
                        url: base_url + 'bot/' + $("#app_id").val() + '/get-order-status',
                        type: "GET",
                        data: {
                            'order_code': order_code,
                        },
                        success: function (result) {
                            console.log(result);
                            $("#order_status_container_" + order_code).html("");
                            if (result.ordered_products.length > 0) {
                                let products = productDetails(result.ordered_products, result.delivery_charge);
                                $("#order_status_container_" + order_code).append(products);
                            } else {
                                $("#order_status_container_" + order_code).append('<p class="text-danger text-center">No Products found</p>');
                            }
                            $('#order_' + order_code).collapse('toggle');
                            code_container.html("ORDER CODE: <span class='text-dark code'>" + order_code + "</span>");
                        }
                    });
                } else {
                    code_container.html("ORDER CODE: <span class='text-dark code'>" + order_code + "</span>");
                    $('#order_' + order_code).collapse('toggle');
                }

            })
        })

        function orderStatus(status_code) {
            let status = "Pending";
            let color = "badge-danger";

            if (status_code === 0) {
                status = "Pending";
                color = "badge-info";
            } else if (status_code === 1) {
                status = "Processing";
                color = "badge-primary";
            } else if (status_code === 2) {
                status = "Shipping";
                color = "badge-warning";
            } else if (status_code === 3) {
                status = "Delivered";
                color = "badge-success";
            } else if (status_code === 4) {
                status = "Cancelled";
                color = "badge-danger";
            }

            return '<p class="product_details"><b>Status: </b> <span style="padding: 3px 10px" class="badge badge-pill ' + color + '">' + status + '</span></p>';
        }

        function productDetails(products, delivery_charge) {
            let product = "";
            let subtotal = 0;
            let discount = 0;

            for (let i = 0; i < products.length; i++) {
                let discount_info = ''
                if (products[i].pivot.discount != 0) {
                    discount_info = '<p class="product_details text-success"><b>Discount: </b>' + products[i].pivot.discount + ' BDT</p>\n';
                }
                product += '<div class="row" style="padding: 10px">\n' +
                    '        <div class="col-sm-12 card shadow" style="padding: 10px">\n' +
                    '             <p class="product_details"><b>Name: </b>' + products[i].name + '</p>\n' +
                    '             <p class="product_details"><b>Price: </b>' + products[i].price + ' BDT</p>\n' +
                    '' + discount_info +
                    '             <p class="product_details"><b>Qty: </b> <span class="badge badge-pill badge-dark">' + products[i].pivot.quantity + '</span></p>\n' +
                    '' + orderStatus(products[i].pivot.product_status) +
                    '        </div>\n' +
                    '  </div>';
                subtotal = parseFloat(subtotal) + (parseFloat(products[i].price) * parseFloat(products[i].pivot.quantity));
                discount = parseFloat(discount) + (parseFloat(products[i].pivot.discount) * parseFloat(products[i].pivot.quantity));
            }
            let total = Math.ceil((parseFloat(subtotal) + parseFloat(delivery_charge)) - parseFloat(discount));
            product += this.displayCalculation(subtotal, discount, delivery_charge, total);
            return product;
        }

        function displayCalculation(subtotal, discount, delivery_charge, total) {
            return '<div class="row mt-4">\n' +
                '        <div class="col-6">\n' +
                '             <p class="total_title">Subtotal: </p>\n' +
                '             <p class="total_title">Discount: </p>\n' +
                '             <p class="total_title">Delivery Fee:</p>\n' +
                '             <hr>\n' +
                '             <p class="total_title"><b>Total: </b></p>\n' +
                '       </div>\n' +
                '       <div class="col-6">\n' +
                '             <p class="total_value"><span id="subtotal">' + subtotal + ' </span> Tk\n' +
                '             </p>\n' +
                '             <p class="total_value">-<span id="discount">' + discount + ' </span>\n' +
                '             Tk</p>\n' +
                '             <p class="total_value">+<span\n' +
                '             id="delivery_charge_value">' + delivery_charge + ' </span> Tk</p>\n' +
                '             <hr>\n' +
                '             <p class="total_value"><b id="total">' + total + ' </b> Tk</p>\n' +
                '       </div>\n' +
                '  </div>';
        }
    </script>
@endsection

@section('track-order-css')
    <style>
        .total_title {
            font-size: 13px !important;
            line-height: 0 !important;
            margin-bottom: 20px !important;
        }

        .total_value {
            font-size: 13px !important;
            line-height: 0 !important;
            margin-bottom: 20px !important;
            text-align: right !important;
        }
    </style>
@endsection

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
                                            <div id="order_{{$order->code}}"
                                                 class="collapse"
                                                 data-parent="#accordion">
                                                <div class="card-body"
                                                     id="order_status_container_{{$order->code}}">
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
                            $("#order_status_container_" + order_code).html("");
                            if (result.ordered_products.length > 0) {
                                let products = productDetails(result.ordered_products);
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

            return '<p class="product_details"><b>Status: </b> <span style="padding: 3px 10px" class="badge badge-pill ' + color + '">' + status + '</span></p>';
        }

        function productDetails(products) {
            let product = "";

            for (let i = 0; i < products.length; i++) {
                product += '<div class="row" style="padding: 10px">\n' +
                    '        <div class="col-sm-12 card shadow" style="padding: 10px">\n' +
                    '             <p class="product_details"><b>Product Name:</b>' + products[i].name + '</span></p>\n' +
                    '             <p class="product_details"><b>Product Qty: </b> <span class="badge badge-pill badge-dark">' + products[i].pivot.quantity + '</span></p>\n' +
                    '' + orderStatus(products[i].pivot.product_status) +
                    '        </div>\n' +
                    '  </div>';
            }
            return product;
        }
    </script>
@endsection

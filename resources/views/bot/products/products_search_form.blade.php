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
                            <div class="col-6 col-sm-6 text-danger text-center">
                                Product Search
                            </div>
                            <div class="col-3 col-sm-3">
                                <hr>
                            </div>

                            <div class="col-12 col-sm-12">
                                <label>Product Code/Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter product code or name ..."
                                       name="product_code" required>
                                <p id="product_code_error" class="text-danger" style="font-size: 13px"></p>
                            </div>

                            <div class="col-12 col-sm-12 text-center">
                                <button id="search" class="btn btn-success"
                                        style="border-radius: 25px;padding: 10px 20px">
                                    <i class="fa fa-search"></i> Search Product
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal Starts-->
    <div class="modal fade" id="product_list_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">You searched for "<span id="searched_product_code"></span>"</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body ">
                    <div class="container" id="product_container">
                        {{--Products will be displayed here--}}
                    </div>

                    <div class="text-center row">
                        <div class="col-6 col-sm-6 text-left">
                            <button class="prev_next_btn outline_btn btn btn-sm btn-outline-secondary"
                                    id="prev_button">Prev
                            </button>
                            <input type="hidden" name="prev_url"/>
                        </div>
                        <div class="col-6 col-sm-6 text-right">
                            <button class="prev_next_btn outline_btn btn btn-sm btn-outline-secondary"
                                    id="next_button">Next
                            </button>
                            <input type="hidden" name="next_url"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal Ends-->

    <!-- The Notification Modal Starts-->
    <div class="modal fade" id="notification_modal">
        <div class="modal-dialog modal-dialog-centered" style="padding: 20px;">
            <div class="modal-content">
                <div class="modal-body" style="font-size: 14px; background: whitesmoke;padding: 15px 0px 0px 0px;">
                    <p id="notification_modal_body" class="text-center"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- The Notification Modal Ends-->

    <input type="hidden" value="{{$customer_id}}" id="customer_id">
    <input type="hidden" value="{{$app_id}}" id="app_id">
@endsection

@section('product-search-js')
    <script>
        $(document).ready(function () {
            let base_url = '{{env("APP_URL")}}';
            let preloaderFadeOutTime = 500;

            function hidePreloader() {
                let preloader = $('.spinner-wrapper');
                preloader.fadeOut(preloaderFadeOutTime);
            }

            hidePreloader();

            $("#search").on('click', function () {
                let product_code = $("input[name='product_code']").val();
                const cart_url = base_url + "bot/" + $("#app_id").val() + "/cart/" + $("#customer_id").val();

                let search_btn = $(this);
                let product_container = $("#product_container");

                if (product_code === "") {
                    $("#product_code_error").html("Product code cannot be empty");
                } else {
                    search_btn.html("Searching <i class='fas fa-spinner fa-pulse'></i>");
                    $("#searched_product_code").html(product_code);
                    $.ajax({
                        url: base_url + 'bot/' + $("#app_id").val() + '/get-product',
                        type: "GET",
                        data: {
                            'product_code': product_code,
                        },
                        success: function (result) {
                            console.log(result);
                            product_container.html("");
                            if (result.data.length > 0) {
                                for (let i = 0; i < result.data.length; i++) {
                                    let product_details = productDetails(result.data[i].name, result.data[i].code, result.data[i].stock, result.data[i].price, result.data[i].discounts);
                                    let discount_available = discountAvailable(result.data[i].discounts);
                                    let images = productImage(result.data[i].images);
                                    let order_pre_order_button = orderPreOrderButton(result.data[i].stock, result.data[i].code);
                                    let products = allProductDetails(product_details, discount_available, images, result.data[i].code, order_pre_order_button);

                                    product_container.append(products);

                                    $("#pre-order_" + result.data[i].code).on("click", function () {
                                        let pre_order_product_code = $(this).parent().parent().parent().find('.product_code').html();
                                        let button = $(this);
                                        button.html("Processing...")

                                        $.ajax({
                                            url: base_url + 'bot/' + $("#app_id").val() + '/pre-order',
                                            type: "GET",
                                            data: {
                                                'pre_order_product_code': pre_order_product_code,
                                                'customer_fb_id': $("#customer_id").val(),
                                            },
                                            success: function (result, jqXHR) {
                                                showNotification(result, "text-success");
                                                button.hide(300);
                                            },
                                            error: function (error, jqXHR) {
                                                showNotification(error.responseJSON, "text-danger");
                                                button.hide(300);
                                            }
                                        });
                                    });

                                    $("#cart_button_" + result.data[i].code).on("click", function () {
                                        let cart_product_code = $(this).parent().parent().parent().find('.product_code').html();
                                        let add_to_cart_button = $(this);
                                        add_to_cart_button.html("Adding...");

                                        $.ajax({
                                            url: base_url + 'bot/' + $("#app_id").val() + '/add-to-cart',
                                            type: "GET",
                                            data: {
                                                'cart_product_code': cart_product_code,
                                                'customer_fb_id': $("#customer_id").val(),
                                            },
                                            success: function (result, jqXHR) {
                                                showNotification(result, "text-success");
                                                add_to_cart_button.off("click");
                                                add_to_cart_button.attr("href", cart_url).html("View Cart").addClass(" btn-primary").removeClass("btn-outline-success");
                                            },
                                            error: function (error, jqXHR) {
                                                showNotification(error.responseJSON, "text-danger");
                                                add_to_cart_button.off("click");
                                                add_to_cart_button.attr("href", cart_url).html("View Cart").addClass(" btn-primary").removeClass("btn-outline-success");
                                            }
                                        });
                                    });
                                }
                                pagination(result);
                                $("#product_list_modal").modal("toggle");
                                search_btn.html('<i class="fa fa-search"></i> Search Product');
                            } else {
                                showNotification("No Products Found", "text-danger", null);
                                search_btn.html('<i class="fa fa-search"></i> Search Product');
                            }

                        }
                    });
                }
            });

            $("#next_button").on('click', function () {
                let next_url = $("input[name='next_url']").val();
                let product_code = $("input[name='product_code']").val();
                let product_container = $("#product_container");

                $.ajax({
                    url: next_url,
                    type: "GET",
                    data: {
                        'product_code': product_code,
                    },
                    success: function (result) {
                        console.log(result);
                        product_container.html("");
                        if (result.data.length > 0) {
                            for (let i = 0; i < result.data.length; i++) {
                                let product_details = productDetails(result.data[i].name, result.data[i].code, result.data[i].stock, result.data[i].price, result.data[i].discounts);
                                let discount_available = discountAvailable(result.data[i].discounts);
                                let images = productImage(result.data[i].images);
                                let order_pre_order_button = orderPreOrderButton(result.data[i].stock, result.data[i].code);
                                let products = allProductDetails(product_details, discount_available, images, result.data[i].code, order_pre_order_button);

                                product_container.append(products);

                                $("#pre-order_" + result.data[i].code).on("click", function () {
                                    let pre_order_product_code = $(this).parent().parent().parent().find('.product_code').html();
                                    console.log(pre_order_product_code);
                                    let button = $(this);

                                    $.ajax({
                                        url: base_url + 'bot/' + $("#app_id").val() + '/pre-order',
                                        type: "GET",
                                        data: {
                                            'pre_order_product_code': pre_order_product_code,
                                            'customer_fb_id': $("#customer_id").val(),
                                        },
                                        success: function (result, jqXHR) {
                                            showNotification(result, "text-success", button);
                                        },
                                        error: function (error, jqXHR) {
                                            showNotification(error.responseJSON, "text-danger", button);
                                        }
                                    });
                                });

                                $("#cart_button_" + result.data[i].code).on("click", function () {
                                    let cart_product_code = $(this).parent().parent().parent().find('.product_code').html();
                                    console.log(cart_product_code);
                                    let button = $(this);

                                    $.ajax({
                                        url: base_url + 'bot/' + app_id + '/add-to-cart',
                                        type: "GET",
                                        data: {
                                            'cart_product_code': cart_product_code,
                                            'customer_fb_id': $("#customer_id").val(),
                                        },
                                        success: function (result, jqXHR) {
                                            showNotification(result, "text-success", button);
                                        },
                                        error: function (error, jqXHR) {
                                            showNotification(error.responseJSON, "text-danger", button);
                                        }
                                    });
                                });
                            }
                            pagination(result);
                        } else {
                            showNotification("No Products Found", "text-danger", null);
                        }

                    }
                });

            });

            $("#prev_button").on('click', function () {
                let prev_url = $("input[name='prev_url']").val();
                let product_code = $("input[name='product_code']").val();
                let product_container = $("#product_container");

                $.ajax({
                    url: prev_url,
                    type: "GET",
                    data: {
                        'product_code': product_code,
                    },
                    success: function (result) {
                        console.log(result);
                        product_container.html("");
                        if (result.data.length > 0) {
                            for (let i = 0; i < result.data.length; i++) {
                                let product_details = productDetails(result.data[i].name, result.data[i].code, result.data[i].stock, result.data[i].price, result.data[i].discounts);
                                let discount_available = discountAvailable(result.data[i].discounts);
                                let images = productImage(result.data[i].images);
                                let order_pre_order_button = orderPreOrderButton(result.data[i].stock, result.data[i].code);
                                let products = allProductDetails(product_details, discount_available, images, result.data[i].code, order_pre_order_button);

                                product_container.append(products);

                                $("#pre-order_" + result.data[i].code).on("click", function () {
                                    let pre_order_product_code = $(this).parent().parent().parent().find('.product_code').html();
                                    console.log(pre_order_product_code);
                                    let button = $(this);

                                    $.ajax({
                                        url: base_url + 'bot/' + $("#app_id").val() + '/pre-order',
                                        type: "GET",
                                        data: {
                                            'pre_order_product_code': pre_order_product_code,
                                            'customer_fb_id': $("#customer_id").val(),
                                        },
                                        success: function (result, jqXHR) {
                                            showNotification(result, "text-success", button);
                                        },
                                        error: function (error, jqXHR) {
                                            showNotification(error.responseJSON, "text-danger", button);
                                        }
                                    });
                                });

                                $("#cart_button_" + result.data[i].code).on("click", function () {
                                    let cart_product_code = $(this).parent().parent().parent().find('.product_code').html();
                                    console.log(cart_product_code);
                                    let button = $(this);

                                    $.ajax({
                                        url: base_url + 'bot/' + $("#app_id").val() + '/add-to-cart',
                                        type: "GET",
                                        data: {
                                            'cart_product_code': cart_product_code,
                                            'customer_fb_id': $("#customer_id").val(),
                                        },
                                        success: function (result, jqXHR) {
                                            showNotification(result, "text-success", button);
                                        },
                                        error: function (error, jqXHR) {
                                            showNotification(error.responseJSON, "text-danger", button);
                                        }
                                    });
                                });
                            }
                            pagination(result);
                        } else {
                            showNotification("No Products Found", "text-danger", null);
                        }

                    }
                });

            });
        });

        function productDetails(name, code, stock, price, discount) {
            let discounted_price = '';
            let stock_available = 'Stocked Out';
            let color = 'text-danger';

            if (stock > 0) {
                stock_available = stock;
                color = 'text-success';
            }

            if (discount !== null) {
                discounted_price = '<p>Discounted Price: <b>' + (price - (price * discount.dis_percentage) / 100) + '</b> BDT</p>';
            }

            return '<p> <b>Name: </b>' + name + '</p>\n' +
                '<p><b>Code: </b><span class="product_code">' + code + '</span></p>\n' +
                '<p><b>In Stock: </b><span class="' + color + '">' + stock_available + '</span></p>\n' +
                '<p><b>Price: </b>' + price + ' BDT</p>\n' +
                '' + discounted_price;
        }

        function discountAvailable(discount) {
            if (discount !== null) {
                return '<div class="col-sm-12 text-center">' +
                    '       <p style="font-size: 13px">' +
                    '           <span class="text-danger">Discount Available: </span> ' +
                    '           <span style="font-size: 11px">From <b>' + discount.dis_from + '</b> to <b>' + discount.dis_to + '</b></span>' +
                    '       </p>' +
                    '   </div>\n';
            } else {
                return '';
            }
        }

        function productImage(all_images) {
            let image = '';
            let image_base_path = "{{asset('images/products')."/"}}";
            console.log(image_base_path);
            for (let i = 0; i < all_images.length; i++) {
                if (i === 0) {
                    image += '<div class="carousel-item active">\n' +
                        '         <img src="' + image_base_path + all_images[i].image_url + '" style="max-height: 170px;">' +
                        '     </div>';
                } else {
                    image += '<div class="carousel-item">\n' +
                        '         <img src="' + image_base_path + all_images[i].image_url + '" style="max-height: 170px;">' +
                        '     </div>';
                }
            }
            return image;
        }

        function orderPreOrderButton(stock, product_code) {
            if (stock > 0) {
                return '<div class="col-sm-12 text-center" style="margin-top: 10px">' +
                    '       <a style="font-size: .6rem" href="javascript:void(0)" class="order_pre_order_btn outline_btn btn btn-outline-success btn-sm" id="cart_button_' + product_code + '"><i class="fa fa-shopping-cart"></i> Add to Cart</a> ' +
                    '   </div>';
            } else {
                return '<div class="col-sm-12 text-center" style="margin-top: 10px">' +
                    '       <button style="font-size: .6rem" class="order_pre_order_btn outline_btn btn btn-outline-danger btn-sm" id="pre-order_' + product_code + '"><i class="fa fa-gift"></i > Pre-Order</button> ' +
                    '   </div>';
            }
        }

        function allProductDetails(product_details, discount_available, images, code, order_pre_order_button) {

            return '  <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">\n' +
                '                        ' + discount_available +
                '                        <div class="col-6" style="max-height: 200px">\n' +
                '                           <div id="' + code + '" class="carousel slide shadow-sm rounded" data-ride="carousel">\n' +
                '                                <div class="carousel-inner">\n' +
                '                                   ' + images +
                '                                </div>\n' +
                '                                <a class="carousel-control-prev" href="#' + code + '" data-slide="prev">\n' +
                '                                    <span class="carousel-control-prev-icon text-dark"></span>\n' +
                '                                </a>\n' +
                '                                <a class="carousel-control-next" href="#' + code + '" data-slide="next">\n' +
                '                                    <span class="carousel-control-next-icon text-dark"></span>\n' +
                '                                </a>\n' +
                '                            </div>\n' +
                '                            ' + order_pre_order_button +
                '                        </div>\n' +
                '                         <div class="col-6" style="font-size: 13px">\n' +
                '                            ' + product_details +
                '                         </div>\n' +
                '                    </div>';
        }

        function showNotification(message, text_class) {
            $("#notification_modal").modal('toggle');

            $("#notification_modal_body").html(message);
            $("#notification_modal_body").addClass(" " + text_class);

            setTimeout(function () {
                $('#notification_modal').modal('hide');
            }, 4000);
        }

        function pagination(data) {
            if (data.prev_page_url !== null) {
                $("#prev_button").show();
                $("input[name='prev_url']").val(data.prev_page_url.replace("http", "https"));
            } else {
                $("#prev_button").hide();
            }

            if (data.next_page_url !== null) {
                $("#next_button").show();
                $("input[name='next_url']").val(data.next_page_url.replace("http", "https"));
            } else {
                $("#next_button").hide();
            }
        }

    </script>
@endsection

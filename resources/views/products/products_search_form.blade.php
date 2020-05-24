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
                            <button id="search" class="btn btn-success" style="border-radius: 5px;padding: 10px 20px"><i
                                    class="fa fa-search"></i> Search
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="text" value="{{$customer_id}}" id="customer_id">

<!-- The Modal Starts-->
<div class="modal fade" id="product_list_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">You searched for "PP220039"</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <div class="container" id="product_container">
                    {{--Products will be displayed here--}}
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
            let product_code = $("input[name='product_code']").val();

            $.ajax({
                url: '/get-product',
                type: "GET",
                data: {
                    'product_code': product_code,
                },
                success: function (result) {
                    console.log(result);
                    $("#product_container").html("");

                    for (let i = 0; i < result.length; i++) {
                        let product_details = productDetails(result[i].name, result[i].code, result[i].stock, result[i].price, result[i].discounts);
                        let discount_available = discountAvailable(result[i].discounts);
                        let images = productImage(result[i].images);
                        let products = allProductDetails(product_details, discount_available, images, result[i].code);

                        $("#product_container").append(products);
                    }
                    $("#product_list_modal").modal('toggle');
                }
            });

        })
    })

    function productDetails(name, code, stock, price, discount) {
        let discounted_price = '';
        if (discount !== null) {
            discounted_price = '<p>Discounted Price: <b>' + (price - (price * discount.dis_percentage) / 100) + '</b> BDT</p>';
        }
        return '<p>Name: <b>' + name + '</b></p>\n' +
            '<p>Code: <b>' + code + '</b></p>\n' +
            '<p>In Stock: <b>' + stock + '</b></p>\n' +
            '<p>Price: <b>' + price + '</b> BDT</p>\n' +
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
        for (let i = 0; i < all_images.length; i++) {
            if (i == 0) {
                image += '<div class="carousel-item active">\n' +
                    '         <img src="' + all_images[i].image_url + '" style="max-height: 170px;">' +
                    '     </div>';
            } else {
                image += '<div class="carousel-item">\n' +
                    '         <img src="' + all_images[i].image_url + '" style="max-height: 170px;">' +
                    '     </div>';
            }

        }
        return image;
    }

    function allProductDetails(product_details, discount_available, images, code) {
        let order_url = '{{env("APP_URL")."order-form/"}}' + $("#customer_id").val();

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
            '                            <div class="col-sm-12 text-center" style="margin-top: 10px">' +
            '                                 <a href="' + order_url + '" class="btn btn-success btn-sm">Order Now</a> ' +
            '                            </div>\n' +
            '                        </div>\n' +
            '                         <div class="col-6" style="font-size: 13px">\n' +
            '                            ' + product_details +
            '                         </div>\n' +
            '                    </div>';
    }
</script>
</body>
</html>

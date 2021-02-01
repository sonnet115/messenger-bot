@extends('bot.main')

@section('main-content')
    <nav class="navbar navbar-expand-sm bg-dark fixed-top justify-content-center" style="padding: 12px">
        <h3 class="text-uppercase text-white font-weight-bold">Our Products</h3>
    </nav>
    <br>
    <br>
    <br>
    <div class="container" style="margin-top:30px;">
        <div class="row">
            <div class="col-3 col-sm-3">
                <hr>
            </div>
            <div class="col-6 col-sm-6 text-secondary text-center font-weight-bold">
                <p style="font-size: 20px" class="text-uppercase"> Categories</p>
            </div>
            <div class="col-3 col-sm-3">
                <hr>
            </div>

            {{--Category Tree--}}
            {{--  <div class="col-md-4">
                 <li style="list-style: none" class="category" data-cat-id="0" data-category-name="All Products">All
                     Products
                 </li>
                 <ul id="tree1">
                     @include('bot.categories', ['categories' => $categories])
                 </ul>
             </div>
             <div class="text-center" style="max-width:500px;margin: 0 auto">
                 <p class="shadow category badge badge-pill badge-success" data-cat-id="0"
                    data-category-name="All products">All products</p>
             </div>--}}

            <div class="row" style="margin:0 auto">
                <div>
                    <div class="card shadow bg-secondary" style="cursor: pointer">
                        <div class="card-header">
                            <p class="category text-white" data-cat-id="0" data-category-name="All Products">
                                All Products
                            </p>
                        </div>
                    </div>
                    <br>
                    @foreach($categories as $cat)
                        @if(count($cat->products)>0)
                            <div class="card shadow" style="cursor: pointer">
                                <div class="card-header">
                                    <p class="category" data-cat-id="{{$cat->id}}"
                                       data-category-name= {{$cat->name}}>{{$cat->name}}</p>
                                </div>
                            </div>
                            <br>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{--Product search form--}}
    {{-- <div class="form-body on-top" style="padding-top:0">
         <div class="row">
             <div class="form-holder">
                 <div class="form-content" style="padding: 10px">
                     <div class="form-items">
                         <div class="row">
                             <div class="col-3 col-sm-3">
                                 <hr>
                             </div>
                             <div class="col-6 col-sm-6 text-danger text-center">
                                 Search Product
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
 --}}

    <!-- The Products Modal Starts-->
    <div class="modal fade" id="product_list_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Showing Result for "<span class="text-success"
                                                                      id="searched_product_code"></span>"</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body ">
                    <div class="container" id="product_container">
                        {{--Products will be displayed here--}}
                        <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                            <div class="col-6" style="max-height: 200px">
                                <div class="">
                                    <img src="https://clients.howkar.com/images/products/Chat_Bot_BD/TH-2003_1.jpeg"
                                         style="max-height: 170px;max-width: 100%"></div>
                                <div class="col-sm-12 text-center" style="margin-top: 10px">
                                    <a style="font-size: .6rem" href="javascript:void(0)"
                                       class="order_pre_order_btn outline_btn btn btn-outline-success btn-sm"
                                       id="cart_button_TH-2003">
                                        <i class="fa fa-shopping-cart"></i> Add to Cart</a></div>
                            </div>
                            <div class="col-6" style="font-size: 13px">
                                <p><b>Name: </b>Tag Heuer</p>
                                <p><b>Code: </b><span class="product_code">TH-2003</span></p>
                                <p><b>Price: </b>30000 BDT</p>
                                <p><b>Color:</b>
                                    <select style="height: 25px">
                                        <option>Red</option>
                                        <option>Black</option>
                                        <option>Blue</option>
                                        <option>Yellow</option>
                                    </select>
                                </p>
                                <p><b>Size:</b>
                                    <select style="height: 25px">
                                        <option>L(14 cm)</option>
                                        <option>M(12 cm)</option>
                                        <option>S(10 cm)</option>
                                        <option>XS(8 cm)</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center row">
                        <div class="col-4 col-sm-4 text-left">
                            <button class="prev_next_btn outline_btn btn btn-sm btn-outline-primary"
                                    id="prev_button"><i class="fa fa-arrow-left"></i> Prev
                            </button>
                            <input type="hidden" name="prev_url"/>
                        </div>
                        <div class="col-4 col-sm-4 text-center">
                            <p class="text-dark" style="font-size: 12px">
                                Total Products <span class="badge badge-pill badge-dark" style="font-size:16px"
                                                     id="total_results"></span>
                            </p>
                        </div>
                        <div class="col-4 col-sm-4 text-right">
                            <button class="prev_next_btn outline_btn btn btn-sm btn-outline-primary"
                                    id="next_button">Next <i class="fa fa-arrow-right"></i>
                            </button>
                            <input type="hidden" name="next_url"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The Products Modal Ends-->

    <!-- The Notification Modal Starts-->
    <div class="modal fade" id="notification_modal">
        <div class="modal-dialog modal-dialog-centered" style="padding: 20px;">
            <div class="modal-content" style="border-radius: 30px">
                <div class="modal-body"
                     style="font-size: 14px; background: whitesmoke;padding: 15px 0 0 0;border-radius: 30px">
                    <p id="notification_modal_body" class="text-center"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- The Notification Modal Ends-->

    <input type="hidden" value="{{$customer_id}}" id="customer_id">
    <input type="hidden" value="{{$page_id}}" id="app_id">
    <input id="category_id" type="hidden">
@endsection

@section('product-search-js')
    <script>
        $(document).ready(function () {
            // JS for category tree view
            $.fn.extend({
                treed: function (o) {
                    let openedClass = 'fa-minus-square';
                    let closedClass = 'fa-plus-square';

                    if (typeof o != 'undefined') {
                        if (typeof o.openedClass != 'undefined') {
                            openedClass = o.openedClass;
                        }
                        if (typeof o.closedClass != 'undefined') {
                            closedClass = o.closedClass;
                        }
                    }

                    //initialize each of the top levels
                    let tree = $(this);
                    tree.addClass("tree");
                    tree.find('li').has("ul").each(function () {
                        let branch = $(this); //li with children ul
                        branch.prepend("<i class='indicator fa " + closedClass + "'></i>");
                        branch.addClass('branch');
                        branch.on('click', function (e) {
                            if (this == e.target) {
                                var icon = $(this).children('i:first');
                                icon.toggleClass(openedClass + " " + closedClass);
                                $(this).children().children().toggle();
                            }
                        })
                        branch.children().children().toggle();
                    });
                    //fire event from the dynamically added icon
                    tree.find('.branch .indicator').each(function () {
                        $(this).on('click', function () {
                            $(this).closest('li').click();
                        });
                    });
                    //fire event to open branch if the li contains an anchor instead of text
                    tree.find('.branch>a').each(function () {
                        $(this).on('click', function (e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });
                    //fire event to open branch if the li contains a button instead of text
                    tree.find('.branch>button').each(function () {
                        $(this).on('click', function (e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });
                }
            });
            $('#tree1').treed();
            // JS for category tree view ends

            let base_url = '{{env("APP_URL")}}';
            let preloaderFadeOutTime = 500;

            function hidePreloader() {
                let preloader = $('.spinner-wrapper');
                preloader.fadeOut(preloaderFadeOutTime);
            }

            hidePreloader();

            $(".category").on('click', function () {
                $('.spinner-wrapper').show();
                // let product_code = $("input[name='product_code']").val();//code for searching
                let cat_id = $(this).attr("data-cat-id");
                let cat_name = $(this).attr("data-category-name");
                const cart_url = base_url + "bot/" + $("#app_id").val() + "/cart/" + $("#customer_id").val();

                $("#category_id").val(cat_id);
                let cat_button = $(this);
                let product_container = $("#product_container");

                // cat_button.append("<i class='fas fa-spinner fa-pulse'></i>");
                $.ajax({
                    url: base_url + 'bot/' + $("#app_id").val() + '/get-product',
                    type: "GET",
                    data: {
                        'cat_id': cat_id,
                    },
                    success: function (result) {
                        $('.spinner-wrapper').fadeOut(this.preloaderFadeOutTime);
                        $("#searched_product_code").html(cat_name);
                        $("#total_results").html(result.total);
                        let variants_list = [];
                        product_container.html("");

                        if (result.data.length > 0) {
                            for (let i = 0; i < result.data.length; i++) {
                                for (let j = 0; j < result.data[i].child_products.length; j++) {
                                    if (j == 0) {
                                        let product_details = productDetails(result.data[i].child_products[j].name, result.data[i].child_products[j].code, result.data[i].child_products[j].stock, result.data[i].child_products[j].price, result.data[i].child_products[j].discounts, result.data[i].variants, result.data[i].id, result.data[i].child_products[j].id);
                                        let discount_available = discountAvailable(result.data[i].child_products[j].discounts);
                                        let images = productImage(result.data[i].child_products[j].images);
                                        let order_pre_order_button = orderPreOrderButton(result.data[i].child_products[j].stock, result.data[i].child_products[j].code);
                                        let products = allProductDetails(product_details, discount_available, images, result.data[i].child_products[j].code, order_pre_order_button);
                                        product_container.append(products);
                                        variants_list[result.data[i].child_products[j].parent_product_id + '_' + result.data[i].child_products[j].variant_combination_ids] = new Variants(result.data[i].child_products[j].name, result.data[i].child_products[j].code, result.data[i].child_products[j].price, result.data[i].child_products[j].variant_combination_ids, result.data[i].child_products[j].parent_product_id);
                                    } else {
                                        // variants_list.push(new Variants(result.data[i].child_products[j].name, result.data[i].child_products[j].code, result.data[i].child_products[j].price, result.data[i].child_products[j].variant_combination_ids, result.data[i].child_products[j].parent_product_id));
                                        variants_list[result.data[i].child_products[j].parent_product_id + '_' + result.data[i].child_products[j].variant_combination_ids] = new Variants(result.data[i].child_products[j].name, result.data[i].child_products[j].code, result.data[i].child_products[j].price, result.data[i].child_products[j].variant_combination_ids, result.data[i].child_products[j].parent_product_id);
                                    }

                                    /*let temp_prod = '<div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">' +
                                        '                            <div class="col-6" style="max-height: 200px">' +
                                        '                                <div class="">' +
                                        '                                    <img src="https://clients.howkar.com/images/products/Chat_Bot_BD/TH-2003_1.jpeg"' +
                                        '                                         style="max-height: 170px;max-width: 100%"></div>' +
                                        '                                <div class="col-sm-12 text-center" style="margin-top: 10px">' +
                                        '                                    <a style="font-size: .6rem" href="javascript:void(0)" class="order_pre_order_btn outline_btn btn btn-outline-success btn-sm" id="cart_button_TH-2003">' +
                                        '                                        <i class="fa fa-shopping-cart"></i> Add to Cart</a></div>' +
                                        '                            </div>' +
                                        '                            <div class="col-6" style="font-size: 13px">' +
                                        '                                <p><b>Name: </b>Tag Heuer</p>' +
                                        '                                <p><b>Code: </b><span class="product_code">TH-2003</span></p>' +
                                        '                                <p><b>Price: </b>30000 BDT</p>' +
                                        '                                <p><b>Color:</b>' +
                                        '                                    <select style="height: 25px">' +
                                        '                                        <option>Red</option>' +
                                        '                                        <option>Black</option>' +
                                        '                                        <option>Blue</option>' +
                                        '                                        <option>Yellow</option>' +
                                        '                                    </select>' +
                                        '                                </p>' +
                                        '                                <p><b>Size:</b>' +
                                        '                                    <select style="height: 25px">' +
                                        '                                        <option>L(14 cm)</option>' +
                                        '                                        <option>M(12 cm)</option>' +
                                        '                                        <option>S(10 cm)</option>' +
                                        '                                        <option>XS(8 cm)</option>' +
                                        '                                    </select>' +
                                        '                                </p>' +
                                        '                            </div>' +
                                        '                        </div>';*/

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
                                                // showNotification(result, "text-success");
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
                            }

                            $(".selected_variants").on("change", function () {
                                let variations_combination = [];
                                variations_combination.push($(this).parent().parent().find('.parent_id').val());

                                let vari = $(this).val();
                                variations_combination.push(vari);

                                $(this).parent().parent().find('.selected_variants').each(function () {
                                    if (vari != $(this).val()) {
                                        variations_combination.push($(this).val());
                                    }
                                });

                                /*console.log(variations_combination.join('_'));
                                console.log(variants_list[variations_combination.join('_')]);
                                console.log(shuffle(variations_combination));*/
                                /*console.log(variations_combination);


                                console.log(variations_combination);
                                for (let i = 0; i < variations_combination.length; i++) {
                                    console.log(variations_combination[i]);
                                    console.log(variants_list[variations_combination[i].join('_')]);
                                }*/
                                let permu = perm(variations_combination);
                                for (let i = 0; i < permu.length; i++) {
                                    if(variants_list[permu[i].join('_')]) {
                                        console.log(permu[i]);
                                        console.log(variants_list[permu[i].join('_')]);
                                    }
                                }

                            });
                            console.log(variants_list);
                            pagination(result);
                            $("#product_list_modal").modal("toggle");
                        } else {
                            showNotification("No Products Found", "text-danger", null);
                        }

                    }
                });
            });

            $("#next_button").on('click', function () {
                let next_url = $("input[name='next_url']").val();
                let product_container = $("#product_container");
                const cart_url = base_url + "bot/" + $("#app_id").val() + "/cart/" + $("#customer_id").val();
                $.ajax({
                    url: next_url,
                    type: "GET",
                    data: {
                        'cat_id': $("#category_id").val(),
                    },
                    success: function (result) {
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
                                            // showNotification(result, "text-success");
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
                        } else {
                            showNotification("No Products Found", "text-danger", null);
                        }

                    }
                });

            });

            $("#prev_button").on('click', function () {
                let prev_url = $("input[name='prev_url']").val();
                let product_container = $("#product_container");
                const cart_url = base_url + "bot/" + $("#app_id").val() + "/cart/" + $("#customer_id").val();
                $.ajax({
                    url: prev_url,
                    type: "GET",
                    data: {
                        'cat_id': $("#category_id").val(),
                    },
                    success: function (result) {
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
                                            // showNotification(result, "text-success");
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
                        } else {
                            showNotification("No Products Found", "text-danger", null);
                        }
                    }
                });

            });
        });

        function perm(xs) {
            let ret = [];

            for (let i = 0; i < xs.length; i = i + 1) {
                let rest = perm(xs.slice(0, i).concat(xs.slice(i + 1)));

                if(!rest.length) {
                    ret.push([xs[i]])
                } else {
                    for(let j = 0; j < rest.length; j = j + 1) {
                        ret.push([xs[i]].concat(rest[j]))
                    }
                }
            }
            return ret;
        }

        function productDetails(name, code, stock, price, discount, variants, parent_id, product_id) {
            let discounts = '';
            let stock_available = 'Stocked Out';
            let color = 'text-danger';

            if (stock > 0) {
                stock_available = stock;
                color = 'text-success';
            }

            if (discount !== null) {
                discounts = '<p><b>Discount: </b><span class="' + color + '">' + discount.dis_percentage + '</span>%</p>\n' +
                    '<p>Discounted Price: <b><span class="' + color + '">' + (price - (price * discount.dis_percentage) / 100) + '</span></b> BDT</p>';
            }
            let vari = this.productVariants(variants, parent_id, product_id);

            return '<p> <b>Name: </b>' + name + '</p>\n' +
                '<p><b>Code: </b><span class="product_code">' + code + '</span></p>\n' +
                '<p><b>Price: </b>' + price + ' BDT</p>\n' +
                '' + discounts + vari + '<input class="parent_id" value="' + parent_id + '">';
        }

        function productVariants(variants, parent_id, product_id) {
            let vari = '';
            for (let i = 0; i < variants.length; i++) {
                vari += '<p><b>' + variants[i].name + ':</b>' +
                    '<select style="height: 25px" class="selected_variants">' +
                    '<option class="selected disabled">Choose</option>';

                for (let j = 0; j < variants[i].variant_properties_name.length; j++) {
                    if (variants[i].variant_properties_name[j].pivot.product_id == parent_id) {
                        vari += '<option value="' + variants[i].variant_properties_name[j].id + '">' + variants[i].variant_properties_name[j].property_name + '</option>'
                    }
                }
                vari += '</select>' +
                    '</p>';
            }

            return vari;
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
            let image_base_path = "{{asset('images/products')."/"}}";//dev
            // let image_base_path = "https://clients.howkar.com/images/products/";//live

            if (all_images.length > 0) {
                image = '<div class="text-center">\n' +
                    '         <img src="' + image_base_path + all_images[0].image_url + '" style="max-height: 170px;max-width: 100%">' +
                    '     </div>';
            } else {
                image = '<div class="text-center">\n' +
                    '         <img src="' + image_base_path + 'no.png" style="max-height: 170px;max-width: 100%">' +
                    '     </div>';
            }

            // for (let i = 0; i < all_images.length; i++) {
            //     if (i === 0) {
            //         image = '<div class="active">\n' +
            //             '         <img src="' + image_base_path + all_images[i].image_url + '" style="max-height: 170px;">' +
            //             '     </div>';
            //     } else {
            //         image = '<div class="">\n' +
            //             '         <img src="' + image_base_path + all_images[i].image_url + '" style="max-height: 170px;">' +
            //             '     </div>';
            //     }
            // }
            return image;
        }

        function orderPreOrderButton(stock, product_code) {
            return '<div class="col-sm-12 text-center" style="margin-top: 10px">' +
                '       <a style="font-size: .6rem" href="javascript:void(0)" class="order_pre_order_btn outline_btn btn btn-outline-success btn-sm" id="cart_button_' + product_code + '"><i class="fa fa-shopping-cart"></i> Add to Cart</a> ' +
                '   </div>';
            // Pre-order
            // if (stock > 0) {
            //     return '<div class="col-sm-12 text-center" style="margin-top: 10px">' +
            //         '       <a style="font-size: .6rem" href="javascript:void(0)" class="order_pre_order_btn outline_btn btn btn-outline-success btn-sm" id="cart_button_' + product_code + '"><i class="fa fa-shopping-cart"></i> Add to Cart</a> ' +
            //         '   </div>';
            // } else {
            //     return '<div class="col-sm-12 text-center" style="margin-top: 10px">' +
            //         '       <button style="font-size: .6rem" class="order_pre_order_btn outline_btn btn btn-outline-danger btn-sm" id="pre-order_' + product_code + '"><i class="fa fa-gift"></i > Pre-Order</button> ' +
            //         '   </div>';
            // }
        }

        function allProductDetails(product_details, discount_available, images, code, order_pre_order_button) {

            return '  <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">\n' +
                '                        ' + discount_available +
                '                        <div class="col-6" style="max-height: 200px">\n' +
                '                            ' + images +
                '                            ' + order_pre_order_button +
                '                        </div>\n' +
                '                         <div class="col-6" style="font-size: 13px">\n' +
                '                            ' + product_details +
                '                         </div>\n' +
                '                    </div>';
            // return '  <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">\n' +
            //     '                        ' + discount_available +
            //     '                        <div class="col-6" style="max-height: 200px">\n' +
            //     '                           <div id="' + code + '" class="carousel slide shadow-sm rounded" data-ride="carousel">\n' +
            //     '                                <div class="carousel-inner">\n' +
            //     '                                   ' + images +
            //     '                                </div>\n' +
            //     '                                <a class="carousel-control-prev" href="#' + code + '" data-slide="prev">\n' +
            //     '                                    <span class="carousel-control-prev-icon text-dark"></span>\n' +
            //     '                                </a>\n' +
            //     '                                <a class="carousel-control-next" href="#' + code + '" data-slide="next">\n' +
            //     '                                    <span class="carousel-control-next-icon text-dark"></span>\n' +
            //     '                                </a>\n' +
            //     '                            </div>\n' +
            //     '                            ' + order_pre_order_button +
            //     '                        </div>\n' +
            //     '                         <div class="col-6" style="font-size: 13px">\n' +
            //     '                            ' + product_details +
            //     '                         </div>\n' +
            //     '                    </div>';
        }

        function showNotification(message, text_class) {
            $("#notification_modal").modal('toggle');
            let notification_modal_body = $("#notification_modal_body");

            if (text_class === 'text-danger') {
                notification_modal_body.removeClass('text-success')
            } else {
                notification_modal_body.removeClass('text-danger')
            }

            notification_modal_body.html(message);
            notification_modal_body.addClass(" " + text_class);

            setTimeout(function () {
                $('#notification_modal').modal('hide');
            }, 3000);
        }

        function pagination(data) {
            if (data.prev_page_url !== null) {
                $("#prev_button").show();
                $("input[name='prev_url']").val(data.prev_page_url.replace("http", "http"));
            } else {
                $("#prev_button").hide();
            }

            if (data.next_page_url !== null) {
                $("#next_button").show();
                $("input[name='next_url']").val(data.next_page_url.replace("http", "http"));
            } else {
                $("#next_button").hide();
            }
        }

        function Variants(name, code, price, variant_combination_ids, parent_product_id) {
            this.name = name;
            this.code = code;
            this.price = price;
            this.variant_combination_ids = variant_combination_ids;
            this.parent_product_id = parent_product_id;
        }
    </script>
@endsection

@section('product-search-css')
    <style>
        .form-content {
            min-height: 47% !important;
        }

        .category {
            text-align: center;
            margin: 0px;
        }

        .card-header {
            padding: .75rem 4.25rem;
        }
    </style>

    {{--css for category--}}
    <style>
        .tree, .tree ul {
            margin: 0;
            padding: 0;
            list-style: none
        }

        .tree ul {
            margin-left: 1em;
            position: relative
        }

        .tree ul ul {
            margin-left: .5em
        }

        .tree ul:before {
            content: "";
            display: block;
            width: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            border-left: 1px solid
        }

        .tree li {
            margin: 0;
            padding: 0 1em;
            line-height: 2em;
            color: #369;
            font-weight: 700;
            position: relative
        }

        .tree ul li:before {
            content: "";
            display: block;
            width: 10px;
            height: 0;
            border-top: 1px solid;
            margin-top: -1px;
            position: absolute;
            top: 1em;
            left: 0
        }

        .tree ul li:last-child:before {
            background: #fff;
            height: auto;
            top: 1em;
            bottom: 0
        }

        .indicator {
            margin-right: 5px;
        }

        .tree li a {
            text-decoration: none;
            color: #369;
        }

        .tree li button, .tree li button:active, .tree li button:focus {
            text-decoration: none;
            color: #369;
            border: none;
            background: transparent;
            margin: 0;
            padding: 0;
            outline: 0;
        }
    </style>
@endsection

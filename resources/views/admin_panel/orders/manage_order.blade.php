@extends("admin_panel.main")
@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-15">
        <!-- Order List starts -->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-list-alt"> Product List</i></h4>
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-sm">
                            @if(Session::has('success_message'))
                                <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success_message') }}</p>
                            @endif
                            <div class="table-wrap">
                                <table id="user_list_table" class="table table-bordered w-100 display">
                                    <thead class="btn-gradient-info">
                                    <tr>
                                        <th class="text-center text-white" data-priority="1">Order Code</th>
                                        <th class="text-center text-white">Ordered Date</th>
                                        <th class="text-center text-white">Status Updated By</th>
                                        <th class="text-center text-white">Product Details</th>
                                        <th class="text-center text-white">Order Status</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- Order list ends -->
        <!-- modal body starts-->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" style="overflow: auto">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <p style="color: #2b383e;font-size: 17px;text-decoration: underline">Ordered
                                    Products:</p>
                                <br>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="font-weight-bold">Name</th>
                                        <th class="font-weight-bold">Price</th>
                                        <th class="font-weight-bold">Quantity</th>
                                        <th class="font-weight-bold">Discounts</th>
                                        <th class="font-weight-bold">Status</th>
                                        <th class="font-weight-bold">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="product_table_data">
                                    {{--                                        <tr class="tt">--}}
                                    {{--                                            <td>Pakisthani three piece</td>--}}
                                    {{--                                            <td>2000 BDT</td>--}}
                                    {{--                                            <td>2 <span>Sets</span></td>--}}
                                    {{--                                            <td>100 BDT</td>--}}
                                    {{--                                            <td>Pending</td>--}}
                                    {{--                                            <td><button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>--}}
                                    {{--                                        </tr>--}}

                                    {{--                                    <tr>--}}
                                    {{--                                        <td>Pakisthani three piece</td>--}}
                                    {{--                                        <td>2000 BDT</td>--}}
                                    {{--                                        <td>2 <span>Sets</span></td>--}}
                                    {{--                                        <td>100 BDT</td>--}}
                                    {{--                                        <td>Pending</td>--}}
                                    {{--                                        <td><button class="btn btn-xs btn-danger">Remove</button></td>--}}
                                    {{--                                    </tr>--}}

                                    </tbody>
                                </table>

                            </div>
                            <div class="col-12 col-lg-4">
                                <p style="color: #2b383e;font-size: 17px;text-decoration: underline">Customer
                                    Details</p>
                                <br>
                                <table class="table table-bordered" style="padding-left: 10px" id="customer_table_data">
                                    {{--                                    <thead>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th>Name</th>--}}
                                    {{--                                            <th>Details</th>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                    </thead>--}}
                                    {{--                                    <tbody >--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <td>Mark</td>--}}
                                    {{--                                            <td>Sayla</td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                    </tbody>--}}
                                </table>
                            </div>
                            <!--summary starts-->
                            <div class="col-4" style="color: #2b383e" id="summary_details">
                                {{--                                <div class="border-bottom">--}}
                                {{--                                    <p style="text-decoration: underline">Summary:</p>--}}
                                {{--                                    <p>Total Price: <span id="total_price"></span> <span>tk</span></p>--}}
                                {{--                                    <p>Discounts: <span>-</span> <span id="total_discount"></span> <span>tk</span></p>--}}
                                {{--                                    <p>Delivery charge: <span>60 tk</span></p>--}}
                                {{--                                </div>--}}
                                {{--                                <div>--}}
                                {{--                                    <p>subtotal: <span id="subtotal"></span></p>--}}
                                {{--                                </div>--}}
                            </div>
                            <!-- summary ends-->
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- moadal body ends-->
    </div>
    <!-- /Container -->
@endsection
@section("product-js")
    <script src={{asset("assets/admin_panel/vendors/datatables.net/js/jquery.dataTables.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-dt/js/dataTables.dataTables.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-buttons/js/dataTables.buttons.min.js")}}></script>
    <script
        src={{asset("assets/admin_panel/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-buttons/js/buttons.flash.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/jszip/dist/jszip.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/pdfmake/build/pdfmake.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/pdfmake/build/vfs_fonts.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-buttons/js/buttons.html5.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-buttons/js/buttons.print.min.js")}}></script>
    <script
        src={{asset("assets/admin_panel/vendors/datatables.net-responsive/js/dataTables.responsive.min.js")}}></script>
    <script src={{asset("assets/admin_panel/dist/js/dataTables-data.js")}}></script>

    <!-- data table-->
    <script>
        $(document).ready(function () {
            $('#user_list_table').DataTable({
                dom: 'Blfrtip',
                responsive: true,
                language: {
                    search: "",
                    searchPlaceholder: "Search",
                },
                "language": {
                    "processing": "Loading. Please wait..."
                },
                "lengthMenu": [[25, 50, 100, 500, 10000], [25, 50, 100, 500, "All"]],
                "bPaginate": true,
                "info": true,
                "bFilter": true,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('order.get') }}",
                    data: function (d) {
                        //d.stock_from = $("input[name=stock_from]").val();
                        //d.stock_to = $("input[name=stock_to]").val();
                        //d.status = $('select[name=status] option:selected').val();
                    }
                },

                "columnDefs": [
                    {
                        "targets": -1,
                        "className": 'all',
                    },
                    {
                        "className": "dt-center",
                        "targets": [2, 3, 4]
                    }
                ],

                columns: [
                    {data: 'code', name: 'code'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'status_updated_by', name: 'status_updated_by'},
                    {
                        'render': function (data, type, row) {
                            let details_button = ' <div class="text-center">' +
                                '<button type="button" class="btn btn-sm btn-outline-dark order_details" style="border: 1px solid !important" ' +
                                '> View\n' +
                                '  </button>' +
                                '<input type="hidden" value="' + row.id + '" class="order_id">' +
                                '</div>';

                            return details_button;
                        },
                    },
                    {
                        'render': function (data, type, row) {
                            let details_button = ' <div class="dropdown">' +
                                '<select name="cars" id="cars">\n' +
                                '  <option value="1">Pending</option>\n' +
                                '  <option value="saab">Processing</option>\n' +
                                '  <option value="mercedes">Dispatched</option>\n' +
                                '  <option value="audi">Delivered</option>\n' +
                                '  <option value="audi">Cancelled</option>\n' +
                                '</select>' + '</div>';
                            return details_button;
                        },
                    },
                    // {data: 'order_status', name: 'order_status'},
                ],

                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });

            //order details modal informations
            $(document).on("click", ".order_details", function () {
                $('#product_table_data tr').remove();
                $('#customer_table_data td').remove();
                $('#total_price').html("");
                $('#total_discount').html("");
                let order_id = $(this).parent().find('.order_id').val();

                $.ajax({
                    type: "GET",
                    url: "{{route('order.details.get')}}",
                    data: {
                        order_id: order_id
                    },

                    success: function (response) {
                         //console.log(response.ordered_products.pivot.product_status);
                        //order details
                        for (var i = 0; i < response.ordered_products.length; i++) {
                            let row = myOrder(response, i);
                            $('#product_table_data').append(row);
                        }

                        //customer details
                        let customer = myCustomers(response);
                        $('#customer_table_data').append(customer);
                        $('#myModal').modal('toggle');

                        //summary detsils
                        let summary = summaryDetails(response);
                        let subtotal = summary['total_price'];
                        let total_discount = summary['total_discount'];
                        let delivery_charge;
                        if(subtotal){
                            delivery_charge = 60;
                        }else{
                            delivery_charge = 0;
                        }

                        let  total_price= (subtotal - total_discount) + delivery_charge;

                        let summary_elem = summaryCalculation(subtotal, total_discount, delivery_charge, total_price);
                        $('#summary_details').html(summary_elem);
                    }
                });
            })
        });

        //product status in modal
        $(document).on("change", ".product_status_select", function () {
            let product_status_select = $(this).val();
            let product_status_parent = $(this).parent().parent();
            let product_id = product_status_parent.find('.product_id').val();
            let order_id = product_status_parent.find('.order_id').val();

            $.ajax({
                type: "GET",
                url: "{{route('order.status.get')}}",
                data: {
                    product_status: product_status_select,
                    product_id: product_id,
                    order_id: order_id
                },
                success: function (response) {
                    //console.log(response);


                    let product_status = product_status_parent.find('.product_status_td');
                    if ((response.product_status) === 1) {

                        product_status.html("<span class='badge badge-pill badge-danger'>Avaiable</span>");
                        //adjustOnchangeTotalPrice(response);
                    }
                    if ((response.product_status) === 0) {
                        product_status.html("<span class='badge badge-pill badge-danger'>Unavaiable</span>");
                        //adjustOnchangeTotalPrice(response);
                    }
                    if ((response.product_status) === 2) {
                        product_status.html("<span class='badge badge-pill badge-danger'>Cancelled</span>");
                        //adjustOnchangeTotalPrice(response);
                    }
                    adjustOnchangeTotalPrice(response);



                    //console.log(response);
                }
            });
        });

        //order details functions
        function myOrder(response, i) {
            let product_status_show = "";
            let product_status = response.ordered_products[i].pivot.product_status;
            let selected = "selected";
            if (product_status === 0) {
                product_status_show = '<span class="badge badge-pill badge-danger">Unavailable</span>';
            }
            if (product_status === 1) {
                product_status_show = '<span class="badge badge-pill badge-danger">Avaiable</span>';
            }
            if (product_status === 2) {
                product_status_show = '<span class="badge badge-pill badge-danger">Cancelled</span>';
            }

            let row = '<tr>\n' +
            '        <td>' + response.ordered_products[i].name + '</td>\n' +
            '        <td>' + response.ordered_products[i].price + '</td>\n' +
            '        <td>' + response.ordered_products[i].pivot.quantity + '<span>Sets</span></td>\n' +
            '        <td>' + response.ordered_products[i].pivot.discount + '</td>\n' +
            '        <td class="product_status_td">' + product_status_show + '</td>\n' +
            '        <td>' +
            '           <select name="cars" class="product_status_select">\n' +
            '               <option value="" selected="selected">select ption</option>\n' +
            '               <option value="1">Avaiable</option>\n' +
            '               <option value="0">Unavaiable</option>\n' +
            '               <option value="2">Cancelled</option>\n' +
                '           </select>' +
                '           <input type="hidden" class="product_id" value="' + response.ordered_products[i].id + '">' +
                '           <input type="hidden" class="order_id" value="' + response.id + '">' +
                '       </td>\n' +
                '      </tr>';
            return row;
        }

        function myCustomers(response) {
            let customer = '<thead>\n' +
                '                                        <tr>\n' +
                '                                            <td>Name</td>\n' +
                '                                            <td>' + response.customer_name + '</td>\n' +
                '                                        </tr>\n' +
                '                                    </thead>\n' +
                '                                    <tbody id="customer_table_data">\n' +
                '                                        <tr>\n' +
                '                                            <td>Billing Address</td>\n' +
                '                                            <td>' + response.billing_address + '</td>\n' +
                '                                        </tr>\n' +
                '                                        <tr>\n' +
                '                                            <td>Shipping Address</td>\n' +
                '                                            <td>' + response.shipping_address + '</td>\n' +
                '                                        </tr>\n' +
                '                                        <tr>\n' +
                '                                            <td>Contact Number</td>\n' +
                '                                            <td>' + response.contact + '</td>\n' +
                '                                        </tr>\n' +
                '                                    </tbody>';
            return customer;
        }

        //summary details functions
        function summaryCalculation(subtotal, discount, delivery, total) {
            return '<tr>\n' +
                '                                        <td> <div class="border-bottom">\n' +
                '                                    <p style="text-decoration: underline">Summary:</p>\n' +
                '                                    <p>Subtotal: <span id="subtotal_id">' + subtotal + '</span> <span>tk</span></p>\n' +
                '                                    <p>Discounts: <span>-</span> <span id="discount_id">' + discount + '</span> <span>tk</span></p>\n' +
                '                                    <p>Delivery charge: <span id="deliveryCharge_id">' + delivery + '</span></p>\n' +
                '                                </div>\n' +
                '                                <div>\n' +
                '                                    <p>Total: <span>' + total + '</span></p>\n' +
                '                                </div></td>\n' +
                '                                        <td></td>\n' +
                '                                        <td></td>\n' +
                '                                        <td></td>\n' +
                '                                        <td></td>\n' +
                '                                        <td></td>\n' +
                '                                    </tr>';


        }

        function summaryDetails(response) {
            let total_price = 0;
            let total_discount = 0;
            for (var i = 0; i < response.ordered_products.length; i++) {
                if(response.ordered_products[i].pivot.product_status==1){
                    let quanitty = response.ordered_products[i].pivot.quantity;
                    let price = response.ordered_products[i].pivot.price;
                    let discount = response.ordered_products[i].pivot.discount;
                    total_discount = total_discount + discount;
                    total_price = total_price + price * quanitty;
                }

            }
            return {total_price: total_price, total_discount: total_discount};
        }

        function adjustOnchangeTotalPrice(response){
            let adjust_subtotal,adjust_discount,new_discount;
            let total;
            var subtotal = document.getElementById("subtotal_id").innerText;
            var discount = document.getElementById("discount_id").innerText;
            var delivery = document.getElementById("deliveryCharge_id").innerText;


            let chage_quantity=response.quantity;
            let change_price=response.price;
            let chnage_discount=response.discount;


            let persed_quantity=parseFloat(chage_quantity);
            let persed_price=parseFloat(change_price);
            subtotal= parseFloat(subtotal);
            let persed_discount=parseFloat(chnage_discount);
            let persed_old_discount=parseFloat(discount);
            let persed_delivery=parseFloat(delivery);
           // console.log(typeof (subtotal));
            //console.log(persed_quantity);
            //console.log(persed_discount);

            if(response.product_status===1){
                adjust_subtotal=persed_quantity*persed_price;
                adjust_discount=persed_quantity*persed_discount;
                subtotal=subtotal+adjust_subtotal;
                new_discount=persed_old_discount+adjust_discount;

            }

            if(response.product_status===0){
                adjust_subtotal=persed_quantity*persed_price;
                adjust_discount=persed_quantity*persed_discount;
                subtotal=subtotal-adjust_subtotal;
                new_discount=persed_old_discount-adjust_discount;
               // console.log(new_discount);
            }
            if(response.product_status===2){
                adjust_subtotal=persed_quantity*persed_price;
                adjust_discount=persed_quantity*persed_discount;
                subtotal=subtotal-adjust_subtotal;
                new_discount=persed_old_discount-adjust_discount;
                //console.log(subtotal);
            }
             if(persed_delivery===0){
                 persed_delivery=60;
             }
             total= (subtotal - new_discount) + persed_delivery;
             //console.log(total);
            $('#summary_details').html(summaryCalculation(subtotal, new_discount, persed_delivery, total));
        }

        //for filtered datatable draw
        $('#btnFiterSubmitSearch').on("click", function () {
            $('#user_list_table').DataTable().draw(true);
        });


    </script>
@endsection
@section("custom_css")
    <style>
        #user_list_table_length {
            margin-right: 10px;
        }

        .dataTables_filter {
            margin-top: -10px;
        }

        .dataTables_filter label {
            text-align: left;
        }
    </style>
@endsection

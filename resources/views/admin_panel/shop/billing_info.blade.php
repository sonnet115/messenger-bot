@extends("admin_panel.main")
@section("product-css")
    <style>
        .pagination {
            display: block !important;
        }

        td {
            font-size: 11px !important;
        }
    </style>
@endsection
@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-15">
        <!-- Product List starts -->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-list-alt"> Shop List</i></h4>
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-sm">
                            <span class="font-18 connect_text text-primary"></span>
                            @if(Session::has('success_message'))
                                <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success_message') }}</p>
                            @endif
                            <div class="table-wrap">
                                <table id="user_list_table" class="table table-bordered w-100 display">
                                    <thead class="btn-gradient-info">
                                    <tr>
                                        <th class="text-center text-white" data-priority="1">Page Name</th>
                                        <th class="text-center text-white"> Subscription Status</th>
                                        <th class="text-center text-white"> Date of payment</th>
                                        <th class="text-center text-white"> Paid Amount</th>
                                        <th class="text-center text-white"> Next Payable Amount</th>
                                        <th class="text-center text-white"> Next Due Date</th>
                                        <th class="text-center text-white" data-priority="1">Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- /Row -->
    </div>
    <!-- /Container -->

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Payment Methods</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row" id="payment_steps">

                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section("billing-js")
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
                dom: 'frtip',
                responsive: true,
                "language": {
                    "processing": "Loading. Please wait..."
                },
                "bPaginate": true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('billing.info.get') }}",
                    type: 'POST',
                },

                "columnDefs": [
                    {
                        "className": "dt-center",
                        "targets": [1, 2, 3, 4, 5, 6]
                    }
                ],
                columns: [
                    {data: 'page_name', name: 'page_name'},
                    {
                        'render': function (data, type, row) {
                            let color = row.page_subscription_status === 1 ? "success" : "danger";
                            let text = row.page_subscription_status === 1 ? "Paid" : "Not Paid";
                            return '<span  style="min-width: 103px" class="badge badge-pill badge-' + color + ' pr-15 pl-15">' + text + '</span>';
                        },
                    },
                    {data: 'billing[0].prev_billing_date', name: 'prev_billing_date'},
                    {data: 'billing[0].paid_amount', name: 'paid_amount'},
                    {data: 'billing[0].payable_amount', name: 'payable_amount'},
                    {data: 'billing[0].next_billing_date', name: 'next_billing_date'},
                    {
                        'render': function (data, type, row) {
                            // let color = row.page_subscription_status === 1 ? "success" : "danger";
                            let color = "success";
                            // let text = row.page_subscription_status === 1 ? "Active" : "Pay Now";
                            let text = "Pay Now";
                            let button = '<input type="hidden" value="' + row.billing[0].payable_amount + '" class="payable_amount">' +
                                '<input type="hidden" value="' + row.billing[0].next_billing_date + '" class="next_billing_date">' +
                                '<button style="min-width: 101px;border:1px solid" class="payment-details shadow btn btn-sm pr-15 pl-15 btn-outline-' + color + '">' + text + '</button>';
                            return button;
                        },
                    }
                ],
                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });
        });

        $(document).on("click", ".payment-details", function () {
            let payable_amount = $(this).parent().find('.payable_amount').val();
            let next_billing_date = $(this).parent().find('.next_billing_date').val();
            let todays_date = new Date();
            next_billing_date = new Date(next_billing_date);

            // var date2 = new Date("8/11/2010");
            let diffDays = todays_date - next_billing_date;

            if(diffDays < 0){
                
            }

            paymentSteps($(this).parent().find('.payable_amount').val());
            $('#myModal').modal('toggle');
        });

        function paymentSteps(amount) {
            let html = '<div class="col-12 col-lg-8">\n' +
                '         <b style="color: #2b383e;font-size: 17px;text-decoration: underline">Payment Steps:</b>\n' +
                '         <br>\n' +
                '         <ol style="padding: 10px 30px">\n' +
                '             <li>Go to bKash Mobile Menu by dialing *247#</li>\n' +
                '             <li>Choose “Send Money”</li>\n' +
                '             <li>Enter 01608435599</li>\n' +
                '             <li>Enter amount ' + amount + ' BDT</li>\n' +
                '             <li>Enter reference Sept1</li>\n' +
                '             <li>Now enter your bKash Mobile Menu PIN to confirm</li>\n' +
                '          </ol>\n' +
                '      </div>';

            $("#payment_steps").html(html);
        }
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
+

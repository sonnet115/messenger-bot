@extends("admin_panel.main")
@section("product-css")
    <style>
        .pagination {
            display: block !important;
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
                                        <th class="text-center text-white">Page Likes</th>
                                        <th class="text-center text-white"> Status</th>
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
                dom: 'frtip',
                responsive: true,
                "language": {
                    "processing": "Loading. Please wait..."
                },
                "bPaginate": true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('shop.list.get') }}",
                },

                "columnDefs": [
                    {
                        "className": "dt-center",
                        "targets": [1, 2, 3]
                    }
                ],
                columns: [
                    {data: 'page_name', name: 'page_name'},
                    {data: 'page_likes', name: 'page_likes'},
                    {
                        'render': function (data, type, row) {
                            let color = row.page_connected_status === 1 ? "success" : "danger";
                            let text = row.page_connected_status === 1 ? "Connected" : "Disconnected";
                            return '<span  style="min-width: 103px" class="badge badge-pill badge-' + color + ' pr-15 pl-15">' + text + '</span>';
                        },
                    },
                    {
                        'render': function (data, type, row) {
                            let color = row.page_connected_status === 1 ? "danger" : "success";
                            let text = row.page_connected_status === 1 ? "Disconnect" : "Connect";
                            return '<button style="min-width: 101px;border:1px solid" onclick="connectDisconnectPage()" class="shadow btn btn-sm pr-15 pl-15 btn-outline-' + color + '">' + text + '</button>';
                        },
                    }
                ],
                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });
        });
    </script>
@endsection

@section("shop-js")
    <script>
        function connectDisconnectPage() {
            FB.login(function (response) {
                console.log(response);
                let connect_text_container = $(".connect_text");
                connect_text_container.html('Please Wait...')
                $.ajax({
                    type: "GET",
                    url: "{{route('page.store')}}",
                    data: {
                        facebook_api_response: response
                    },
                    success: function (backend_response) {
                        if (backend_response === 'success') {
                            connect_text_container.html("Completed!");
                        } else if (backend_response === 'no_page_added') {
                            connect_text_container.html('All Pages Removed. Connect Page Again!');
                        } else {
                            connect_text_container.html('Something went wrong! Try Again.');
                        }
                        setTimeout(function () {
                            window.location.reload(true);
                        }, 1000);
                        console.log(backend_response);
                    }
                });
            }, {scope: 'pages_messaging, pages_manage_metadata, pages_show_list'});
        };
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

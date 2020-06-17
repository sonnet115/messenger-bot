@extends("admin_panel.main")
@section("product-css")
    <style>
        .pagination{
            display: block !important;
        }
    </style>
@endsection
@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-15">
        <!-- filter stast-->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-filter">&nbsp;Filter Products</i>
        </h4>
        <p style="font-size: 20px">Stock</p>
        <div class="row">
            <!--stock filter starts-->

            <div class="form-group col-md-2">
                <div class="controls">
                    <input class="form-control discount_date" type="text" name="start_date" id="start_date" value=""/>
                </div>
            </div>
            <div class="form-group col-md-1">
              <p class="text-center font-15">To</p>
            </div>

            <div class="form-group col-md-2">
                <div class="controls">
                    <input class="form-control discount_date" type="text" name="end_date" id="end_date" value=""/>
                </div>
            </div>
            <!--stock filter ends-->

            <!--button-->
            <div class="text-left col-md-2" style="margin-left: 15px">
                <button type="text" id="btnFiterSubmitSearch" class="btn btn-info" style="margin-top: 19px"><i
                        class="fa fa-search">&nbsp;</i>Filter
                </button>
            </div>
            <!--button ends-->
        </div>
        <!-- filter ends-->

        <!-- Product List starts -->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted" ><i class="fa fa-list-alt"> Product List</i></h4>
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
                                        <th class="text-center text-white" data-priority="1">Name</th>
                                        <th class="text-center text-white">Code</th>
                                        <th class="text-center text-white" data-priority="1">Stock</th>
                                        <th class="text-center text-white">UoM</th>
                                        <th class="text-center text-white">Price</th>
                                        <th class="text-center text-white">State</th>
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
                ajax: '{{ route('product.get') }}',

                "columnDefs": [
                    {
                        "targets": -1,
                        "className": 'all',
                    },
                    {
                        "className": "dt-center",
                        "targets": [2, 3, 4, 5, 6]
                    }
                ],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'code'},
                    {data: 'stock', name: 'stock'},
                    {data: 'uom', name: 'uom'},
                    {data: 'price', name: 'price'},
                    {
                        'render': function (data, type, row) {
                            let color = row.state === 1 ? "success" : "danger";
                            let text = row.state === 1 ? "Active" : "Inactive";
                            return '<span class="badge badge-pill badge-' + color + '">' + text + '</span>';
                        },
                    },
                    {
                        'render': function (data, type, row) {
                            return '<a class="btn btn-sm btn-gradient-secondary" ' +
                                '   href="/admin/product/add-form?mode=update&pid=' + row.id + '">' +
                                '   Update</a>';
                        },
                    },
                ],
                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });
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

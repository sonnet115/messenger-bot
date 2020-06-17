@extends("admin_panel.main")
@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-15">
        <!-- filter stast-->
        <h4>Filter Products</h4>
        <br>
        <div class="row">
            <!--date filter starts-->
            <div class="form-group col-md-3">
                <h5 style="font-size: 16px">Start Date:<span class="text-danger"></span></h5>
                <div class="controls">
                    <input type="date" name="start_date" id="start_date" class="form-control datepicker-autoclose"
                           placeholder="Please select start date">
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="form-group col-md-3">
                <h5 style="font-size: 16px">End Date:<span class="text-danger"></span></h5>
                <div class="controls">
                    <input type="date" name="end_date" id="end_date" class="form-control datepicker-autoclose"
                           placeholder="Please select end date">
                    <div class="help-block"></div>
                </div>
            </div>
            <!--date filter ends-->
            <!--product filter box start-->
            <div class="form-group col-md-3">
                <h5 style="font-size: 16px">Choose product:<span class="text-danger"></span></h5>
                <div class="controls">
                    <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                        <option value="" selected>choose product</option>
                        @foreach($product_name as $products)
                            <option value="{{$products->id}}">{{$products->name}}</option>
                        @endforeach
                    </select>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="text-left col-md-2" style="margin-left: 15px">
                <button type="text" id="btnFiterSubmitSearch" class="btn btn-info">Filter</button>
            </div>
            <!-- product filter box ends-->
        </div>
        <!-- filter ends-->

        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-list-alt"> Product List</i></h2>
        </div>
        <!-- /Title -->
        <!-- Row -->
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
                                        <th class="text-center text-white">Discount Name</th>
                                        <th class="text-center text-white">Discount From</th>
                                        <th class="text-center text-white">Discount To</th>
                                        <th class="text-center text-white">Discount Percentage</th>
                                        <th class="text-center text-white">Maximum customers</th>
                                        <th class="text-center text-white">Action</th>
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

    //select two CDN
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>


    <script>
        $(document).ready(function () {
            $('#user_list_table').DataTable({
                dom: 'Blfrtip',
                responsive: true,
                language: {
                    search: "",
                    searchPlaceholder: "Search",
                    sLengthMenu: "_MENU_items"
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
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('discount.get') }}",
                    data: function (d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                    }
                    },

                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'dis_from', name: 'dis_from'},
                    {data: 'dis_to', name: 'dis_to'},
                    {data: 'dis_percentage', name: 'dis_percentage'},
                    {data: 'max_customers', name: 'max_customers'},
                    {
                        'render': function (data, type, row) {
                            return '<a class="btn btn-sm btn-gradient-ashes" ' +
                                '   href="/admin/discount/add-form?p_name=update&did=' + row.id + '">' +
                                '   Update</a>';
                        },
                    },
                ],
                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });
        });


        $('#btnFiterSubmitSearch').click(function(){
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

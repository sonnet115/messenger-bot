@extends("admin_panel.main")
@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-list-alt"> BP List</i></h2>
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
                                        <th class="text-center text-white">Name</th>
                                        <th class="text-center text-white">Code</th>
                                        <th class="text-center text-white">Stock</th>
                                        <th class="text-center text-white">UoM</th>
                                        <th class="text-center text-white">Price</th>
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
@section("data-table-js")
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
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                ],
                processing: true,
                serverSide: true,
                ajax: '{{ route('product.get') }}',

                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'code'},
                    {data: 'stock', name: 'stock'},
                    {data: 'uom', name: 'uom'},
                    {data: 'price', name: 'price'},
                    {
                        'render': function (data, type, row) {
                            let select_active = "", select_inactive = "";
                            select_active = "selected";
                            return '<button type="button" class="btn btn-gradient-info" data-toggle="modal" data-target="#user' + row.id + '">\n' +
                                '            Edit\n' +
                                '        </button>\n' +
                                '        <!-- The Modal -->\n' +
                                '        <div class="modal fade" id="user' + row.id + '">\n' +
                                '            <div class="modal-dialog">\n' +
                                '                <div class="modal-content">\n' +
                                '                    <!-- Modal Header -->\n' +
                                '                    <div class="modal-header">\n' +
                                '                        <h4 class="modal-title">Update User</h4>\n' +
                                '                        <button type="button" class="close" data-dismiss="modal">&times;</button>\n' +
                                '                    </div>\n' +
                                '                    <!-- Modal body -->\n' +
                                '                    <div class="modal-body text-left">\n' +
                                '                        <form action="/admin/bp/update/' + row.id + '" method="post">\n' +
                                '                             @csrf' +
                                '                            <div class="form-group">\n' +
                                '                                <label>Status:</label>\n' +
                                '                                <select class="form-control" name="active">\n' +
                                '                                    <option value="1" ' + select_active + '> Active </option>\n' +
                                '                                    <option value="0" ' + select_inactive + '>Inactive</option>\n' +
                                '                                </select>\n' +
                                '                            </div>\n' +
                                '                            <div class="modal-footer text-right" style="padding:10px 0px">\n' +
                                '                                <button type="submit" class="btn btn-sm btn-indigo">Update</button>\n' +
                                '                                <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</a>\n' +
                                '                            </div>\n' +
                                '                        </form>\n' +
                                '                    </div>\n' +
                                '                </div>\n' +
                                '            </div>\n' +
                                '        </div>';
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

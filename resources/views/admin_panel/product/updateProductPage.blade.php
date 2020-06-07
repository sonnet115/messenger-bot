@extends("admin_panel.main")

@section("body-content")
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Adminox</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Datatable</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Datatable</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="header-title">Buttons example</h4>
                        <p class="sub-header">
                            The Buttons extension for DataTables provides a common set of options, API methods and
                            styling to display buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p>

                        <table id="product_table" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Stock</th>
                                <th>UOM</th>
                                <th>price</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- end container-fluid -->

    </div> <!-- end content -->
@endsection

@section('update-product-js')
    <!-- Required datatable js -->
    <script src="{{asset('assets/admin/libs/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Buttons examples -->
    <script src="{{asset('assets/admin/libs/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/admin/libs/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/datatables/buttons.colVis.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{asset('assets/admin/libs/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/datatables/responsive.bootstrap4.min.js')}}"></script>

    <!-- Data Tables init -->
    <script src="{{asset('assets/admin/js/pages/datatables.init.js')}}"></script>

    <script>
        $(document).ready(function () {
            let report_table = $('#product_table').DataTable({
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
                "lengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]],
                "bPaginate": true,
                "info": true,
                "bFilter": true,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                ],
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "{{ route('product.get') }}",
                    "type": "get",
                },

                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"},
                ],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'code'},
                    {data: 'stock', name: 'stock'},
                    {data: 'uom', name: 'uom'},
                    {data: 'price', name: 'price'},
                ],
                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });

        });
    </script>

@endsection

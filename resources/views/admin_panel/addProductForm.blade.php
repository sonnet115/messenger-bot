@extends("admin_panel.main")
@section("body-content")
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Adminox</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Form Validation</li>
                    </ol>
                </div>
                <h4 class="page-title">Form Validation</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="col-sm-6">
        <div class="card-box">
            <h4 class="header-title">Add New Product</h4>

            <form action="{{route('product.store')}}" class="parsley-examples">
                <div class="form-group">
                    <label for="userName">Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" parsley-trigger="change" required
                           placeholder="Enter user name" class="form-control" id="userName">
                </div>
                <div class="form-group">
                    <label for="emailAddress">Code<span class="text-danger">*</span></label>
                    <input type="text" name="code" parsley-trigger="change" required
                           placeholder="Enter product code" class="form-control" id="emailAddress">
                </div>
                <div class="form-group">
                    <label for="pass1">Unit of measurement<span class="text-danger">*</span></label>
                    <input id="pass1" name="uom" type="text" placeholder="Enter unit of measurement" required
                           class="form-control">
                </div>
                <div class="form-group">
                    <label for="passWord2">Price<span class="text-danger">*</span></label>
                    <input type="text" required
                           placeholder="enter price" name="price" class="form-control" id="passWord2">
                </div>
                <div class="form-group">
                    <label for="passWord2">Stock<span class="text-danger">*</span></label>
                    <input data-parsley-equalto="#pass1" type="text" required
                           placeholder="Password" name="stock" class="form-control" id="passWord2">
                </div>
                <button class="btn btn-primary">Add product</button>

            </form>
        </div>
    </div>
@endsection

@section('product-js')
    <!-- Validation init js-->
    <script src="{{asset('assets/admin/js/pages/form-validation.init.js')}}"></script>
    <!-- Plugin js-->
    <script src="{{asset('assets/admin/libs/parsleyjs/parsley.min.js')}}"></script>
@endsection

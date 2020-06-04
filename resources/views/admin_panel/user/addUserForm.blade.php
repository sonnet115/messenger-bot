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
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
                <h4 class="page-title">User</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="col-sm-6">
        <div class="card-box">
            <h4 class="header-title">Add New User</h4>
            <br>

            <form method="post" action="{{route('product.store')}}" class="parsley-examples"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="userName">Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" parsley-trigger="change"
                           placeholder="Enter user name" class="form-control" id="userName">
                </div>
                <div class="form-group">
                    <label for="emailAddress">Username<span class="text-danger">*</span></label>
                    <input type="text" name="code" parsley-trigger="change"
                           placeholder="Enter product code" class="form-control">
                </div>
                <div class="form-group">
                    <label for="pass1">Password<span class="text-danger">*</span></label>
                    <input id="pass1" name="uom" type="text" placeholder="Enter unit of measurement"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label for="passWord2">Role<span class="text-danger">*</span></label>
                    <input type="text"
                           placeholder="enter price" name="price" class="form-control">
                </div>
                <button class="btn btn-primary">Add product</button>
            </form>
        </div>
    </div>
@endsection



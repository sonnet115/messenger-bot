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

            <form method="post" action="{{route('user.store')}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name<span class="text-danger">*</span></label>
                    <input type="text" name="name"
                           placeholder="Enter user name" class="form-control" id="userName">
                    @if($errors->has('name'))
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Username<span class="text-danger">*</span></label>
                    <input type="text" name="username"
                           placeholder="Enter product code" class="form-control">
                    @if($errors->has('username'))
                        <p class="text-danger">{{ $errors->first('username') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="pass1">Select Role<span class="text-danger">*</span></label>
                    <select name="roles" class="form-control" data-toggle="select2">
                        <option value="" selected>Select role</option>
                        <option value="manager">Manager</option>
                        <option value="admin">Admin</option>
                    </select>

                    @if($errors->has('roles'))
                        <p class="text-danger">{{ $errors->first('roles') }}</p>
                    @endif
                </div>


                <div class="form-group">
                    <label for="pass1">Password<span class="text-danger">*</span></label>
                    <input id="pass1" name="password" type="text" placeholder="Enter unit of measurement"
                           class="form-control">
                    @if($errors->has('password'))
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>


                <button class="btn btn-primary">Add product</button>
            </form>
        </div>
    </div>
@endsection



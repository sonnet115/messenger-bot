@extends("admin_panel.main")

@section('user-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection


@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-30 mt-sm-30 mt-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-plus"> Add New Role</i>
            </h2>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-7">
                <section class="hk-sec-wrapper" style="padding-bottom: 0px">
                    <div class="row">
                        <div class="col-sm">
                            <form action="{{route('user.store')}}" method="post" novalidate
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-10">Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <input type="text" name="user_name" placeholder="Enter name"
                                               class="form-control" value="{{old('user_name')}}" required>
                                    </div>
                                    <p class="text-danger" id="user_name_error_message"></p>
                                    @if($errors->has('user_name'))
                                        <p class="text-danger">{{ $errors->first('user_name') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Roles</label>
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-magnet"></i></span>
                                        </div>
                                        <select class="js-example-basic-multiple" name="user_roles[]"
                                                multiple="multiple">
                                            <option value="0">Alabama</option>
                                            <option value="1">Wyoming</option>
                                            <option value="2">Alabama</option>
                                            <option value="3">Alabama</option>
                                        </select>
                                    </div>
                                    <p class="text-danger" id="user_role_error_message"></p>
                                    @if($errors->has('user_roles'))
                                        <p class="text-danger">{{ $errors->first('user_roles') }}</p>
                                    @endif

                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary mr-10">
                                        <i class="fa fa-plus-circle"></i> Add Product
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- /Row -->
    </div>
    <!-- /Container -->
@endsection

@section('user-js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });

        $("form").submit(function () {

            let user_name = $('input[name=user_name]').val();
            let user_username = $('input[name=user_username]').val();
            let user_role = $('.js-example-basic-multiple').val();
            let user_password = $('input[name=user_password]').val();

            console.log(user_role);

            let user_name_error_message = $("#user_name_error_message");
            let user_username_error_message = $("#user_username_error_message");
            let user_role_error_message = $("#user_role_error_message");
            let user_password_error_message = $("#user_password_error_message");

            //alert(user_name_error_message);


            user_name_error_message.html("");
            user_username_error_message.html("");
            user_password_error_message.html("");
            user_role_error_message.html("");


            let error_count = 0;

            if (user_name === "") {
                user_name_error_message.html('name field is required');
                error_count++;
            }
            if (user_username === "") {
                user_username_error_message.html('username field is required');
                error_count++;
            }

            if (user_role.length === 0) {
                user_role_error_message.html('role field is required');
                error_count++;
            }


            if (user_password === "") {
                user_password_error_message.html('password field is required');
                error_count++;
            }

            if (error_count > 0) {
                return false;
            }

        });
    </script>
@endsection

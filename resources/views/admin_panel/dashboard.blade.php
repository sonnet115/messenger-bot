@extends("admin_panel.main")
@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-25 mt-sm-30 mt-15">
        @if (auth()->user()->page_added == 0)
            <div class="d-flex justify-content-center">
                <button class="btn btn-danger rounded-20 pl-20 pr-20 connect_page_btn"  onclick="connectPage()">
                    <i class="fa fa-facebook"></i>
                    <span class="connect_text">Connect Page to Messenger Bot</span>
                </button>
            </div>
            <hr>
        @endif
        <div>
            <!-- Title -->
            <div class="hk-pg-header align-items-top">
                <div>
                    <h2 class="hk-pg-title text-muted font-weight-700 mb-10"><i class="fa fa-chrome"> Overview</i></h2>
                </div>
            </div>
            <!-- /Title -->

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="hk-row">
                        <div class="col-lg-12">
                            <div class="hk-row">
                                <div class="col-sm-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                <span class="d-block font-15 text-primary font-weight-500">
                                                    Total Pages
                                                </span>
                                                </div>
                                            </div>
                                            <div>
                                            <span class="d-block display-5 text-dark mb-5 font-weight-bold">
                                                0
                                            </span>
                                                <a href="#" class="d-block"
                                                   style="font-size: 14px">Learn more...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                <span class="d-block font-15 text-warning font-weight-500">
                                                    Total Products
                                                </span>
                                                </div>
                                                <br>
                                            </div>
                                            <div>
                                            <span class="d-block display-5 text-dark mb-5 font-weight-bold">
                                               0
                                            </span>
                                                <a href="#" class="d-block"
                                                   style="font-size: 14px">Learn more...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                <span class="d-block font-15 text-success font-weight-500">
                                                    Total Customers
                                                </span>
                                                </div>
                                            </div>
                                            <div>
                                            <span class="d-block display-5 text-dark mb-5 font-weight-bold">
                                               0
                                            </span>
                                                <a href="#" class="d-block"
                                                   style="font-size: 14px">Learn more...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                <span class="d-block font-15 text-danger font-weight-500">
                                                    Incomplete
                                                </span>
                                                </div>
                                            </div>
                                            <div>
                                            <span class="d-block display-5 text-dark mb-5 font-weight-bold">
                                                0
                                            </span>
                                                <a href="#" class="d-block"
                                                   style="font-size: 14px">Learn more...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hk-row">
                                <div class="col-sm-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="hk-legend-wrap mb-10">
                                                <div class="hk-legend">
                                                    <span
                                                        class="d-10 bg-red-dark-3 rounded-circle d-inline-block"></span>
                                                    <span>Pending</span>
                                                </div>

                                                <div class="hk-legend">
                                                <span
                                                    class="d-10 bg-orange-dark-1 rounded-circle d-inline-block"></span>
                                                    <span>Pending Approval</span>
                                                </div>

                                                <div class="hk-legend">
                                                    <span
                                                        class="d-10 bg-green-dark-1 rounded-circle d-inline-block"></span>
                                                    <span>Completed</span>
                                                </div>

                                                <div class="hk-legend">
                                                    <span class="d-10 bg-blue rounded-circle d-inline-block"></span>
                                                    <span>Incomplete</span>
                                                </div>
                                            </div>
                                            {{--for pie chart data--}}
                                            <input type="hidden" value="0" id="total_given">
                                            <input type="hidden" value="0" id="total_pending">
                                            <input type="hidden" value="0" id="total_incomplete">
                                            <input type="hidden" value="0"
                                                   id="total_pending_approval">
                                            <input type="hidden" value="0" id="total_PO">

                                            <div id="e_chart_1" class="echart" style="height:220px;"></div>

                                            <div class="row">
                                                <div class="col-3 text-center">
                                                    <span class="d-block font-14 text-capitalize mb-5">
                                                        <i class="text-danger fa fa-gift"></i> Pending
                                                        <hr>
                                                        <i class="text-danger font-20">0%</i>
                                                    </span>
                                                </div>
                                                <div class="col-3 text-center">
                                                    <span class="d-block font-14 text-capitalize mb-5">
                                                        <i class="text-orange fa fa-flag-checkered "></i> Pending Approval
                                                         <hr>
                                                        <i class="text-orange font-20">0%</i>
                                                    </span>
                                                </div>
                                                <div class="col-3 text-center">
                                                    <span class="d-block font-14 text-capitalize mb-5">
                                                        <i class="text-green fa fa-check-circle"></i> Completed
                                                          <hr>
                                                        <i class="text-green font-20">0%</i>
                                                    </span>
                                                </div>

                                                <div class="col-3 text-center">
                                                    <span class="d-block font-14 text-capitalize mb-5">
                                                        <i class="text-blue fa fa-info-circle"></i> Incomplete
                                                          <hr>
                                                        <i class="text-blue font-20">0%</i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="hk-row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="card card-sm">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between mb-5">
                                                        <div>
                                                    <span class="d-block font-15 text-indigo font-weight-500">
                                                        Total PO
                                                    </span>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div>
                                                <span
                                                    class="d-block display-5 text-dark mb-5 font-weight-bold">0</span>
                                                        <a href="#" class="d-block"
                                                           style="font-size: 14px">Learn
                                                            more...</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="card card-sm">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between mb-5">
                                                        <div>
                                                    <span class="d-block font-15 font-weight-500"
                                                          style="color: #686a00">
                                                        Total BP
                                                    </span>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div>
                                                <span
                                                    class="d-block display-5 text-dark mb-5 font-weight-bold">0</span>
                                                        <a href="#" class="d-block"
                                                           style="font-size: 14px">Learn
                                                            more...</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
        </div>
    </div>
@endsection

@section("dashboard-js")
    <script>
        function connectPage() {
            FB.login(function (response) {
                console.log(response);
                let connect_btn = $(".connect_page_btn");
                let connect_text = $(".connect_text");
                connect_btn.removeClass('btn-danger').addClass('btn-primary');
                connect_text.html('Please wait. Connecting your page...')
                $.ajax({
                    type: "GET",
                    url: "{{route('page.store')}}",
                    data: {
                        facebook_api_response: response
                    },
                    success: function (backend_response) {
                        if (backend_response === 'success') {
                            connect_btn.removeClass('btn-primary').addClass('btn-success');
                            connect_text.html('Congratulation! Your Page is now connected.');
                            setTimeout(function () {
                                window.location.reload(true);
                            }, 500);
                        } else if (backend_response === 'no_page_added') {
                            connect_btn.removeClass('btn-primary').addClass('btn-danger');
                            connect_text.html('All Pages Removed. Connect Page Again!');
                        } else {
                            connect_btn.removeClass('btn-primary').addClass('btn-danger');
                            connect_text.html('Something went wrong! Try Again.');
                        }

                        console.log(backend_response);
                    }
                });
            }, {scope: 'pages_messaging, pages_manage_metadata, pages_show_list'});
        };
    </script>
@endsection

@section('dashboard_css')

@endsection()

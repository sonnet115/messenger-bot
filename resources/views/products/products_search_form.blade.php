<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form | Shop Name</title>
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/orders/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/orders/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/orders/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/orders/css/iofrm-theme24.css">
</head>
<body style="overflow-x: hidden">

<div class="form-body on-top" style="padding-top:0px">
    <div class="row">
        <div class="form-holder">
            <div class="form-content" style="padding: 10px">
                <div class="form-items">
                    <div class="row">
                        <div class="col-3 col-sm-3">
                            <hr>
                        </div>
                        <div class="col-6 col-sm-6 text-danger text-center">
                            Product Search
                        </div>
                        <div class="col-3 col-sm-3">
                            <hr>
                        </div>

                        <div class="col-12 col-sm-12">
                            <label>Product Code/Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter product code or name ..."
                                   name="product_code" required>
                            <p id="product_code_error" class="text-danger" style="font-size: 13px"></p>
                        </div>

                        <div class="col-12 col-sm-12 text-center">
                            <button id="search" class="btn btn-success" style="border-radius: 5px;padding: 10px 20px"><i
                                    class="fa fa-search"></i> Search
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Starts-->
<div class="modal fade" id="product_list_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">You searched for "PP220039"</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <div class="container">
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>
                    <div class="row shadow-sm pt-4 pb-4" style="margin-bottom: 20px">
                        <div class="col-6" style="max-height: 200px">
                            <div id="demo" class="carousel slide shadow-sm rounded" data-ride="carousel">
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://i.picsum.photos/id/600/200/200.jpg" alt="Los Angeles"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/100/2500/1656.jpg" alt="Chicago"
                                             style="max-height: 170px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://i.picsum.photos/id/1004/5616/3744.jpg" alt="New York"
                                             style="max-height: 170px;">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon text-dark"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon text-dark"></span>
                                </a>
                            </div>
                        </div>

                        <div class="col-6" style="font-size: 13px">
                            <p>Name: <b>Pakistani Three piece</b></p>
                            <p>Code: <b>PP0320345</b></p>
                            <p>In Stock: <b>1000</b></p>
                            <p>Price: <b>1000</b></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- The Modal Ends-->

<script src="{{env("APP_URL")}}assets/orders/js/jquery.min.js"></script>
<script src="{{env("APP_URL")}}assets/orders/js/popper.min.js"></script>
<script src="{{env("APP_URL")}}assets/orders/js/bootstrap.min.js"></script>
<script src="{{env("APP_URL")}}assets/orders/js/main.js"></script>
<script>
    $(document).ready(function () {
        $("#search").on('click', function () {
            let product_code = $("input[name='product_code']").val();

            $.ajax({
                url: '/get-product',
                type: "GET",
                data: {
                    'product_code': product_code,
                },
                success: function (result) {
                    console.log(result);
                    $("#product_list_modal").modal('toggle');
                }
            });

        })
    })
</script>
</body>
</html>

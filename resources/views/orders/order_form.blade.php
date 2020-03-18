<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form | Shop Name</title>
    <link rel="stylesheet" type="text/css" href="https://8d20de63.ngrok.io/assets/orders/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://8d20de63.ngrok.io/assets/orders/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="https://8d20de63.ngrok.io/assets/orders/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="https://8d20de63.ngrok.io/assets/orders/css/iofrm-theme24.css">
</head>
<body>

<div class="text-center" style="margin-top: 20px">
    <h3 class="text-muted">Place Order</h3>
</div>

<div class="form-body on-top" style="padding-top:0px">
    <div class="row">
        <div class="form-holder">
            <div class="form-content" style="padding: 10px">
                <div class="form-items">
                    <form>
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <label>First Name</label>
                                <input type="text" class="form-control" placeholder="First name"
                                       value="{{$user_info->first_name != null ? $user_info->first_name : ""}}">
                            </div>
                            <div class="col-12 col-sm-12">
                                <input type="text" class="form-control" placeholder="Last name"
                                       value="{{$user_info->last_name != null ? $user_info->last_name : ""}}">
                            </div>
                            <div class="col-12 col-sm-12">
                                <input type="text" class="form-control" placeholder="Phone Number">
                            </div>
                            <div class="col-12 col-sm-12">
                                <input type="text" class="form-control" placeholder="Product Code">
                            </div>
                            <div class="col-12 col-sm-12">
                                <input type="text" class="form-control" placeholder="Shipping Address">
                            </div>
                            <div class="col-12 col-sm-12">
                                <input type="text" class="form-control" placeholder="Billing Address">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" placeholder="Tell us about yourself.."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">CV (Resume)</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">Other attachments</label>
                                </div>
                            </div>
                        </div>
                        <div class="row top-padding">
                            <div class="col-12 col-sm-12">
                                <div class="form-button text-right">
                                    <button id="submit" type="submit" class="ibtn less-padding">Submit Application
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://8d20de63.ngrok.io/assets/orders/js/jquery.min.js"></script>
<script src="https://8d20de63.ngrok.io/assets/orders/js/popper.min.js"></script>
<script src="https://8d20de63.ngrok.io/assets/orders/js/bootstrap.min.js"></script>
<script src="https://8d20de63.ngrok.io/assets/orders/js/main.js"></script>
</body>
</html>

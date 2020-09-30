<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Site Title</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh">
        <div class="col-12 col-sm-12 col-md-9 col-lg-5">
            <div class="card">
                <div class="card-body text-center">
                    <div class="text-center">
{{--                        <img src="{{asset('images/logo.png')}}" style="max-width: 100px">--}}
                    </div>
                    <p class="text-center text-muted" style="font-size: 20px">Welcome</p>
                    <hr>
                    <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-primary mb-3"><i
                            class="fa fa-facebook"></i>Continue</a>
                    <p class="text-center text-muted" style="font-size: 11px">by clicking you accept
                        <a href="https://howkar.com/privacy" target="_blank">terms of service</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

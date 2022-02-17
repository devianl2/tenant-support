<html>
<head>
    <title>{{$code}}</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        #main {
            height: 100vh;
        }
    </style>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" id="main">
        <h1 class="mr-3 pr-3 align-top border-right inline-block align-content-center">{{$code}}</h1>
        <div class="inline-block align-middle">
            <h2 class="font-weight-normal lead" id="desc">{{$message}}</h2>
        </div>
    </div>
</body>
</html>
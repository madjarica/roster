<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Blog Home - Start Bootstrap Template</title>
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('assets/css/bootstrap.min.css') }}
            <!-- Custom CSS -->
    {{ HTML::style('assets/css/blog-home.css') }}
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

@include('all.includes.navigation')

<!-- Page Content -->
<div class="container">

@if(Session::has('notice'))
    <br/>
    <div class="alert alert-info">{{ Session::get('notice') }}</div>
@endif

@if(Session::has('error'))
    <br/>
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

@if(Session::has('success'))
    <br/>
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@yield('content')

@include('all.includes.footer')

</div>

<!-- jQuery -->
{{ HTML::script('assets/js/jquery.js') }}
        <!-- Bootstrap Core JavaScript -->
{{ HTML::script('assets/js/bootstrap.min.js') }}

</body>

</html>
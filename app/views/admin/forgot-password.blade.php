<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- Meta tags for google-->

    <title>Forgot password</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="col-md-12">
    <form action="{{ URL::route('forgot-password-post') }}" method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group @if($errors->has('email_address')) has-error has-feedback @endif">
                    <label for="email_address">Email</label>
                    <input type="email" name="email_address" id="email_address" class="form-control" required value="{{ Input::old('email_address') }}">
                    @if($errors->has('email_address')) <label class="control-label">{{ $errors->first('email_address') }}</label> @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-primary margin pull-right">Request new password</button>
            </div>
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>




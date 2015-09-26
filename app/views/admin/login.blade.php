<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">

        {{ HTML::style('assets/css/login.css') }}

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
    </head>

    <body>

    <script async type='text/javascript' src='//cdn.fancybar.net/ac/fancybar.js?zoneid=1502&serve=C6ADVKE&placement=w3layouts' id='_fancybar_js'></script>
        <div class="login-form">
            <div class="head">
                {{ HTML::image('assets/images/logo.png') }}
            </div>

            <form method="post" action="{{ URL::route('login-post') }}">
                @if(Session::has('notice'))
                    <div class="alert alert-info">{{ Session::get('notice') }}</div><br/>
                @endif

                @if(Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div><br/>
                @endif

                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div><br/>
                @endif
                <li>
                    <input type="text" autocomplete="off" name="email" class="text" value="EMAIL" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'USERNAME';}" ><a href="#" class=" icon user"></a>
                </li>

                <li>
                    <input type="password" autocomplete="off" name="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}"><a href="#" class=" icon lock"></a>
                </li>

                <div class="p-container">
                    <a href="{{ URL::route('forgot-password') }}">Forgot password?</a><br>
                    <label class="checkbox"><input type="checkbox" name="checkbox" checked><i></i>Remember Me</label>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" value="SIGN IN" >
                    <div class="clear"> </div>
                </div>
            </form>
        </div>
    </body>
</html>
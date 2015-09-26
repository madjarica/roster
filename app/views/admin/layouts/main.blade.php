<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>UNICEF | Dashboard</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.2 -->
  {{ HTML::style('bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}
  <!-- Font Awesome Icons -->
  {{ HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') }}
  <!-- Ionicons -->
  {{ HTML::style('http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css') }}
  <!-- Theme style -->
  {{ HTML::style('bower_components/AdminLTE/dist/css/AdminLTE.min.css') }}

  {{ HTML::style('bower_components/AdminLTE/plugins/datepicker/datepicker3.css') }}
  {{ HTML::style('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}

  {{ HTML::style('bower_components/AdminLTE/dist/css/skins/skin-blue.min.css') }}

  {{ HTML::style('form_builder/vendor/css/vendor.css') }}
  {{ HTML::style('form_builder/formbuilder.css') }}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>
<body class="skin-blue">
<div class="wrapper">

@include('admin.includes.header')
@include('admin.includes.left-sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

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

  </div><!-- /.content-wrapper -->

@include('admin.includes.footer')

</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->
{{ HTML::script('bower_components/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}
        <!-- Bootstrap 3.3.2 JS -->
{{ HTML::script('bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}
<!-- AdminLTE App -->
{{ HTML::script('http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js') }}
{{ HTML::script('bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js') }}
{{ HTML::script('bower_components/AdminLTE/plugins/ckeditor/ckeditor.js') }}
{{ HTML::script('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}
{{ HTML::script('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.js') }}

@yield('scripts')

{{ HTML::script('form_builder/vendor/js/vendor.js') }}
{{ HTML::script('form_builder/formbuilder.js') }}

@yield('form-scripts')

{{ HTML::script('bower_components/AdminLTE/dist/js/app.js') }}
</body>
</html>
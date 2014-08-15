<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><!-- DC Billing --></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/assets/bootstrap/css/datepicker.css" />
        <link rel="stylesheet" href="/assets/main_blade_custom.css">
        <script src="/assets/js/jquery-1.10.1.min.js"></script>
        <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="/assets/bootstrap/js/bootstrap-tab.js"></script>
         <script src="/assets/bootstrap/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" href="/assets/custom.css">
        <script src="/assets/js/custom_script.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><!-- DC Billing --></a>
        </div>
         @if(Auth::check())
        <div class="navbar-collapse collapse  pull-right">
          <ul class="nav navbar-nav">
            <li><a href="/logout" class="white">Logout</a></li>
          </ul>
        </div><!--/.navbar-collapse -->
        @endif
      </div>
    </div>
   
    <div class="container container_mid">
      @if(Session::get('flash_message'))
        <div class="alert alert-success ">
          {{ Session::get('flash_message') }}
        </div>
      @endif
      
      @yield('content')
      <hr>

      <footer>
        <p>&copy; <!-- Prism TechNovations Pvt. Ltd. 2014 --></p>
      </footer>

    </div> <!-- /container -->
     
    <script src="/assets/js/bootstrap-filestyle.min.js"></script>

    <script src="/assets/js/main.js"></script>
   

    <script>
       /* var _gaq=[['_setAccount','UA-11854742-1'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src='//www.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));*/
    </script>
    </body>
</html>
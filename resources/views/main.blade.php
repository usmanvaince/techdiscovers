<!doctype html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Blog Management System</title>
    <!-- Css files -->
    <link href="/css/animate.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="/css/demo.css" media="all" rel="stylesheet" type="text/css">
    <link href="/css/light-bootstrap-dashboard.css" media="all" rel="stylesheet" type="text/css">
    <link href="/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" media="all" rel="stylesheet" type="text/css">
    <link href="/css/pe-icon-7-stroke.css" media="all" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" type="text/css" >


    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous">

    </script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="/js/bootstrap.min.js" type="application/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" type="application/javascript"></script>
    <script src="/js/light-bootstrap-dashboard.js" type="application/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="/js/ajax.js" type="application/javascript"></script>


    <!-- libraries for data export -->
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>

    <!-- Confirmation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

    <!-- Angularjs -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.css' type='text/css' media='all' />
    <script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.js'></script>
    <script src="https://code.angularjs.org/1.2.0/angular-animate.min.js" ></script>
    <!-- tinymce -->
    <script src="/js/tinymce.min.js" type="application/javascript"></script>
    <script src="/js/angular-tinymce.js" type="application/javascript"></script>

    <!-- Tags input -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ng-tags-input/3.2.0/ng-tags-input.bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ng-tags-input/3.2.0/ng-tags-input.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ng-tags-input/3.2.0/ng-tags-input.js"></script>

    <!-- Toaster -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angularjs-toaster/2.2.0/toaster.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angularjs-toaster/2.2.0/toaster.js"></script>

    <script>


    var app = angular.module("myApp", ["ngRoute","angular-loading-bar","ui.tinymce","ngTagsInput","toaster"]);

</script>
    <link href="/css/style.css" media="all" rel="stylesheet" type="text/css">

</head>
<body ng-app="myApp">
<div class="wrapper" id="app">
    @include('layout.sidebar')
    <div class="main-panel">
        @include('layout.navbar')
        <div class="content">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default" id="main">

                            <div ng-view>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="/js/route.js" type="application/javascript"></script>
<script src="/js/app.js" type="application/javascript"></script>


</body>
</html>
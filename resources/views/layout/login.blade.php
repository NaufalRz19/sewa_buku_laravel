<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Buku</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
    @include('layout.header')
    @include('layout.navbar_login')
    @yield('content')
    <script type="text/javascript">
        $('.date').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: 'true'
        });
    </script>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/peminjamapp.js') }}"></script>
</body>
</html>

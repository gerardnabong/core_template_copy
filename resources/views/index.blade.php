<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Portal</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{mix('/css/shared.css')}}">
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
</head>

<body class="position-relative">
    testing
    <div class="client-portal-pre-loader"></div>
    <div id="app"></div>
</body>
@include('js_vars')
<script src="{{mix('/js/shared.js')}}"></script>
<script src="{{mix('/js/app.js')}}"></script>

</html>

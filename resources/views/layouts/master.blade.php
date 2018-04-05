<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env("APP_NAME")}}</title>

    <link rel="stylesheet" href="/css/bulma.css">
    <link rel="stylesheet" href="/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<body class="is-fullheight">
@include('partials.navbar')
@yield('content')


<script src="/js/navbar.js"></script>
<script src="https://use.fontawesome.com/b46ab0ff9f.js"></script>
<script src="/js/axios.js"></script>
<script src="/js/missionTable.js"></script>
<script src="/js/review.js"></script>
<script src="/js/accounts.js"></script>
<script src="/js/bugs.js"></script>
<script src="/js/misc.js"></script>
</body>



</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Restofast</title>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/msgbox.css">
    @vite('resources/js/app.js')
</head>
<body>
    <div id="app"></div>

	<script type="application/javascript" src="/js/msgbox.js"></script>
</body>
</html>

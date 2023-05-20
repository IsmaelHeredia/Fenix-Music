<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport"
	content="width=device-width, initial-scale=1, user-scalable=yes">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<title>Login</title>
	<link rel="icon" href="{{ asset('images/fenix.jpg') }}">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
	<div class="container-fluid">
		@yield('content')
	</div>
</body>
</html>
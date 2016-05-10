<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

	<!-- Bootstrap core CSS -->
	<link href="/css/application.css" rel="stylesheet">

	<style>
		body {
			font-family: 'Lato';
		}

		.fa-btn {
			margin-right: 6px;
		}
	</style>
</head>
<body id="falcon-agency-test-application">

@include('_partials.navbar')

<div class="container">
	@yield('content')
</div>

@if (Session::has('flash_notification.message'))
	<div class="hidden">
		<input type="hidden" data-plugin="notification" data-type="{{ Session::get('flash_notification.level') }}"
			   value="{{ Session::get('flash_notification.message') }}"/>
	</div>
@endif
<script src="/js/application.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Simple Bookstore</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

	<!-- Bootstrap core CSS -->
	<link href="/css/application.css?v=<?php echo time() ?>" rel="stylesheet">

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


<div class="container container-1000">
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 text-center" style="margin-top:300px;">
			<h1>SimpleBookstore</h1>

			<form action="{{route('books.index')}}" method="GET">
				<div class="form-group row">
					<div class="col-xs-12">
						<input class="form-control input-lg" type="text" name="keyword"/>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-xs-6 text-right">

						<input class="btn btn-primary" type="submit" value="Book search"/>
					</div>
					<div class="col-xs-6 text-left">

						<input class="btn btn-success" type="submit" value="I'm feeling lucky"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="/js/application.js"></script>
</body>
</html>

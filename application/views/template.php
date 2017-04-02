<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>{pagetitle}</title>
        <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<!--<link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="screen"/>-->
		<link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
		{caboose_styles}
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
        <div id="container">
			<div class="navbar">
				<div class="navbar-inner">
					<a class="brand" href="/"><img width="50" src="/assets/images/logo.png"/></a>
					{menubar}
				</div>
			</div>
			<div id="content">
				<h1>{pagetitle}</h1>
				{alerts}
				{content}
			</div>
			<div id="footer" class="span12">
				Copyright lemon &copy; 2017,  <a href="mailto:someone@somewhere.com">Me</a>.
			</div>
        </div>
<!--		{caboose_scripts}-->
<!--		{caboose_trailings}-->
		<!--<script src="/assets/js/jquery-1.11.1.min.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>-->
	</body>
</html>
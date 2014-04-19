<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />

		<link rel="stylesheet" type="text/css" href="<?php echo css_url('bootstrap'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo css_url('design'); ?>">

		<title>Ask Around</title>
	</head>

	<body>
		<header>
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
				    <div class="navbar-header">
			    		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        		<span class="sr-only">Toggle navigation</span>
			        		<span class="icon-bar"></span>
			        		<span class="icon-bar"></span>
			        		<span class="icon-bar"></span>
			      		</button>
			      		<a class="navbar-brand" href="<?php echo site_url(); ?>"><?php echo img("logo.png", ""); ?></a>
			    	</div>

				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      		<ul class="nav navbar-nav navbar-right aa-menu">
			        		<li><a href="<?php echo site_url(); ?>">Home</a><span class="glyphicon glyphicon-home"></span></li>
			        		<li><a href="#">Questions<span></span></a><span class="glyphicon glyphicon-question-sign"></span></li>
			        		<li><a href="#">Ask<span></span></a><span class="glyphicon glyphicon-pencil"></span></li>
			        		<li class="li-btn"><button type="button" id="btnToLogin" class="btn btn-success">Sign in</button></li>
			      		</ul>
			      		<form class="form-inline nav navbar-nav navbar-right aa-login" role="form" action="<?php echo site_url(); ?>" method="post">
					        <input name="pseudo" type="text" class="form-control" placeholder="Pseudonym" required>
					        <input name="password" type="password" class="form-control" placeholder="Password" required>
					        <button class="btn btn-success" type="submit">Sign in</button>
					        <button class="btn btn-danger" id="btnToMenu" type="button"><span class="glyphicon glyphicon-remove"></span></button>
      					</form>
			    	</div>
				</div>
			</nav>
		</header>
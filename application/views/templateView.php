<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Product Management panel</title>
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/forms.css">

</head>
<body>
<?php use Cgi\Application\Models\UserModel;?>
	<header>
		<ul class="main-menu">
			<?php if(!UserModel::isGuest()) { ?>
				<li><a href="http://pmpanel.loc/main/index">Main page</a></li>
				<li><a href="http://pmpanel.loc/main/importPage">Product Import page</a></li>
				<li><a href="http://pmpanel.loc/data/list">Product Listing page</a></li>
				<li><a href="http://pmpanel.loc/main/logout">Logout</a></li>
			<?php } else { ?>
				<li><a href="http://pmpanel.loc/main/login">Login</a></li>
			<?php } ?>
		</ul>
	</header>
	<div class="content">
		<?php include 'application/views/'.$contentView; ?>
	</div>
	<footer>

	</footer>
</body>
</html>
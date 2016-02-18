<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Main</title>
	<link rel="stylesheet" type="text/css" href="/css/main.css">

</head>
<body>
<?php use Cgi\Application\Models\UserModel;?>

	<ul class="main-menu">
		<?php if(!UserModel::isGuest()) { ?>
			<li><a href="http://pmpanel.loc/main/index">Main page</a></li>
			<li><a href="http://pmpanel.loc/main/importPage">Product Import page</a></li>
			<li><a href="http://pmpanel.loc/main/listingPage">Product Listing page</a></li>
			<li><a href="http://pmpanel.loc/main/editingPage">Product Editing page</a></li>
			<li><a href="http://pmpanel.loc/main/logout">Logout</a></li>
		<?php } else { ?>
			<li><a href="http://pmpanel.loc/main/login">Login</a></li>
		<?php } ?>
	</ul>

	<?php include 'application/views/'.$contentView; ?>
</body>
</html>
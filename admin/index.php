<?php
	session_start();
	include_once '../assets/php/functions.php';
	$admin = new Admin();
	$user = new User();

	if(isset($_SESSION['allergyhelp_admin_id']))
		$id = $_SESSION['allergyhelp_admin_id'];

	if (isset($_GET['q']))
	{
		$admin->logout();
		header("location:index.php");
	}
	if (isset($_REQUEST['submitlog'])) 
	{ 
		extract($_REQUEST);
		$login = $admin->check_login($username, $password);
		if ($login == 1) header("location:index.php");
		else if ($login == -1) $_SESSION['allergyhelp_admin_login_not_admin'] = true;
		else $_SESSION['allergyhelp_admin_login_fail'] = true;
	}
	if (!$admin->get_session())
	{
?>
<!DOCTYPE html>
<html lang="ro" class="login">

<head>
	<meta charset="utf-8">
	<meta name="theme-color" content="#cf5454">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Discode">
	<title>AllergyHelp</title>

	<link rel="icon" type="image/x-icon" href="../assets/img/icon.png" />
	<link href="../assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/admin.css" rel="stylesheet">
</head>

<body>
	<div class="cover">
		<form action="" method="post" name="register" id="login-form">
			<a href="../"><img class="brand" src="../assets/img/logo-green.png" /></a>
			<?php
				if (isset($_SESSION['allergyhelp_admin_login_fail']))
				{
					echo '<p class="wrong">Date de logare incorecte!</p>';
					$_SESSION['allergyhelp_admin_login_fail'] = false;
					unset($_SESSION['allergyhelp_admin_login_fail']);
				}
				if (isset($_SESSION['allergyhelp_admin_login_not_admin']))
				{
					echo '<p class="wrong">Nu sunteți administrator!</p>';
					$_SESSION['allergyhelp_admin_login_not_admin'] = false;
					unset($_SESSION['allergyhelp_admin_login_not_admin']);
				}
			?>
			<input type="text" name="username" id="log-username" placeholder="Nume de utilizator" required="" autocomplete="off" autofocus="">
			<input type="password" name="password" id="log-password" placeholder="Parolă" required="">
			<button type="submit" name="submitlog">Logare</button>
		</form>
	</div>
	
	<script src="../assets/js/jquery/jquery.min.js"></script>
	<script src="../assets/js/bootstrap/bootstrap.min.js"></script>

</body>

</html>
<?php
	}
	else 
	{
?>
<!DOCTYPE html>
<html lang="ro">

<head>
	<meta charset="utf-8">
	<meta name="theme-color" content="#cf5454">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Discode">
	<title>AllergyHelp</title>

	<link rel="icon" type="image/x-icon" href="../assets/img/icon.png" />
	<link href="../assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/admin.css" rel="stylesheet">
</head>

<body class="bg-light">
	
	<nav class="navbar navbar-dark bg-dark">
		<div class="container">
    		<a class="navbar-brand" href="."><img src="../assets/img/logo-green.png" /></a>
    		<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img class="avatar" src="<?php echo $user->get_avatar($id); ?>"><?php echo $user->get_firstname($id); ?>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="?q=logout">Delogare</a>
					</div>
				</li>
			</ul>
		</div>
		<div class="navbar-links">
			<div class="container d-flex flex-column flex-md-row justify-content-between">
				<a class="py-2 d-none d-md-inline-block" href="#">Setări site</a>
				<a class="py-2 d-none d-md-inline-block" href="#">Utilizatori</a>
				<a class="py-2 d-none d-md-inline-block" href="#">Alergii</a>
				<a class="py-2 d-none d-md-inline-block" href="#">Tratamente</a>
				<a class="py-2 d-none d-md-inline-block" href="#">Pagini</a>
				<a class="py-2 d-none d-md-inline-block" href="#">Administratori</a>
			</div>
		</div>
	</nav>


	<main role="main">
		<section class="jumbotron text-center">
			<div class="container">
				<div class="row">
					<div class="col-md">
						<div class="card box-shadow">
							<div class="card-body">
								<h1>0</h1>
								<p class="card-text">
									Utilizatori înregistrați
								</p>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="card box-shadow">
							<div class="card-body">
								<h1>0</h1>
								<p class="card-text">
									Alergii adăugate
								</p>
							</div>
						</div>
					</div>
					<div class="col-md">
						<div class="card box-shadow">
							<div class="card-body">
								<h1>0</h1>
								<p class="card-text">
									Tratamente propuse
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="card box-shadow last-changes">
						<div class="card-header text-center font-weight-bold">
							Ultimele modificări
						</div>
						<div class="card-body p-1">
							<ul class="list-group list-group-flush">
								<li class="list-group-item">
									<img class="avatar float-left" src="../assets/img/avatars/1.jpg?=1460364161" />
									<strong>Alexandru Toderică</strong> a adăugat un administrator nou
									<br><small class="time text-muted">acum 5 minute</small>
								</li>
								<li class="list-group-item">
									<img class="avatar float-left" src="../assets/img/avatars/1.jpg?=1460364161" />
									<strong>Alexandru Toderică</strong> a adăugat un administrator nou
									<br><small class="time text-muted">acum 5 minute</small>
								</li>
								<li class="list-group-item">
									<img class="avatar float-left" src="../assets/img/avatars/1.jpg?=1460364161" />
									<strong>Alexandru Toderică</strong> a adăugat un administrator nou
									<br><small class="time text-muted">acum 5 minute</small>
								</li>
								<li class="list-group-item">
									<img class="avatar float-left" src="../assets/img/avatars/1.jpg?=1460364161" />
									<strong>Alexandru Toderică</strong> a adăugat un administrator nou
									<br><small class="time text-muted">acum 5 minute</small>
								</li>
								<li class="list-group-item">
									<img class="avatar float-left" src="../assets/img/avatars/1.jpg?=1460364161" />
									<strong>Alexandru Toderică</strong> a adăugat un administrator nou
									<br><small class="time text-muted">acum 5 minute</small>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md">
					<div class="card box-shadow last-changes">
						<div class="card-header text-center font-weight-bold">
							Ultimele logări
						</div>
						<div class="card-body p-1">
							<ul class="list-group list-group-flush">
								<li class="list-group-item">
									<img class="avatar float-left" src="../assets/img/avatars/1.jpg?=1460364161" />
									<strong>Alexandru Toderică</strong>
									<br><small class="time text-muted">acum 5 minute</small>
								</li>
								<li class="list-group-item">
									<img class="avatar float-left" src="../assets/img/avatars/1.jpg?=1460364161" />
									<strong>Alexandru Toderică</strong>
									<br><small class="time text-muted">acum 5 minute</small>
								</li>
								<li class="list-group-item">
									<img class="avatar float-left" src="../assets/img/avatars/1.jpg?=1460364161" />
									<strong>Alexandru Toderică</strong>
									<br><small class="time text-muted">acum 5 minute</small>
								</li>
								<li class="list-group-item">
									<img class="avatar float-left" src="../assets/img/avatars/1.jpg?=1460364161" />
									<strong>Alexandru Toderică</strong>
									<br><small class="time text-muted">acum 5 minute</small>
								</li>
								<li class="list-group-item">
									<img class="avatar float-left" src="../assets/img/avatars/1.jpg?=1460364161" />
									<strong>Alexandru Toderică</strong>
									<br><small class="time text-muted">acum 5 minute</small>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<footer>
		Realizat pentru <strong><a href="https://fiicode.asii.ro/" target="_blank" rel="noopener">FIICode 2018</a></strong> de către echipa <strong>Discode</strong>.
	</footer>
	<script src="../assets/js/jquery/jquery.min.js"></script>
	<script src="../assets/js/popper/popper.min.js"></script>
	<script src="../assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="../assets/js/script.js"></script>

</body>

</html>
<?php
	}
?>
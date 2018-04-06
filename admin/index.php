<?php
	session_start();
	include_once '../assets/php/functions.php';
	$admin = new Admin();
	$user = new User();

	if(isset($_SESSION['allergyhelp_admin_id']))
		$id = $_SESSION['allergyhelp_admin_id'];

	if (isset($_GET['q']))
	{
		$admin->admin_logout();
		header("location:index.php");
	}
	if (isset($_REQUEST['submitlog'])) 
	{ 
		extract($_REQUEST);
		$login = $admin->check_login($email, $password);
		if ($login == 1) header("location:index.php");
		else if ($login == -1) $_SESSION['allergyhelp_admin_login_not_admin'] = true;
		else $_SESSION['allergyhelp_admin_login_fail'] = true;
	}
	if (isset($_REQUEST['add_user']))
	{
		extract($_REQUEST);
		$register = $admin->add_user($id, $reg_email, $reg_password, $reg_lastname, $reg_firstname);
		if ($register) $_SESSION['allergyhelp_admin_add_user_success'] = true;
		else $_SESSION['allergyhelp_admin_add_user_fail'] = true;
	}
	if (isset($_GET['makeadmin']))
	{
		$userid = $_GET['makeadmin'];
		$makeadmin = $admin->set_admin($id, $userid);
		if ($makeadmin) $_SESSION['allergyhelp_admin_add_admin_success'] = true;
		else $_SESSION['allergyhelp_admin_add_admin_fail'] = true;
		header("location:index.php?p=users");
	}
	if (isset($_GET['revokeadmin']))
	{
		$userid = $_GET['revokeadmin'];
		$revokeadmin = $admin->revoke_admin($id, $userid);
		if ($revokeadmin) $_SESSION['allergyhelp_admin_remove_admin_success'] = true;
		else $_SESSION['allergyhelp_admin_remove_admin_fail'] = true;
		header("location:index.php?p=users");
	}
	if ($admin->get_admin_session())
	{
		if(!$admin->isadmin($id))
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
	</nav>
	<p class="no-admin text-center">Drepturile de administrator ți-au fost revocate. <a href="index.php?q=logout">Click aici pentru delogare.</a></p>

	<footer>
		Realizat pentru <strong><a href="https://fiicode.asii.ro/" target="_blank" rel="noopener">FIICode 2018</a></strong> de către echipa <strong>Discode</strong>.
	</footer>
	<script src="../assets/js/jquery/jquery.min.js"></script>
	<script src="../assets/js/popper/popper.min.js"></script>
	<script src="../assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="../assets/js/admin.js"></script>
	
</body>

</html>
<?php
		}
		else
		{
			if(isset($_GET['p'])) $p = $_GET['p'];
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
				<a class="py-2 d-none d-md-inline-block<?php if ((isset($p) ? $p : null) == "users") echo ' active'; ?>" href="?p=users">Utilizatori</a>
				<a class="py-2 d-none d-md-inline-block" href="#">Alergii</a>
				<a class="py-2 d-none d-md-inline-block" href="#">Tratamente</a>
				<a class="py-2 d-none d-md-inline-block" href="#">Pagini</a>
			</div>
		</div>
	</nav>

	<?php
		if(empty($p)) // Pagina principala
		{
	?>
	<main role="main">
		<section class="jumbotron text-center">
			<div class="container">
				<div class="row">
					<div class="col-md">
						<div class="card box-shadow">
							<div class="card-body">
								<h1><?php echo $admin->count_users(); ?></h1>
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
								<?php $admin->get_actions(); ?>
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
								<?php $admin->get_logins(); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php
		}
		else if($p === "users")
		{
	?>
	<div class="modal fade" id="modal_add_user">
		<div class="modal-dialog"  role="document">
			<form action="" method="post" name="add_user">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Înregistrează utilizator</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="reg-email" class="form-control-label">Email:</label>
							<input type="email" class="form-control" name="reg_email" id="reg-email" placeholder="Adresă de email" required>
						</div>
						<div class="form-group">
							<label for="reg-password" class="form-control-label">Parola:</label>
							<input type="password" class="form-control" name="reg_password" id="reg-password" placeholder="Parolă" pattern=".{6,}" required title="Parola trebuie să aibă minim 6 caractere.">
						</div>
						<div class="form-group">
							<label for="reg-lastname" class="form-control-label">Nume:</label>
							<input type="text" class="form-control" name="reg_lastname" id="reg-lastname" placeholder="Nume" required>
						</div>
						<div class="form-group">
							<label for="reg-firstname" class="form-control-label">Prenume:</label>
							<input type="text" class="form-control" name="reg_firstname" id="reg-firstname" placeholder="Prenume" required>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" type="submit" name="add_user">Înregistrează</button>
						<button class="btn btn-secondary" data-dismiss="modal">Închide</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<main role="main">
		<div class="container pt-4">
			<?php
				if (isset($_SESSION['allergyhelp_admin_add_user_success']))
				{
					echo '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Utilizatorul a fost înregistrat cu succes!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
					$_SESSION['allergyhelp_admin_add_user_success'] = false;
					unset($_SESSION['allergyhelp_admin_add_user_success']);
				}
				if (isset($_SESSION['allergyhelp_admin_add_user_fail']))
				{
					echo '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Există deja un utilizator cu acest email!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
					$_SESSION['allergyhelp_admin_add_user_fail'] = false;
					unset($_SESSION['allergyhelp_admin_add_user_fail']);
				}
				if (isset($_SESSION['allergyhelp_admin_add_admin_success']))
				{
					echo '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Ai adăugat un administrator cu succes!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
					$_SESSION['allergyhelp_admin_add_admin_success'] = false;
					unset($_SESSION['allergyhelp_admin_add_admin_success']);
				}
				if (isset($_SESSION['allergyhelp_admin_add_admin_fail']))
				{
					echo '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						A apărut o problemă la adăugarea administratorului!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
					$_SESSION['allergyhelp_admin_add_admin_fail'] = false;
					unset($_SESSION['allergyhelp_admin_add_admin_fail']);
				}
				if (isset($_SESSION['allergyhelp_admin_remove_admin_success']))
				{
					echo '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Ai revocat drepturile de administrator ale utilizatorului cu succes!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
					$_SESSION['allergyhelp_admin_remove_admin_success'] = false;
					unset($_SESSION['allergyhelp_admin_remove_admin_success']);
				}
				if (isset($_SESSION['allergyhelp_admin_remove_admin_fail']))
				{
					echo '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						A apărut o problemă la revocarea drepturilor de administrator!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
					$_SESSION['allergyhelp_admin_remove_admin_fail'] = false;
					unset($_SESSION['allergyhelp_admin_remove_admin_fail']);
				}
			?>
			<h1>Administratori</h1>
			<hr class="mt-0 mb-3" />
			<div class="row mb-4">
				<?php $admin->get_admins(); ?>
			</div>
			<h1>Utilizatori</h1>
			<hr class="mt-0 mb-3" />
			<a class="btn add-user btn-sm btn-block" data-toggle="modal" data-target="#modal_add_user">Înregistrează utilizator</a>
			<table id="users-table" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th>Nume</th>
						<th>Email</th>
						<th>Data înregistrării</th>
						<th>Acțiuni</th>
					</tr>
				</thead>
				<tbody>
					<?php $admin->get_users(); ?>
				</tbody>
			</table>
		</div>
	</main>
	<?php
		}
	?>
	<footer>
		Realizat pentru <strong><a href="https://fiicode.asii.ro/" target="_blank" rel="noopener">FIICode 2018</a></strong> de către echipa <strong>Discode</strong>.
	</footer>
	<script src="../assets/js/jquery/jquery.min.js"></script>
	<script src="../assets/js/popper/popper.min.js"></script>
	<script src="../assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="../assets/js/admin.js"></script>

</body>

</html>

<?php
		}
	}
	else 
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
			<input type="text" name="email" id="log-email" placeholder="Adresă de email" required="" autocomplete="off" autofocus="">
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
?>
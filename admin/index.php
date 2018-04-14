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
	if (isset($_REQUEST['editp_user']))
	{
		extract($_REQUEST);
		$edit = $admin->edit_profile($id, $editp_email, $editp_password, $editp_lastname, $editp_firstname);
		if ($edit) $_SESSION['allergyhelp_admin_editp_user_success'] = true;
		else $_SESSION['allergyhelp_admin_editp_user_fail'] = true;
	}
	if(isset($_POST['image-data']))
	{
		$img = $_POST['image-data'];
		$img = substr($img, 1+strrpos($img, ','));
		file_put_contents('../assets/img/avatars/'.$id.'.png', base64_decode($img));
		$img = imagecreatefrompng("../assets/img/avatars/".$id.".png");
		unlink("../assets/img/avatars/".$id.".png");
		$success = imagejpeg($img, "../assets/img/avatars/".$id.".jpg",100);
		if($success) $_SESSION['allergyhelp_admin_add_avatar_success'] = true;
		else $_SESSION['allergyhelp_admin_add_avatar_fail'] = true;
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
	<meta name="theme-color" content="#5fcf80">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Discode">
	<title>AllergyHelp</title>

	<link rel="icon" type="image/x-icon" href="../assets/img/icon.png" />
	<link href="../assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/admin.css" rel="stylesheet">
</head>

<body class="bg-light">
	
	<p class="no-admin text-center">
		Drepturile de administrator ți-au fost revocate.
		<br /><a href="index.php?q=logout">Click aici pentru delogare.</a>
	</p>
	
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
	<meta name="theme-color" content="#5fcf80">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Discode">
	<title>AllergyHelp</title>

	<link rel="icon" type="image/x-icon" href="../assets/img/icon.png" />
	<link href="../assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/fontawesome/fontawesome.min.css" rel="stylesheet">
	<link href="../assets/css/admin.css" rel="stylesheet">

	<script src="../assets/js/jquery/jquery.min.js"></script>
	<script src="../assets/js/popper/popper.min.js"></script>
	<script src="../assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="../assets/js/cropit/cropit.js"></script>
	<script src="../assets/js/admin.js"></script>
</head>

<body class="bg-light">
	
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand m-auto" href="."><img src="../assets/img/logo-green.png" /></a>
			<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="icon-bar top-bar"></span>
				<span class="icon-bar middle-bar"></span>
				<span class="icon-bar bottom-bar"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item d-lg-none"><a class="nav-link" href="../"><i class="fa fa-fw fa-home"></i> Înapoi la site</a></li>
					<li class="nav-item d-lg-none"><a class="nav-link<?php if ((isset($p) ? $p : null) == "users") echo ' active'; ?>" href="?p=users"><i class="fa fa-fw fa-users"></i> Utilizatori</a></li>
					<li class="nav-item d-lg-none"><a class="nav-link<?php if ((isset($p) ? $p : null) == "allergies") echo ' active'; ?>" href="?p=allergies"><i class="fa fa-fw fa-allergies"></i> Alergii</a></li>
					<div class="separator d-lg-none"></div>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img class="avatar" src="<?php echo $user->get_avatar($id); ?>"><?php echo $user->get_firstname($id); ?>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item<?php if ((isset($p) ? $p : null) == "account") echo ' active'; ?>" href="?p=account"><i class="fa fa-fw fa-cog"></i> Setări cont</a>
							<a class="dropdown-item" href="?q=logout"><i class="fa fa-fw fa-sign-out-alt"></i> Delogare</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="navbar-links">
			<div class="container d-flex flex-column flex-lg-row justify-content-between">
				<a class="py-2 d-none d-lg-inline-block" href="../"><i class="fa fa-fw fa-home"></i> Înapoi la site</a>
				<a class="py-2 d-none d-lg-inline-block<?php if ((isset($p) ? $p : null) == "users") echo ' active'; ?>" href="?p=users"><i class="fa fa-fw fa-users"></i> Utilizatori</a>
				<a class="py-2 d-none d-lg-inline-block<?php if ((isset($p) ? $p : null) == "allergies") echo ' active'; ?>" href="?p=allergies"><i class="fa fa-fw fa-allergies"></i> Alergii</a>
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
					<div class="col">
						<div class="card box-shadow">
							<div class="card-body">
								<h1><?php echo $admin->count_users(); ?></h1>
								<p class="card-text font-weight-bold">
									Utilizatori
								</p>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card box-shadow">
							<div class="card-body">
								<h1>0</h1>
								<p class="card-text font-weight-bold">
									Alergii
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
						<div class="form-group row">
							<label for="reg-email" class="form-control-label col-sm-2 col-form-label">Email:</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" name="reg_email" id="reg-email" placeholder="Adresă de email" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="reg-password" class="form-control-label col-sm-2 col-form-label">Parola:</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="reg_password" id="reg-password" placeholder="Parolă" pattern=".{6,}" required title="Parola trebuie să aibă minim 6 caractere.">
							</div>
						</div>
						<div class="form-group row">
							<label for="reg-lastname" class="form-control-label col-sm-2 col-form-label">Nume:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="reg_lastname" id="reg-lastname" placeholder="Nume" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="reg-firstname" class="form-control-label col-sm-2 col-form-label">Prenume:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="reg_firstname" id="reg-firstname" placeholder="Prenume" required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-sm btn-primary ml-auto" type="submit" name="add_user">Înregistrează</button>
						<button class="btn btn-sm btn-secondary mr-auto" data-dismiss="modal">Închide</button>
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
			<a class="btn add-user btn-block" data-toggle="modal" data-target="#modal_add_user">Înregistrează utilizator</a>
			<div class="table-responsive">
				<table id="users-table" class="table table-sm">
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
		</div>
	</main>
	<?php
		}
		else if($p === "allergies")
		{
	?>
	<main role="main">
		<div class="container pt-4">
			<h1>Alergii</h1>
			<hr class="mt-0 mb-3" />
		</div>
	</main>
	<?php
		}
		else if($p === "account")
		{
	?>
	<form action="" method="post" name="photo" id="photo">
		<div class="modal fade" id="modal_edit_avatar">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Schimbă fotografia de profil</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body text-center">
						<small class="text-muted">Fotografia trebuie să aibă dimensiunile de minim 300px înălțime/lățime.</small>
						<hr />
						<div class="image-editor">
							<label for="load-photo">
								<a class="btn btn-sm btn-info"><i class="fa fa-fw fa-upload"></i> Încarcă o fotografie</a>
							</label>
							<input type="file" class="cropit-image-input" id="load-photo" required>
							<div class="image-editor-controls">
								<hr />
								<div class="cropit-preview"></div>
								<hr />
								<div class="controls">
									<div class="btn-group">
									<button type="button" class="btn btn-sm btn-default disabled" style="cursor: default;">Rotește fotografia</button>
									<a class="rotate-ccw btn btn-sm btn-primary"><i class="fa fa-undo"></i></a>
									<a class="rotate-cw btn btn-sm btn-primary"><i class="fa fa-redo"></i></a>
									</div>
									<hr />
									Scalează fotografia:
									<br />
									<input type="range" class="cropit-image-zoom-input" min="0" max="100">
									<input type="hidden" name="image-data" class="hidden-image-data" />
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button class="export btn btn-sm btn-primary ml-auto" type="submit" name="photo">Schimbă</button>
						<button class="btn btn-sm btn-default mr-auto" data-dismiss="modal">Închide</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<main role="main">
		<div class="container pt-4">
			<?php
				if (isset($_SESSION['allergyhelp_admin_change_pass_success']))
				{
					echo '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Parola ta a fost schimbată!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
					$_SESSION['allergyhelp_admin_change_pass_success'] = false;
					unset($_SESSION['allergyhelp_admin_change_pass_success']);
				}
				if (isset($_SESSION['allergyhelp_admin_change_pass_fail']))
				{
					echo '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						A apărut o problemă la schimbarea parolei!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
					$_SESSION['allergyhelp_admin_change_pass_fail'] = false;
					unset($_SESSION['allergyhelp_admin_change_pass_fail']);
				}
				if (isset($_SESSION['allergyhelp_admin_editp_user_success']))
				{
					echo '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Datele tale au fost modificate!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
					$_SESSION['allergyhelp_admin_editp_user_success'] = false;
					unset($_SESSION['allergyhelp_admin_editp_user_success']);
				}
				if (isset($_SESSION['allergyhelp_admin_editp_user_fail']))
				{
					echo '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Adresa de email specificată există deja!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
					$_SESSION['allergyhelp_admin_editp_user_fail'] = false;
					unset($_SESSION['allergyhelp_admin_editp_user_fail']);
				}
				if (isset($_SESSION['allergyhelp_admin_add_avatar_success']))
				{
					echo '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Fotografia de profil a fost schimbată!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
					$_SESSION['allergyhelp_admin_add_avatar_success'] = false;
					unset($_SESSION['allergyhelp_admin_add_avatar_success']);
				}
				if (isset($_SESSION['allergyhelp_admin_add_avatar_fail']))
				{
					echo '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						A apărut o eroare la schimbarea fotografiei de profil. Încearcă din nou mai târziu.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					';
					$_SESSION['allergyhelp_admin_add_avatar_fail'] = false;
					unset($_SESSION['allergyhelp_admin_add_avatar_fail']);
				}
			?>
			<h1>Setările contului</h1>
			<hr class="mt-0 mb-3" />
			<form action="" method="post" name="editp_user">
				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-10">
						<a class="btn btn-sm btn-info btn-avatar" data-toggle="modal" data-target="#modal_edit_avatar"><i class="fa fa-fw fa-user-circle"></i> Schimbă fotografia de profil</a>
					</div>
				</div>
				<hr />
				<div class="form-group row">
					<label for="editp-password" class="form-control-label col-sm-2 col-form-label">Parolă nouă:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="editp_password" id="editp-password" placeholder="Completează doar dacă vrei să-ți schimbi parola" pattern=".{6,}" title="Parola trebuie să aibă minim 6 caractere.">
					</div>
				</div>
				<hr />
				<div class="form-group row">
					<label for="editp-email" class="form-control-label col-sm-2 col-form-label">Email:</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" name="editp_email" id="editp-email" placeholder="Adresă de email" value="<?php echo $user->get_email($id); ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="editp-lastname" class="form-control-label col-sm-2 col-form-label">Nume:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="editp_lastname" id="editp-lastname" placeholder="Nume" value="<?php echo $user->get_lastname($id); ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="editp-firstname" class="form-control-label col-sm-2 col-form-label">Prenume:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="editp_firstname" id="editp-firstname" placeholder="Prenume" value="<?php echo $user->get_firstname($id); ?>" required>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-2"></div>
					<div class="col-sm-10">
						<button class="btn btn-sm btn-primary" type="submit" name="editp_user">Salvează modificările</button>
						<button class="btn btn-sm btn-danger" type="reset">Resetează câmpurile</button>
					</div>
				</div>
			</form>
		</div>
	</main>
	<?php
		}
	?>
	<footer>
		Realizat pentru <strong><a href="https://fiicode.asii.ro/" target="_blank" rel="noopener">FIICode 2018</a></strong> de către echipa <strong>Discode</strong>.
	</footer>
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
	<meta name="theme-color" content="#5fcf80">
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
			<br /><small class="brand-subtitle">Panou de administrare</small>
			<input type="text" name="email" id="log-email" placeholder="Adresă de email" required="" autocomplete="off" autofocus="">
			<input type="password" name="password" id="log-password" placeholder="Parolă" required="">
			<button type="submit" name="submitlog">Logare</button>
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
		</form>
	</div>
</body>

</html>

<?php
	}
?>
<?php
require_once('init.php');
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 'Da')
{
	die('Nu aveti permisiune de accesare');
}
	
if(!isset($_SESSION['editor']) || $_SESSION['editor'] != 'Da')
{
	die('Nu aveti permisiune de accesare');
}
if(!isset($_GET['pag']))
{
	$_GET['pag'] = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Adauga Stire - New Magazine </title>

	<!-- Bootstrap Core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="../css/business-casual.css" rel="stylesheet">

</head>

<body>
<div class="brand">News Magazine</div>
<div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>

<!-- Navigation -->
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
			<a class="navbar-brand" href="index.php">New Magazine</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li>
					<a href="pagina.php">Acasa</a>
				</li>
				<li>
					<a href="vizualizareStiri.php">Vizualizare Stiri</a>
				</li>

			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>

<div class="container">

	<?php


switch($_GET['pag'])
{
	case '':
		?>
		<div class="box">
			<form role="form" action="admin.php?pag=verifica" method="post">
				<div class="form-group">
					<label>Utilizator: </label>
					<input type="text" name="interzis">
				</div>
				<div class="form-group">
					<label>Motiv : </label>
					<input type="text" name="motiv">
				</div>
				<input type="submit" name="Adauga" value="Adauga">
				</form>
		</div>
		<?php
		break;
	case 'verifica':

	if(($_POST['interzis'] == '')  || (strlen($_POST['interzis']) < 2) || (strlen($_POST['interzis']) > 255) || ($_POST['motiv'] == '') || (strlen($_POST['motiv']) < 2) || (strlen($_POST['motiv']) > 255))
	{
		?>
		<div class="box">
			<?php
			echo 'Completeaza corect campurile. <br>
				Vezi daca: ai completat campurile, daca ai scris mai mult de 2 caractere si mai
				putin de 255<br><br>
				Apasa <a href="admin.php">aici</a> pentru a te intoarce.';
			?>
		</div>
		<?php
	}
	else
	{
	$cerereSQL = "INSERT INTO accesInterzis (`interzis`, `motiv`) VALUES ('".$_POST['interzis']."','".$_POST['motiv']."');";
	$q=$conn->prepare($cerereSQL);
	$q->execute();
	?>
	<div class="box">
		<?php
		echo 'Am introdus datele in baza de date. <br>
			Apasa <a href="pagina.php">aici</a> pentru a te intoarce la pagina principala.';
		?>
	</div>
	<?php
	break;
	?>
</div>
<?php
}
}

?>
</body>
</html>

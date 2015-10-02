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
if(!isset($_SESSION['logat']))
{
	$_SESSION['logat'] = 'Nu';
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Autentificare - New Magazine </title>

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
					<a href="index.php">Acasa</a>
				</li>

			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>
<div class="container">
	<div class="box">
		<?php
if($_SESSION['logat'] != 'Da') 
{
	echo 'Pentru a accesa aceasta pagina, trebuie sa va autentificati. <br>
		Pentru a va autentifica, apasati <a href="autentificare.php">aici</a><br>
		Pentru a va inregistra, apasati <a href="inregistrare.php">aici</a>';
}
else
{
	echo 'Bine ai venit, <b><i>'.$_SESSION['user'].'</b></i>!';
	echo'<br><br>';
	echo'<a href="profil.php">Schimba date personale</a><br><br>
		<a href= "ultimulUtilizator.php"> Ultimul utilizator inregistrat</a><br><br>
		<a href= "utilizatorLenes.php"> Cel mai lenes utilizator</a><br><br>
		<a href= "interzicere.php"> Interzicere user</a><br><br>
		<a href= "paginare.php"> Vizualizeaza Stiri</a><br><br>
		<a href= "statistici.php"> Statistici asupra site-ului</a><br><br>
		<a href= "aprobare.php"> Aprobarea unei stiri</a><br><br>
		<a href= "arhivare.php"> Arhivarea unei stiri</a><br><br>
		<a href= "aprobaModerator.php"> Aprobarea moderatorilor</a><br><br>
		<a href= "modificareStire.php"> Modificarea unei stiri</a><br><br>
		<a href="iesire.php">Iesire</a>';
}

?>
		</div>
	</div>
</body>
</html>

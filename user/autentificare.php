<?php
require_once('init.php');

if(!isset($_GET['actiune']))
{
	$_GET['actiune'] = '';
}
if(!isset($_SESSION['id']))
{
	$_SESSION['id']='';
}
if(!isset($_SESSION['user']))
{
	$_SESSION['user']='';
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
					<li>
						<a href="inregistrare.php">Inregistrare</a>
					</li>

				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>

	<div class="container">
<?php
switch($_GET['actiune'])
{
	case '':
		?>
			<div class="box">
				<div class="col-lg-4">
				<form role="form" method="post" action ="autentificare.php?actiune=validare">
						<div class="form-group">
							<label>Utilizator</label>
							<input type="text" name="user"  class="form-control" value="">
						</div>
						<div class="form-group">
							<label> Parola </label> <br>
							<input type="password" name="parola" class="form-control" value="">
						</div>
					<input type="submit" name="Login" value="Login">
					</form>
				</div>
			</div>


		<?php
		break;
	case 'validare':

		$_SESSION['user'] = $_POST['user'];
		if(($_POST['user'] == '') || ($_POST['parola'] == ''))
		{
			?>
				<div class="box">
					<?php
			echo 'Completeaza casutele. <Br>
				  Apasati <a href="autentificare.php">aici</a> pentru a va intoarce la pagina precedenta.';
			?>
					</div>
		<?php
		}
		else
		{
			$cerereSQL = "SELECT * FROM utilizatori WHERE utilizator='".$_POST['user']."' AND parola='".md5($_POST['parola'])."'";
			$rezultat = $conn->query($cerereSQL);
			$rezultat->setFetchMode(PDO::FETCH_ASSOC);
			$count=$rezultat->rowCount();
			if($count==1 )
			{
				while($rand=$rezultat->fetch())
				{
					$cerereSQL = 'UPDATE `utilizatori` SET vizite="'.($rand['vizite']+1).'" WHERE id="'.$rand['id'].'"';
					$rezultat = $conn->prepare($cerereSQL);
					$rezultat->execute();
					$_SESSION['logat'] = 'Da';
					$_SESSION['id'] = $rand['id'];
					echo'<META HTTP-EQUIV=Refresh CONTENT="0;URL=pagina.php">';
					}
				}
			else
			{
				?>
				<div class="box">
					<?php
					echo 'Date incorecte. <Br>
					 Apasati <a href="autentificare.php">aici</a> pentru a va intoarce la pagina precedenta.';

					?>
				</div>
				<?php
			}

		}
		break;
}



?>

</body>
</html>

<?php
require_once 'init.php';

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

		<title>Cauta Stire - New Magazine </title>

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
			<div class="col-lg-4">
				<form role="form" method="post" action="cauta.php?pag=cauta">
					<div class="form-group">
				<label> Stire: </label>
				<input type="text" name="cauta" value="">
				<input type="submit" name="Cauta" value="Cauta">
				</div>
				</form>
			</div>
			<a href="cauta.php?pag=cautare-avansata"> Cautare avansata </a>
		</div>

		<?php
		break;

	case 'cauta':
		if($_POST['cauta'] == '')
		{
		   ?>
			<div class="box">
			<?php
			echo 'Introdu un cuvant pentru a cauta in baza de date. <br>
      		      Apasa <a href="cauta.php">aici</a> pentru a te intoarce.';
			?>
			</div>
			<?php
		}
		elseif(strlen($_POST['cauta']) < 3)
		{
			?>
			<div class="box">
			<?php
			echo 'Cuvantul trebuie sa contina cel putin 3 caractere. <br>
				  Apasa <a href="cauta.php">aici</a> pentru a te intoarce.';

			?>
			</div>
			<?php
		}
		else
		{
			$cerereSQL = 'SELECT * FROM `stiri` WHERE `stire` LIKE "%'.$_POST['cauta'].'%"';
			$rezultat = $conn->query($cerereSQL);
			$rezultat->setFetchMode(PDO::FETCH_ASSOC);
			$count = $rezultat->rowCount();
			if($count > 0)
			{
				while($rand = $rezultat->fetch())
				{
					echo $rand['stire'];
					echo '<br>';
				}
			}
			else
			{

				?>

				<div class="box">
				<?php
				echo 'Nu au fost gasite rezultate pentru cautarea:'.$_POST['cauta'].'</i></b></font> <br>
	  				  Apasati <a href="cauta.php">aici</a> pentru a va intoarce';
				?>
				</div>
				<?php
			}
		}
		break;

	case 'cautare-avansata':
			?>
			<div class="box">
				<div class="col-lg-4">
					<form role="form" action="cauta.php?pag=cautare-avansata2" method="post" >
						<label> Cauta  </label>
						<input type="text" name="cauta" value=""> <br> <br>
						<label> in </label>
						<input type="checkbox" name="in1" value="stire" id="stire">
						<label for="stire"> Stire </label>
						<input type="submit" name="Cauta" value="Cauta"> <br>
						</form>
				</div>
			</div>
		<?php

		break;

	case 'cautare-avansata2':

		if(!isset($_POST['in1']))
		{
			$_POST['in1'] = '';
		}
		if($_POST['cauta'] == '')
		{
			?>
			<div class="box">
			<?php
			echo 'Introdu un cuvant pentru a cauta in baza de date. <br>
      			  Apasa <a href="cauta.php">aici</a> pentru a te intoarce.';

			?>
			</div>
			<?php
		}
		elseif(strlen($_POST['cauta']) < 3)
		{
			?>
			<div class="box">
			<?php
			echo 'Cuvantul trebuie sa contina cel putin 3 caractere. <br>
      			  Apasa <a href="cauta.php">aici</a> pentru a te intoarce.';

			?>
			</div>
			<?php
		}
		else
		{
			if($_POST['in1'] != '')
			{
				$cerereSQL = 'SELECT * FROM `stiri` WHERE `stire` LIKE "%'.$_POST['cauta'].'%"';
				$in = '';
				$rezultat =$conn->query($cerereSQL);
				$rezultat->setFetchMode(PDO::FETCH_ASSOC);
				$count1 = $rezultat->rowCount();
				if($count > 0)
				{
					?>
					<div class="box">
					<?php
					echo 'Cautati in:'.$in.'</font> dupa: '.$_POST['cauta'].'</b></font><br><br>';

					?>
					</div>
					<?php
					while($rand = $rezultat->fetch())
					{
						?>
						<div class="box">
						<?php
						echo $rand['stire'];
						?>
							<br>
						</div>
						<?php
					}
				}
				else
				{

					?>
					<div class="box">
					<?php
					echo 'Nu au fost gasite rezultate pentru cautarea:'.$_POST['cauta'].' in '.$in.'<br>
		 				  Apasati <a href="cauta.php?pag=cautare-avansata">aici</a> pentru a va intoarce';

					?>
					</div>
					<?php
				}
			}

			break;
			?>
			</div>
		<?php
		}
}

?>

</body>
</html>

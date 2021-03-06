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
					<a href="pagina.php">Inregistrare</a>
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

require_once('init.php');
if(!isset($_SESSION['stireId']))
{
	$_SESSION['stireId']='';
}


$cuvinteInterzise = array("test");
$inlocuiesteCu = "<span style=\"color:red; font-style: italic;\">***</span>";

function cenzura($continut)
{
	global $cuvinteInterzise, $inlocuiesteCu;
	foreach($cuvinteInterzise as $cuvinte)
	{
		$continut = str_replace($cuvinte, $inlocuiesteCu, $continut);
	}
	return $continut;
}

$rezultateLinie = 1;
$rezultateColoane = 1;
$selectSQL = 'SELECT COUNT(*) AS Nr FROM `stiri`';
$query = $conn->query($selectSQL);
$row = $query->fetch(PDO::FETCH_ASSOC);
$totale = $row['Nr'];
if((int)$row['Nr'] ==0)
{
	echo 'Nu exista stiri
		Pentru a va intoarce apasati <a href="pagina.php">aici</a>.';
}
else
{
	if(!isset($_GET['pagina']))
	{
		$pagina=1;
	}
	else
	{
		$pagina = $_GET['pagina'];
	}
}
$cerereSQL=$conn->query(('SELECT * FROM `stiri` WHERE `vizibil` =1 AND `status` ="published" ORDER by `id` ASC LIMIT '.(($pagina * ($rezultateColoane*$rezultateLinie)) - ($rezultateColoane*$rezultateLinie)).', '.($rezultateColoane*$rezultateLinie).' '));
$cerereSQL->setFetchMode(PDO::FETCH_ASSOC);
$paginiTotale = ceil( $totale/($rezultateLinie * $rezultateColoane));
if($pagina > $paginiTotale)
{
	echo 'Pagina nu a fost gasita';
}
elseif($paginiTotale>0)
{
	echo '<b>Stiri</b><br><br>';
	$seteaza = 0;
	$numar = ($pagina - 1) * ($rezultateColoane*$rezultateLinie);
	$culoare_celula = '#FFE0B3';
	echo "<table border=\"0\"><tr>\n";
	while($rand = $cerereSQL->fetch())
	{
		$_SESSION['stireId']=$rand['id'];
		$nr++;
		if($seteaza == $rezultateLinie)
		{
			echo "</tr><tr>\n";
			$seteaza=1;
			if($culoareCelula == "#FFE0B3")
			{
				$culoareCelula = "#FFFFFF";
			}
			else
			{
				$culoareCelula = "#FFE0B3";
			}

		}
		else
		{
			$seteaza++;
		}
		if($rand['vizibil'] ==1)
		{
			$rand['stire']= cenzura($rand['stire']);
			echo "<td bgcolor=".$culoare_celula."> ".$rand['stire']."</td>\n";
			echo '<a href="pagina.php"> Intoarce-te la pagina principala</a><br><br>';
		}
	}
	echo "</tr></table>";
	if($paginiTotale == 1)
	{
		echo '';
	}
	else
	{
		echo '<div align="left">';
		if($pagina > 1)
		{
			$inapoi=($pagina-1);
			echo '<a href="'.$_SERVER['PHP_SELF'].'?pagina='.$inapoi.'">&laquo;</a>&nbsp;';
		}
		for($pagini = 1; $pagini <= $paginiTotale; $pagini++)
		{
			if(($pagina) == $pagini) echo '<b>'.$pagini.'</b>&nbsp;';
			else echo '<a href="'.$_SERVER['PHP_SELF'].'?pagina='.$pagini.'">'.$pagini.'</a>&nbsp;';

		}
		if($pagina < $paginiTotale)
		{
			$inainte = ($pagina + 1);
			echo '<a href=" '.$_SERVER['PHP_SELF'].'?pagina='.$inainte.'">&raquo;</a>&nbsp;';
		}
		echo '</div>';
	}
}



?>
		</div>
	</div>
</body>
</html>

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
if(!isset($_GET['actiune']))
{
	$_GET['actiune'] = '';
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
switch($_GET['actiune'])
{
	case '':

		echo '<h1>Stiri</h1>
			Apasati <a href="modificareStire.php?actiune=modificareStiri">aici</a> pentru a schimba datele stirilor.<br>
			<a href="pagina.php">Intoarceti-va la pagina principala.</a>';


		break;

	case 'modificareStiri':
		$cerereSQL = 'SELECT * FROM stiri';
		$rezultat = $conn->query($cerereSQL);
		$rezultat->setFetchMode(PDO::FETCH_ASSOC);
		while($rand = $rezultat->fetch())
		{
			?>
		<form role="form" action="modificareStire.php?actiune=validare&stireId=<?php echo $rand['id']; ?>" method="post">
			<div class="form-group">
				<label> Stire: </label>
				<input type="text" name="stire" value = "<?php echo $rand['stire']; ?>">
				</div>
				<input name="Trimite" type="submit" id="Trimite" value="Modifica">
				<input name="Sterge" type="submit" id="Sterge" value="Sterge">
		</form>
			<br><br>
	<?php
		}
		break;
	case 'validare':
		if(!isset($_POST['stire']))
		{
			$_SESSION['stire'] = '';
		}
		else
		{
			$_SESSION['stire'] = $_POST['stire'];
		}
		if(($_POST['Trimite'] == 'Modifica ') && ($_SESSION['stire'] == '')) {

			echo 'Completeaza campurile.<br>
				Apasa <a href="modificareStiri.php?actiune=modificareStiri">aici</a> pentru a te intoarce.';
		}
		elseif(($_POST['Trimite'] == 'Modifica') && ($_SESSION['stire'] != ''))
		{

			echo 'Datele au fost modificate. <br>
				 Apasa <a href="pagina.php">aici</a> pentru a te intoarce la pagina principala.';

			if(isset($_GET['stireId']) && (int)$_GET['stireId'] > 0)
			{
				$cerereSQL = "UPDATE stiri SET stire='".$_SESSION['stire']."' WHERE `id` = ".(int)$_GET['stireId']."";
				$q=$conn->prepare($cerereSQL);
				$q->execute();
			}
		}
		if(($_POST['Sterge'] == 'Sterge') && ($_SESSION['stire'] != ''))
		{
			$cerereSQL="DELETE FROM stiri WHERE `id`=".(int)$_GET['stireId']."";
			$rezultat=$conn->prepare($cerereSQL);
			$rezultat->execute();

			echo 'Stirea a fost stearsa . <br>
				Apasa <a href="pagina.php">aici</a> pentru a te intoarce la pagina principala.';

		}

		$_SESSION['stire'] = '';
		break;
}
	
?>
		</div>
	</div>
</body>
</html>

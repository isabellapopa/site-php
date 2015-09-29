<?php
require_once('init.php');

if(!isset($_SESSION['stire']))
{
	$_SESSION['stire'] = '';
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
	switch($_GET['actiune'])
	{
	case '':
		?>
		<div class="box">
			<div class="col-lg-4">
				<form role="form" method="post" action="adaugaStire.php?actiune=validare" >
					<div class="form-group">
						<div class="form-group col-lg-12">
							<label> Stire: </label>
							<textarea class="form-control" name="stire" rows="6" ><?php echo $_SESSION['stire'];?> </textarea>
						</div>
						<input name="Trimite" type="submit" id="Trimite" value="Trimite">
				</form>
			</div>
		</div>
	<?php
	case 'validare':
	$_SESSION['stire'] = $_POST['stire'];
	if($_SESSION['stire'] == '')
	{
		echo 'Pentru a va intoarce apasati <a href="pagina.php">aici</a>.';
	}
	else
	{
	?>
	<div class="box">
		<?php
		echo 'Va multumim. <br>
			Stirea a fost preluata. <br>
			Pentru a va intoarce apasati <a href="pagina.php">aici</a>.';
		$insertSQL=  "INSERT INTO stiri (`stire`, `utilizatorId`, `status`)
                     VALUES ('".$_SESSION['stire']."', ".$_SESSION['id'].", 'draft') ";
		$q = $conn->prepare($insertSQL);
		$q->execute();
		unset($_SESSION['stire']);
		}
		?>
	</div>
</div>
<?php
break;
}
?>
</div>
</body>
</html>

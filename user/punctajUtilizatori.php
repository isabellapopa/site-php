<?php
require_once('init.php');
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
<?php
$cerereSQL="SELECT * FROM utilizatori ORDER by puncte DESC";
$rezultat=$conn->query($cerereSQL);
$rezultat->setFetchMode(PDO::FETCH_ASSOC);
 $count=0;
 while($utilizator=$rezultat->fetch())
 {
	 if($count<10)
	 {
		 ?>
		<div class="box">
			<?php
		 echo $utilizator['utilizator'];
		 ?>
			</div>
		<?php
		 echo "<br>";
		 $count ++;
	 }
 }


?>
	</div>
</body>
</html>

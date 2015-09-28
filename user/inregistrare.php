<?php

require_once('init.php');

if(!isset($_GET['actiune']))
{
    $_GET['actiune'] = '';
}
if(!isset($_SESSION['user']))
{
    $_SESSION['user'] = '';
}
if(!isset($_SESSION['parola1']))
{
    $_SESSION['parola1'] = '';
}
if(!isset($_SESSION['parola2']))
{
    $_SESSION['parola2'] = '';
}
if(!isset($_SESSION['nume']))
{
    $_SESSION['nume'] = '';
}
if(!isset($_SESSION['prenume']))
{
    $_SESSION['prenume'] = '';
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

    <title>Inregistrare - New Magazine </title>

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
                    <a href="index.php">Home</a>
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
    case '': ?>

            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Formular inregistrare
                    </h2>
                    <hr>
                    <form role="form" action="inregistrare.php?actiune=validare" method="post">
                        <div class="form-group">
                            <label> Utilizator: </label>
                            <input type="text" name="user" value="<?php echo $_SESSION['user']; ?>">
                        </div>

                        <div class="form-group">
                            <label> Parola: </label>
                            <input type="password" name="parola1" value="<?php echo $_SESSION['parola1']; ?>">
                        </div>

                        <div class="form-group">
                            <label> Reintroduceti parola:  </label>
                            <input type="password" name="parola2" value="<?php echo $_SESSION['parola2']; ?>">
                        </div>

                        <div class="form-group">
                            <label> Nume  </label>
                            <input type="text" name="nume" value="<?php echo $_SESSION['nume']; ?>">
                        </div>

                        <div class="form-group">
                            <label> Prenume  </label>
                            <input type="text" name="prenume" value="<?php echo $_SESSION['prenume']; ?>">
                        </div>

                        <input type="submit" name="Trimite" id="Trimite" value="Trimite">
                    </form>
                </div>
            </div>

<?php

    break;

  case 'validare':
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['parola1'] = $_POST['parola1'];
    $_SESSION['parola2'] = $_POST['parola2'];
    $_SESSION['nume'] = $_POST['nume'];
    $_SESSION['prenume'] = $_POST['prenume'];
    if(($_SESSION['user'] == '') || ($_SESSION['parola1'] == '') || ($_SESSION['parola2'] != $_SESSION['parola1']) || ($_SESSION['nume'] == '') || ($_SESSION['prenume'] == ''))
    {

    ?>
    <div class="box">
    <?php
      echo 'Nu ai introdus date in formular sau cele introduse nu sunt corecte. <br>
		    Apasa <a href="inregistrare.php">aici</a> pentru a te intoarce la pagina anterioara.';
    ?>
     </div>

    <?php
    }
    else
    {
    ?>
    <div class="box">
    <?php

      echo 'Va multumim. <br>
		    Datele au fost introduse cu succes in baza de date. <br>
	        Pentru a va autentifica apasati <a href="autentificare.php">aici</a>.';

    ?>
    </div>
    <?php
      $cerereSQL = "INSERT INTO utilizatori (`utilizator`, `parola`, `nume`, `prenume`)
				    VALUES ('".$_SESSION['user']."', '".md5($_SESSION['parola1'])."', '".$_SESSION['nume']."', '".$_SESSION['prenume']."')";
      $q=$conn->prepare($cerereSQL);
      $q->execute();
      $_SESSION['user'] = '';
      $_SESSION['parola1'] = '';
	  $_SESSION['parola2'] = '';
	  $_SESSION['nume'] = '';
	  $_SESSION['nume'] = '';
	  $_SESSION['prenume'] = '';
    }

    break;

    ?>
</div>
<?php
}

?>
</body>
</html>






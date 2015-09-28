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
if(!isset($_SESSION['logat']))
{
  $_SESSION['logat'] = 'Nu';
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

if($_SESSION['logat'] != 'Da')
{
    ?>

    <?php
  echo 'Pentru a accesa aceasta pagina, trebuie sa va autentificati. <br>
		Pentru a va autentifica, apasati <a href="autentificare.php">aici</a><br>
		Pentru a va inregistra, apasati <a href="inregistrare.php">aici</a>';
}


else
{
  switch($_GET['actiune'])
  {


    case '':

      echo '<h1>Profilul dumneavoastra</h1>
				Apasati <a href="profil.php?actiune=date_personale">aici</a> pentru a schimba datele personale.<br>
				Apasati <a href="profil.php?actiune=parola">aici</a> pentru a schimba parola dumneavoastra.<br><br>
				<a href="pagina.php">Intoarceti-va la pagina principala.</a>';
      break;



    case 'date_personale':

      $cerereSQL = 'SELECT * FROM `utilizatori` WHERE utilizator="'.$_SESSION['user'].'"';
      $rezultat = $conn->query($cerereSQL);
      $rezultat->setFetchMode(PDO::FETCH_ASSOC);
      while($rand =$rezultat->fetch())
      {
        echo '<table width="347" border="0" cellpadding="0" cellspacing="0">
	              <form name="formular" action="profil.php?actiune=validare" method="post">
	              <tr>
	              <td height="50" colspan="4" valign="top"><h1>Modifica date personale</h1></td>
	              </tr>
	              <tr>
	              <td width="80" height="19">&nbsp;</td>
	              <td width="15">&nbsp;</td>
	              <td width="214">&nbsp;</td>
	              <td width="38">&nbsp;</td>
	              </tr>
	              <tr>
	              <td height="10"></td>
	              <td></td>
	              <td></td>
	             </tr>
	              <tr>
	              <td height="22" align="right" valign="top">Nume:</td>
	              <td valign="top"></td>
	              <td valign="top"><input type="text" name="nume" value="'.$rand['nume'].'"></td>
	              <td></td>
	              </tr>
	              <tr>
	              <td height="9"></td>
	              <td valign="top"></td>
	              <td></td>
	              <td></td>
	              </tr>
	              <tr>
	              <td height="22" align="right" valign="top">Prenume:</td>
	              <td valign="top"></td>
	              <td valign="top"><input type="text" name="prenume" value="'.$rand['prenume'].'"></td>
	              <td></td>
	              </tr>
	              <tr>
	              <td height="9"></td>
                  <td valign="top"></td>
                  <td></td>
                  <td></td>
                  </tr>
                  <tr>
                  <td height="24"></td>
                  <td valign="top"></td>
                  <td valign="top"><input name="Trimite" type="submit" id="Trimite" value="Modifica date">
                  <input name="Reseteaza" type="reset" id="Reseteaza" value="Reseteaza"> </td>
                  <td></td>
                  </tr>
                  <tr>
                  <td height="19"></td>
                  <td valign="top"></td>
                  <td>&nbsp;</td>
                  <td></td>
                  </tr>
                 </form>
                  </table>';
      }

      break;

    case 'parola':
      echo '<table width="309" border="0" cellpadding="0" cellspacing="0">
            <form name="formular" action="profil.php?actiune=validare" method="post">
            <tr>
            <td height="36" colspan="4" valign="top"><h1>Modifica parola</h1></td>
            </tr>
            <tr>
            <td width="80" height="19" valign="top">&nbsp;</td>
            <td width="15" rowspan="5" valign="top"></td>
            <td width="144" valign="top">&nbsp;</td>
            <td width="70" valign="top">&nbsp;</td>
            </tr>
            <tr>
            <td height="22" align="right" valign="top">Parola:</td>
            <td colspan="2" valign="top">
            <input type="password" name="parola1" value="">    </td>
            </tr>
            <tr>
            <td height="7"></td>
            <td></td>
            <td></td>
            </tr>
            <tr>
            <td height="22" align="right" valign="top">Reintroduceti parola:</td>
            <td colspan="2" valign="middle"><input type="password" name="parola2" value=""></td>
            </tr>
            <tr>
            <td height="7"></td>
            <td></td>
            <td></td>
            </tr>
            <tr>
            <td height="24">&nbsp;</td>
            <td valign="top"></td>
            <td colspan="2" valign="top"><input name="Trimite" type="submit" id="Trimite" value="Modifica parola">
            <input name="Reseteaza" type="reset" id="Reseteaza" value="Reseteaza"> </td>
            </tr>
            <tr>
            <td height="24">&nbsp;</td>
            <td valign="top"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            </form>
            </table>';

      break;

    case 'validare':

      if(!isset($_POST['parola1']))
      {
        $_SESSION['parola1'] = '';
      }
      else{
        $_SESSION['parola1'] = $_POST['parola1'];
      }

      if(!isset($_POST['parola2']))
      {
        $_SESSION['parola2'] = '';
      }
      else
      {
        $_SESSION['parola2'] = $_POST['parola2'];
      }

      if(!isset($_POST['nume']))
      {
        $_SESSION['nume'] = '';
      }
      else
      {
        $_SESSION['nume'] = $_POST['nume'];
      }

      if(!isset($_POST['prenume']))
      {
        $_SESSION['prenume'] = '';
      }
      else
      {
        $_SESSION['prenume'] = $_POST['prenume'];
      }


      if(($_POST['Trimite'] == 'Modifica date') && ($_SESSION['nume'] == '' || $_SESSION['prenume'] == ''))
      {
        echo 'Completeaza campurile.<br>
				Apasa <a href="profil.php?actiune=date_personale">aici</a> pentru a te intoarce.';
      }
      elseif(($_POST['Trimite'] == 'Modifica date') && ($_SESSION['nume'] != '' || $_SESSION['prenume'] != ''))
      {
        echo 'Datele au fost modificate. <br>
			Apasa <a href="pagina.php">aici</a> pentru a te intoarce la pagina principala.';
        $cerereSQL = "UPDATE utilizatori SET nume='".$_SESSION['nume']."', prenume='".$_SESSION['prenume']."' WHERE utilizator='".$_SESSION['user']."'";
        $q=$conn->prepare($cerereSQL);
        $q->execute();

        $_SESSION['nume'] = '';
        $_SESSION['prenume'] = '';

      }
      elseif(($_POST['Trimite'] == 'Modifica parola') && ($_SESSION['parola1'] == '' || $_SESSION['parola1'] != $_SESSION['parola2']))
      {
        echo 'Completeaza campurile.<br>
			Apasa <a href="profil.php?actiune=parola">aici</a> pentru a te intoarce.';
      }
      elseif(($_POST['Trimite'] == 'Modifica parola') && ($_SESSION['parola1'] != '' || $_SESSION['parola1'] == $_SESSION['parola2']))
      {
        echo 'Parola a fost modificata. <br>
			Apasa <a href="pagina.php">aici</a> pentru a te intoarce la pagina principala.';
        $cerereSQL = "UPDATE utilizatori SET parola='".md5($_SESSION['parola1'])."' WHERE utilizator='".$_SESSION['user']."'";
        $q=$conn->prepare($cerereSQL);
        $q->execute();

        $_SESSION['parola1'] = '';
        $_SESSION['parola2'] = '';
      }

      break;
  }
}

?>



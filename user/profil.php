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
    if($_SESSION['logat'] != 'Da')
    {
        ?>
        <div class="box">
            <?php
            echo 'Pentru a accesa aceasta pagina, trebuie sa va autentificati. <br>
	            Pentru a va autentifica, apasati <a href="autentificare.php">aici</a><br>
		        Pentru a va inregistra, apasati <a href="inregistrare.php">aici</a>';
            ?>
        </div>
        <?php
    }
    else
    {
    switch($_GET['actiune'])
    {
        case '':
            ?>
            <div class="box">
                <?php
                echo '<h1>Profilul dumneavoastra</h1>
				    Apasati <a href="profil.php?actiune=date_personale">aici</a> pentru a schimba datele personale.<br>
				    Apasati <a href="profil.php?actiune=parola">aici</a> pentru a schimba parola dumneavoastra.<br><br> ';
                ?>
            </div>
            <?php
            break;
        case 'date_personale':
            $cerereSQL = 'SELECT * FROM `utilizatori` WHERE utilizator="'.$_SESSION['user'].'"';
            $rezultat = $conn->query($cerereSQL);
            $rezultat->setFetchMode(PDO::FETCH_ASSOC);
            while($rand =$rezultat->fetch())
            {
                ?>
                <div class="box">
                    <div class="col-lg-4">
                        <form role="form" method="post" action ="profil.php?actiune=validare">
                            <h2> Modifica date personale </h2>
                            <div class="form-group">
                                <label>Nume</label>
                                <input type="text" name="nume"  class="form-control" value="<?php echo $rand['nume']; ?>">
                            </div>
                            <div class="form-group">
                                <label> Prenume </label> <br>
                                <input type="text" name="prenume" class="form-control" value="<?php echo $rand['prenume']; ?>">
                            </div>
                            <input name="Trimite" type="submit" id="Trimite" value="Modifica date">
                            <input name="Reseteaza" type="reset" id="Reseteaza" value="Reseteaza">
                        </form>
                    </div>
                </div>
                <?php
            }
            break;


        case 'parola':
            ?>
            <div class="box">
                <div class="col-lg-4">
                    <form role="form" method="post" action ="profil.php?actiune=validare">
                        <h2> Modifica parola </h2>
                        <div class="form-group">
                            <label>Parola</label>
                            <input type="password" name="parola1"  class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label> Reintroduceti parola </label> <br>
                            <input type="password" name="parola2" class="form-control" value="">
                        </div>
                        <input type="submit" id="Trimite" value="Modifica parola">
                        <input name="Reseteaza" type="reset" id="Reseteaza" value="Reseteaza">
                    </form>
                </div>
            </div>
            <?php
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
                ?>
                <div class="box">
                    <?php
                    echo 'Completeaza campurile.<br>
				        Apasa <a href="profil.php?actiune=date_personale">aici</a> pentru a te intoarce.';
                    ?>
                </div>
                <?php
            }
            elseif(($_POST['Trimite'] == 'Modifica date') && ($_SESSION['nume'] != '' || $_SESSION['prenume'] != ''))
            {
                ?>
                <div class="box">
                    <?php
                    echo 'Datele au fost modificate. <br>
			            Apasa <a href="pagina.php">aici</a> pentru a te intoarce la pagina principala.';
                    ?>
                </div>
                <?php
                $cerereSQL = "UPDATE utilizatori SET nume='".$_SESSION['nume']."', prenume='".$_SESSION['prenume']."' WHERE utilizator='".$_SESSION['user']."'";
                $q=$conn->query($cerereSQL);
                $q->setFetchMode(PDO::FETCH_ASSOC);
                $_SESSION['nume'] = '';
                $_SESSION['prenume'] = '';
            }
            elseif(($_POST['Trimite'] == 'Modifica parola') && ($_SESSION['parola1'] == '' || $_SESSION['parola1'] != $_SESSION['parola2']))
            {
                ?>
                <div class="box">
                    <?php
                    echo 'Completeaza campurile.<br>
			            Apasa <a href="profil.php?actiune=parola">aici</a> pentru a te intoarce.';
                    ?>
                </div>
                <?php
            }
            elseif(($_POST['Trimite'] == 'Modifica parola') && ($_SESSION['parola1'] != '' || $_SESSION['parola1'] == $_SESSION['parola2']))
            {
                ?>
                <div class="box">
                    <?php
                    echo 'Parola a fost modificata. <br>
			            Apasa <a href="pagina.php">aici</a> pentru a te intoarce la pagina principala.';
                    ?>
                </div>
                <?php
                $cerereSQL = "UPDATE utilizatori SET parola='".md5($_SESSION['parola1'])."' WHERE utilizator='".$_SESSION['user']."'";
                $q=$conn->prepare($cerereSQL);
                $q->execute();
                $_SESSION['parola1'] = '';
                $_SESSION['parola2'] = '';
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

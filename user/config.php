<?php
// Informatii baza de date
$AdresaBazaDate = "192.168.1.215";
$UtilizatorBazaDate = "root";
$ParolaBazaDate = "qwerty";
$NumeBazaDate = "SistemNoutati";
$conexiune = mysql_connect($AdresaBazaDate,$UtilizatorBazaDate,$ParolaBazaDate)
or die("Nu ma pot conecta la MySQL!");
mysql_select_db($NumeBazaDate,$conexiune)
or die("Nu gasesc baza de date!");

session_start();
?>
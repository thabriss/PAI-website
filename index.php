<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Strona główna</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/lightbox.css">
  <link rel="stylesheet" href="css/styl.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div id="header">
Alarmex
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Strona główna</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Kategorie<span class="caret"></span></a>
          <ul class="dropdown-menu">
           <?php $polaczenie = @mysqli_connect('localhost', 'root', '', 'pai_kierznikiewicz');
			if (!$polaczenie) {
			  die('Wystąpił błąd połączenia: ' . mysqli_connect_errno());
			}
			@mysqli_query($polaczenie, 'SET NAMES utf8');
			 
			$sql = 'SELECT `id`, `nazwa` 
						 FROM `kategorie` 
						 ORDER BY `nazwa`';
			$wynik = mysqli_query($polaczenie, $sql);
			if (mysqli_num_rows($wynik) > 0) {
			  while (($kategoria = @mysqli_fetch_array($wynik))) {
				echo '<li><a href="' . $_SERVER["PHP_SELF"] . '?kat_id=' . $kategoria['id'] . '">' . $kategoria['nazwa'] . '</a></li>' . PHP_EOL;
			  }
			} else {
			  echo 'wyników 0';
			}?>
			</ul>
        </li>
        <li><a href="kontakt.php">Kontakt</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  <?php
  $kat_id = isset($_GET['kat_id']) ? (int)$_GET['kat_id'] : 0;
	$sql = 'SELECT * 
             FROM `produkty` 
             WHERE `kategoria_id` = ' . $kat_id .
             ' ORDER BY `nazwa`';
$wynik = mysqli_query($polaczenie, $sql);
if (mysqli_num_rows($wynik) > 0) {
  while (($produkt = @mysqli_fetch_array($wynik))) {
      echo '<div class="przedmiot">
	<div class="obrazek">
	<a href="'.$produkt['img'].'" data-lightbox="set1" data-title="'.$produkt['nazwa'].'">
		<img src="'.$produkt['img_s'].'" alt="'.$produkt['nazwa'].'">
	</a>
	</div>
	<div class="opis">
	<h4>'.$produkt['nazwa'].'</h4>
	<p>'.$produkt['opis'].'</p>
    </div>
  </div>' . PHP_EOL;
  }
} else {
  echo '<p>Sklep oferujący sprzęt stosowany w systemach alarmowych.</p>';
}
 
mysqli_close($polaczenie); 
?>
</div>
<div id="footer">
Jacek Kierznikiewicz 2018<br />
PAI Projekt
</div>
<script src="js/lightbox.js"></script>
</body>
</html>

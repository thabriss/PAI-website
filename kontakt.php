<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Kontakt</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styl.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div id="header">
Tytuł strony
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
            <?php
			$menu = array('kategoria_1.php'=>'Kategoria 1', 'kategoria_2.php'=>'Kategoria 2', 'kategoria_3.php'=>'Kategoria 3');
			foreach ($menu as $key => $value):
			?>
			<li><a href="<?php echo $key?>"><?php echo $value?></a></li>
			<?php endforeach ?>
          </ul>
        </li>
        <li><a href="kontakt.php">Kontakt</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <h3>Kontakt</h3>
  <p>In this example, the navigation bar is hidden on small screens and replaced by a button in the top right corner (try to re-size this window).
  <p>Only when the button is clicked, the navigation bar will be displayed.</p>
</div>
<div id="footer">
Stopka
</div>
</body>
</html>

<?php session_start(); ?>

<html>
	<head>
	<title>Panel administracyjny</title>
	<link href="css/styl.css" rel="stylesheet" />
	<link href="css/admin.css" rel="stylesheet" />
	<meta charset="utf-8">
	</head>
	
	<body>
		<div id="container">
			<div id="header">
			Panel Administracyjny
			</div>
			
			<div id="tresc">
		
		<?php
			$nazwabazy = 'pai_kierznikiewicz';
			$polaczzbaza = mysql_connect('localhost', 'root', '');
			
			mysql_select_db($nazwabazy);
			
			if(isset($_POST['login']) && $_POST['haslo'])
			{
				$login = $_POST['login'];
				$haslo = sha1($_POST['haslo']);
				$res=mysql_query("SELECT id, haslo FROM uzytkownicy WHERE login='$login'");
				$row=mysql_fetch_array($res);
		  	    $count = mysql_num_rows($res);
			   
			    if( $count == 1 && $row['haslo']==$haslo ) {
					$_SESSION['user'] = $row['id'];
				} else {
					echo "Nieprawidlowe dane logowania";
			    }
			}
			
			if(isset($_GET['admin']) && $_GET['admin']=='wyloguj')
			{
			$_SESSION['user']= 0;
			}
			
			if($_SESSION['user']!=0)
			
			{
			?>
			
			<!-- Dodawanie rekordów -->
			
			<div class="left">
				Dodaj produkt: <br />
				<form action="admin.php" method="post">
				Nazwa produktu: <br />
				<input type="text" name="nazwa"><br />
				Kategoria: <br />
				<select name="kategoria">
					<?php 
						$kat_query = mysql_query("SELECT nazwa FROM kategorie");
 
						while($kat = mysql_fetch_array($kat_query))
						{
						echo'
						<option>'.$kat['nazwa'].'</option>';
						}
					?>
				</select> <br />
				Nazwa pliku ze zdjęciem: <br />
				<input type="text" name="obrazek"><br />
				Nazwa pliku z miniaturką: <br />
				<input type="text" name="miniaturka"><br />
				Opis: <br />
				<textarea type="text" name="opis"></textarea><br />
				<input type="submit" value="Dodaj"><br />
				</form>
			</div>
			
			<?php
			if (isset($_POST['nazwa']) && $_POST['kategoria'] && $_POST['obrazek'] && $_POST['miniaturka'] && $_POST['opis'])
			{
			$nazwa = $_POST['nazwa'];
			$kategoria = $_POST['kategoria'];
			$obrazek = 'img/' . $_POST['obrazek'];
			$miniaturka = 'img/' . $_POST['miniaturka'];
			$opis = $_POST['opis'];
			
			$kategoria_id_zap = "SELECT id FROM kategorie WHERE nazwa='$kategoria'";
			$kategoria_id_wyn = mysql_query($kategoria_id_zap);
			$row = mysql_fetch_array($kategoria_id_wyn);
			$kategoria_id = $row['id'];
			
			$dodaj = "INSERT INTO produkty VALUES ('', '$kategoria_id', '$nazwa', '$opis', '$obrazek', '$miniaturka')";
			mysql_query($dodaj);
			}
			?>
			
			<!--Wyświetlanie rekordów-->
			<?php
			$select="SELECT * FROM produkty";
			$wynik = mysql_query($select);
			
			$liczbawierszy = mysql_num_rows($wynik);
			
			echo '<div class="right">';
			$i = 0; //iterator
			while ($i < $liczbawierszy)
			{
				$id_w=mysql_result($wynik, $i, 'id');
				$nazwa_w=mysql_result($wynik, $i, 'nazwa');
				
				echo "$id_w  $nazwa_w <br /><br />";
				
				$i++;
			}
			echo '</div>';
			?>
			<br /><br />
			
			<!--Usuwanie rekordów-->
			<div class="right">
				Usuń rekord o id
				<form action="admin.php" method="post">
				<input type="text" name="indeks">
				<input type="submit" value="OK">
				</form>
			</div>
			
			<?php
			if (isset($_POST['indeks']))
			{
			$id_u = $_POST['indeks'];
			$usun = "DELETE FROM produkty WHERE id = '$id_u'";
			mysql_query($usun);
			echo "Usunieto produkt!";
			}
			?>

			<!-- Koniec-->
			<?php
			}
			
			else
			{
			echo '<form method="POST" action="admin.php" id="logowanie">
			Login: <br /> <input type="text" name="login"><br /><br />
			Hasło: <br /> <input type="password" name="haslo"><br /><br />
			<input type="submit" value="Zaloguj">
			</form>';
			}
			
			
			if($_SESSION['user']!=0)
			{
			echo '<div id="wyloguj"><a href="admin.php?admin=wyloguj">Wyloguj</a></div>';
			}


		?>
			</div>
			<div id="footer">
			Jacek Kierznikiewicz 2018 <br />
			PAI Projekt
			</div>
		</div>
	</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<style>
.naglowek {
  background-color:#fad;
  color:#aaa;
  padding:20px 25px;
  font-family: Montserrat, sans-serif;
  text-align: center;
}
</style>
<div class="naglowek">
  <h1>Nagłówek</h1>
</div>


<?php
//Dynamiczne menu (dane z bazy)
  $polaczenie = @mysqli_connect('localhost', 'root', '', 'pai_fejfer_niedbalo');
  if (!$polaczenie) {
    die('Wystąpił błąd połączenia: ' . mysqli_connect_errno());
  }
  @mysqli_query($polaczenie, 'SET NAMES utf8');
  ?>
  
  
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Strona główna</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategorie <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
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
				}
				?>
          </ul>
        </li>
        <li><a href="/fejfer_niedbalo/login.php">Login</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <h3>Collapsible Navbar</h3>
  <p>In this example, the navigation bar is hidden on small screens and replaced by a button in the top right corner (try to re-size this window).
  <p>Only when the button is clicked, the navigation bar will be displayed.</p>
</div>
<div>



<?php
  $kat_id = isset($_GET['kat_id']) ? (int)$_GET['kat_id'] : 1;
  $sql = 'SELECT `nazwa`, `opis`
               FROM `produkty`
               WHERE `kategoria_id` = ' . $kat_id .
               ' ORDER BY `nazwa`';
  $wynik = mysqli_query($polaczenie, $sql);
  if (mysqli_num_rows($wynik) > 0) {
    while (($produkt = @mysqli_fetch_array($wynik))) {
        echo '<p><b>' . $produkt['nazwa'] . '</b>: ' . $produkt['opis'] . '</p>' . PHP_EOL;
    }
  } else {
    echo 'wyników 0';
  }
mysqli_close($polaczenie);
?>

</div>

<div class="stopka">
  <h1>Stopka</h1>
</div>
</body>
</html>

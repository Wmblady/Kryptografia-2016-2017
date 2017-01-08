<?php
  $NICK = (isset($_COOKIE['NICK'])?$_COOKIE['NICK']:"gość");
  require_once("Szablon.php");
  require_once("votes.php");
  $P = new Page(1,"Podstawowe algorytmy");
  $P->AddCSS("main.css");
  echo $P->Poczatek();
?>

<?php echo $P->Begin(); ?> 

<?php echo $P->PrzedArticle(); ?> 

		<div class="panel">
		<div id="send-message-area">
		<h2>Formularz przelewu:</h2>
		<section>
			<div class="col-6-6">
			Nr Rachunku: <br><input type="text" id="NrRachunku" value="" size = 40><br>
			Nazwa odbiorcy: <br><input type="text" id="NazwaOdbiorcy" value="" size = 40> <br>
			Adres odbiorcy: <br><input type="text" id="AdresOdbiorcy" value="" size = 40> <br>
			Tytułem: <br><input type="text" id="Tytuł" value="" size = 40> <br>
			Kwota: <br><input type="text" id="Kwota" value="" size = 15> <br>
			<button class="button" id="presendB">Wykonaj Przelew</button><br>
		</section>
		</div>
		<div id="niezalogowany">
			<h2>Jesteś niezalogowany!</h2>
		</div>
		<div id="presend">
			Nr Rachunku: <br> <div id="SNrRachunku"></div>
			Nazwa odbiorcy: <br> <div id="SNazwaOdbiorcy"></div>
			Adres odbiorcy: <br> <div id="SAdresOdbiorcy"></div>
			Tytułem: <br> <div id="STytul"></div>
			Kwota: <br> <div id="SKwota"></div>
			<button class="button" id="send">Potwierdź</button><br>
			<button class="button" id="notsend">Anuluj</button><br>
		</div>
		
		<div id="aftersend">
		</div>

<?php echo $P->End(); ?> 
<?php
  $NICK = (isset($_COOKIE['NICK'])?$_COOKIE['NICK']:"gość");
  require_once("Szablon.php");
  require_once("votes.php");
  $P = new Page(2,"Podstawowe algorytmy");
  $P->AddCSS("main.css");
  echo $P->Poczatek();
?>




<style>
#msg{
	width:100%; 
	box-sizing: border-box;
    border: 1px solid #008CBA;
    border-radius: 4px;
	padding: .5em 1em;
}


#Blog1 {
	border-top: 1px outset #008CBA;
	border-bottom: 1px outset #008CBA;
	margin-bottom: 0.5em;
	color: #eeeeee;
	background-color: #555555;
	padding: 1em;
	font-family: "Times New Roman", Georgia, Serif;
	font-size: 0.9em;
}

#BlogInfo {
	border-left:0 solid #ccc;
	margin:0;
	padding:.5em 10px;
	font-size: 1.5em;
	text-indent:1.5em;
	color: #0078B5;
}

#zalogowanie {
	font-size: 0.75em;
}


</style>

<?php echo $P->Begin(); ?> 


<?php echo $P->PrzedArticle(); ?> 

<div id="niezalogowany">
	<h2>Jesteś niezalogowany!</h2>
	<form method="post" action="CheckUser.php">
	

	Nick:  &#160;<input type="text"     name="NICK" size="10"  maxlength="6"><br/>
	Hasło: <input  type="password" name="pass" size="10" maxlength="20"><br/><br/>
	<input type="hidden" name="token" value="<?php echo $token; ?>" />	
	
	<input type="submit"  class="button" id="zaloguj" value="Zaloguj się">
	</form>
</div>
<div id="send-message-area">
	<div id="chat">
	</div>
</div>
 <div id ="presend"></div>
 <div id ="aftersend"></div>
  


<?php echo $P->End(); ?> 

 <?php
 $token = md5(uniqid());
 $_SESSION['login_token'] = $token;
 session_write_close();
//MODEL
$STRONY = [
  ['id'=>1, 'name'=>"Przelew",     'href'=>"skoczek.php",      "class"=>"skoczek"],
  ['id'=>2, 'name'=>"Historia Przelewów",     'href'=>"Blog.php",      "class"=>"blog"]
];
//VIEW

$POCZATEK =<<<EOT
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <title>{{TITLE}}</title>
  <meta name="description" content= "Algorytmy PWr">
  <meta name="keywords" content= "WPPT, PWr, programy, algorytmy, PHP">  
  <meta name="viewport"  content= "width=device-width, initial-scale=1.0"/>
<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
<link rel="apple-touch-icon" sizes="57x57" href="favicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="favicons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
<link rel="manifest" href="favicons/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicons/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    extensions: ["tex2jax.js"],
    jax: ["input/TeX", "output/HTML-CSS"],
    tex2jax: {
    inlineMath:  [['$','$']],
    displayMath: [['$$','$$']],
    processEscapes: true
    },
    "HTML-CSS": { availableFonts: ["TeX"]}
  });
</script>
<script src="js/myblog.js"></script>
<script type="text/javascript" 
src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
 <script src="logo.js"></script> 
  
  <script>
		function toggleMenu(){
			var el = document.getElementById("leftMenu");
			if (el.style.display != 'block'){
				el.style.display = 'block';
			} else {
				el.style.display = 'none';
			}
		}
		
		window.onresize = function() {
			alignMyDivs();
			var w = window.innerWidth;
			if(w > 640) {
			document.getElementById('leftMenu').style.display = 'inline';
			}
		}
  </script>
  
  <script>
		
		
		function alignMyDivs(){
			var els = [document.getElementById("code_example1"), 
			document.getElementById("code_example2")];
  
  //Niech przegladarka sama przeliczy potrzebne wysokości
			for (var i=0;i<els.length;i++){
				els[i].style.height = "auto";
			}
  //Wyznaczamy maksimum z wysokości
			var h = 0;
			for (i=0; i<els.length; i++){
				h = Math.max(h,els[i].clientHeight);
			}
  //Ustawiamy sami wysokości
			for (var i=0;i<els.length;i++){
				els[i].style.height = h + "px";
			}
		}
		
  </script>
  
  
EOT;

$HEADER_1 =<<<EOT
EOT;

$BEGIN =<<<EOT
</head>
<body>

<div class="supercontainer">
	<header>
			 <div id=headerdiv>
				<canvas id="logo" width="500" height="500">Logo</canvas>
				<h1 id="podstawowe_algorytmy">iDKO</h1>
			 </div>
			 <div id="firsttext">
			 <h2>Strona banku tak bezpiecznego, że okradną Cię nawet z kapci!</h2>
			 </div>
			 <div id="showMenu" class="col-6-6"> &#9776; Menu</div>
	</header>
<div class="row">
			<div class="col-2-6">
				<nav id="leftMenu">
					<ul>
						{{ITEMS}}
					</ul>
				</nav>
	<div id="logowanie" class="right">			
	<form method="post" action="CheckUser.php">
	

	Nick:  &#160;<input type="text"     name="NICK" size="10"  maxlength="6"><br/>
	Hasło: <input  type="password" name="pass" size="10" maxlength="20"><br/><br/>
	<input type="hidden" name="token" value="<?php echo kds;?>" />	
	
	<input type="submit"  class="button" id="zaloguj" value="Zaloguj się">
	</form>
	</div>
	<div id="zalogowany" class ="right">
	Zalogowany jako: <span id="NICK" class="thisIsI"></span>
	<form method="post" action="CheckUser.php"><br/>
	<input type="submit"  class="button" id="wyloguj" value="Wyloguj">
	</form>

	</div>

EOT;

$LAJKI = <<<EOT

  <script>
  $(function lajki() {
  var theId = {{GLOSOWANIE}};

  $("#vote_up").click(function(){  
     $(this).parent().html("~");    
     //wywołanie ajax'a  
     $.ajax({  
       type: "POST",  
       data: "action=vote_up&id="+theId,  
       url : "votes.php",  
       success: function(msg)  
      {  
        $("#votes_count").html(msg);    
        $("#vote_buttons").remove();  
      }
    });  
  });  
  
 $("#vote_down").click(function(){  
     $(this).parent().html("~");    
     //wywołanie ajax'a  
     $.ajax({  
       type: "POST",  
       data: "action=vote_down&id="+theId,  
       url : "votes.php",  
       success: function(msg)  
      {  
        $("#votes_count").html(msg);    
        $("#vote_buttons").remove();  
      }
    });  
  }); 
  }  );
</script>

EOT;

$POCYTACIE =<<<EOT
			</div>
			<div class="col-4-6">
			<div id ="content">
				<article>
EOT;

$FOOTER =<<<EOT
  				</article>
			</div>
			</div>
		</div>

		Ilość odwiedzin: {{COUNTER}}
		<div class="col-6-6">
			<footer>
				<div>Copyright &copy; Szef Wszystkich Szefow 2016</div>
			</footer>
		</div>
	</div>
	<script>
var nick = getCookie("NICK");
var el1 = document.getElementById("send-message-area");
var el2 = document.getElementById("logowanie");
var el3 = document.getElementById("zalogowany");
var el4 = document.getElementById("niezalogowany");
var el5 = document.getElementById("presend");
var el6 = document.getElementById("aftersend");
el5.style.display = 'none';
el6.style.display = 'none';
if (nick == null){
	if (el1 != null) {
		el1.style.display = 'none';
	}
	el2.style.display = 'block';
	el3.style.display = 'none';
	el4.style.display = 'block';

} else {
	if (el1 != null) {
		el1.style.display = 'block';
	}
	el2.style.display = 'none';
	el3.style.display = 'block';
	el4.style.display = 'none';
}
var timer; //to sie może przydać do wyłącznenia chata

$.ajaxSetup({ cache: false });
	
$(document).ready(function() {
	var magic;
	$("#NICK").html(nick);
	$("#wyloguj").click(function() {	
		document.cookie = "NICK" + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	});
	
	$("#presendB").click(function() {
		var txt2 = $("#NrRachunku").val()+"";
		var txt3 = $("#NazwaOdbiorcy").val()+"";
		var txt4 = $("#AdresOdbiorcy").val()+"";
		var txt5 = $("#Tytuł").val()+"";
		var txt6 = $("#Kwota").val()+"";
		txt2 = txt2.trim();
		txt3 = txt3.trim();
		txt4 = txt4.trim();
		txt5 = txt5.trim();
		txt6 = txt6.trim();
		if(txt2 !== "" && txt3 !== "" && txt4 !== "" && txt5 !== "" && txt6 !== "") {
			var el1 = document.getElementById("send-message-area");
			el1.style.display = 'none';
			var el2 = document.getElementById("presend");
			el2.style.display = 'block';
			
			var el2a = document.getElementById("SNrRachunku");
			var el2b = document.getElementById("SNazwaOdbiorcy");
			var el2c = document.getElementById("SAdresOdbiorcy");
			var el2d = document.getElementById("STytul");
			var el2e = document.getElementById("SKwota");
			el2a.innerHTML = txt2;	el2b.innerHTML = txt3;
			el2c.innerHTML= txt4;	el2d.innerHTML = txt5;
			el2e.innerHTML = txt6;
			
		} else {
			
		}
		setTimeout(function(){ updateChat(nick); }, 500);
		$("#txt2").val("");
	});
	
	$("#send").click(function() {
		
		function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

		var el1 = document.getElementById("presend");	
		var el2 = document.getElementById("aftersend");
		el1.style.display = 'none';
		el2.style.display = 'block';
		
		var txt2 = $("#NrRachunku").val()+"";
		var txt3 = $("#NazwaOdbiorcy").val()+"";
		var txt4 = $("#AdresOdbiorcy").val()+"";
		var txt5 = $("#Tytuł").val()+"";
		var txt6 = $("#Kwota").val()+"";
		txt2 = txt2.trim();
		txt2 = escapeHtml(txt2);
		txt3 = txt3.trim();
		txt3 = escapeHtml(txt3);
		txt4 = txt4.trim();
		txt4 = escapeHtml(txt4);
		txt5 = txt5.trim();
		txt5 = escapeHtml(txt5);
		txt6 = txt6.trim();
		txt6 = escapeHtml(txt6);
		if(txt2 !== "" && txt3 !== "" && txt4 !== "" && txt5 !== "" && txt6 !== "") {
			sendChat(nick, txt2, txt3, txt4, txt5, txt6);
		}
		setTimeout(function(){ updateChat(nick); }, 500);
		getServer(nick);
		$("body").children().each(function () {
		$(this).html( $(this).html().replace(/Na rachunek: .../g, "Na rachunek: " + magic) );
				});
	});

	updateChat(nick);
	timer = setInterval(function(){ updateChat(nick); }, 5000);

});
</script>
</body>
</html>

EOT;

class Counter{
	private $counter  = 1;
	
	function __construct(){
		$filePath = "counter.txt";
		if (file_exists($filePath)){
			$handle = fopen($filePath, "r"); 
			$counter = (int) fread($handle,20); 
			fclose ($handle); 
			$counter++; 
			$handle = fopen($filePath, "w" ); 
			fwrite($handle,$counter) ; 
			fclose($handle);
			$this->counter = $counter;			
		} else {
			$handle = fopen($filePath, "w");
			fwrite($handle,$this->counter) ; 
			fclose($handle);
		}
	}
	
	function Get(){
		return $this->counter;
	}
}
	
//CONTROLLER
  class Page{
  public $counter;
  private $id   = -1;
  private $Title= "";
  private /*. string[int] .*/$css      = [];
  private /*. string[int] .*/$jsfiles  = [];
	
  public function AddCSS(/*. string .*/ $s) {
    $this->css[] = (string) str_replace("{{C}}", $s, 
	"<link href='css/{{C}}' rel='stylesheet'>");
  }
  
  public function AddJS(/*. string .*/ $s) {
    $this->css[] = (string) str_replace("{{J}}", $s, "<script src='js/{{J}}'></script>");
  }
  
/**
 *  Konstruktor .
 *  @param  int    $id Numer modułu.
 *  @param  string $T  Title
 */
  function __construct($id, $T){
    $this->id    = $id;
    $this->Title = $T;
	$this->counter = new Counter();
	/*$this->AddCSS("main.css");*/
  }
/**
*  Funkcja służąca do budowy menu.
*  @return string  Menu zbudowane z.$STRONY
*/
  private function Menu(){
    global $STRONY;
    $ITEM   = "<li><a href='{{HREF}}' class= '{{CLASS}}'>{{NAME}}</a></li>";
    $ACTIVE = "<li><a href='javascript:void(0);' class= 'active'>{{NAME}}</a></li>";
    $S = "";
    for ($i=0; $i<count($STRONY); $i++){
      if ( (int) $STRONY[$i]["id"] == $this->id){
        $T= $ACTIVE;
      } else {
        $T= (string) str_replace("{{HREF}}", (string) $STRONY[$i]["href"], $ITEM);
      };
      $T = (string) str_replace("{{CLASS}}", (string) $STRONY[$i]["class"], $T);
      $T = (string) str_replace("{{NAME}}" , (string) $STRONY[$i]["name"],  $T);
      $S.= $T . "\n";
    }
    return $S;
  }
/**
*  Początek strony
*  @return string  Kod nagłówka i początku strony.
*/
	
  public function Poczatek() {
	 global $POCZATEK;
	 global $HEADER_1;
	 $S = (string) str_replace("{{TITLE}}", $this->Title,  $POCZATEK);
	 
	// dodajemy style    
    $X = "";
    for ($i=0;$i<count($this->css);$i++) {
      $X.= "  " .$this->css[$i] . "\n";
    }
    if ($X !== "") {
      $S.= "\n" . $X . "\n";
    }

    // Dodajemy javascript'y
    $X = "";
    for ($i=0;$i<count($this->jsfiles);$i++) {
      $X.= $this->jsfiles[$i] . "\n";
    }
    if ($X !== "") {
      $S.= "\n" . $X;
    }
    //Wstawiamy menu
    $S.= (string) str_replace("{{ITEMS}}", $this->Menu(), $HEADER_1);
	
    // usuwamy puste linie
    return preg_replace('/^\h*\v+/m', '', $S);
	
	 return $S;
  }
  
  public function Begin(){
    global $BEGIN;
    $S = (string) str_replace("{{ITEMS}}", $this->Menu(), $BEGIN);
    return $S;
  }
  
  public function Lajki() {
	global $LAJKI;  
	$S = (string) str_replace("{{GLOSOWANIE}}", $this->id, $LAJKI);
	return $S;
  }
  
  public function PrzedArticle() {
	  global $POCYTACIE;
	  return $POCYTACIE;
  }
  
  public function End(){
    global $FOOTER;
	$S = (string) str_replace("{{COUNTER}}", $this->counter->Get(), $FOOTER);
    return $S;
  }
  
  
}  
?> 
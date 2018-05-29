<html>
<head>
	<title>Pac-Man</title>
	<meta charset="utf-8">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body style="background-color:#F7F7F7; font-family: Helvetica;">
	<h1 style="display: table; margin: 0 auto;">PACMAN</h1>
	<br>

	<!--Hier fügt JS den Button zum Laden des nächsten Levels ein-->
	<div id="loadNext">

	</div>

	<!--Hier fügt JS den Canvas mit dem Spiel ein -->
	<div id="game" >
		
	</div>
	<br>

	<!--Hier fügt JS das Textfeld zur Namenseingabe ein-->
	<div id="welcome" style="display: table; margin: 0 auto;">
		
	</div>
	<div>
		<?php 
		$phpSpieler = 'NoNameChosen';
		$lifes = 3;
		$lvl = 0;
		$pkt = 0;
		$saved = false;
		$highscore = array();
		$currentPlayer = array();
		
		//Laden der Arrays für Highscoreliste und Savegames
		$loadScore = fopen("files\highscore.txt", "r");
		$loadPlayer = fopen("files/savegames.txt", "r");

		if(filesize("files\highscore.txt")>0){
			$highscore = unserialize(fread($loadScore, filesize("files\highscore.txt")));
		}

		if(filesize("files/savegames.txt")>0){
			$currentPlayer = unserialize(fread($loadPlayer, filesize("files/savegames.txt")));
		}
		
		//Übernahme des eingegebenen Namens des Spielers
		if(!empty($_GET['playername'])){
			$phpSpieler = $_GET['playername'];
		}

		if(!empty($_GET['neu'])){


			//Lade vorherigen Spielstand, falls vorhanden
			if($_GET['neu'] == 'yes'){
				for($i=0; $i<sizeof($currentPlayer); $i++){
					if($currentPlayer[$i][0] == $phpSpieler){
						$lvl = $currentPlayer[$i][1];
						$pkt = $currentPlayer[$i][2];
						$lifes = $currentPlayer[$i][3];
						break;
					}
				}	
			}

			//Variablen aus vorherigem Level werden über die URL übergeben und weiter verwendet
			//Spielstand wird im vorgesehenen Array abgespeichert.
			if($_GET['neu'] == 'no'){
				$lvl = $_GET['progress'];
				$pkt = $_GET['points'];
				$lifes = $_GET['leben'];

				//Wenn bereits ein Spielstand mit dem aktuellen Namen existiert.
				for($i=0; $i<sizeof($currentPlayer); $i++){
					if($currentPlayer[$i][0] == $phpSpieler){
						$currentPlayer[$i][1] = $lvl;
						$currentPlayer[$i][2] = $pkt;
						$currentPlayer[$i][3] = $lifes;
						$saved = true;
						break;
					}
				}
				//Wenn noch kein Spielstand mit aktuellem Namen existiert.
				if(!$saved){
					$temp = sizeof($currentPlayer);
					$currentPlayer[$temp][0] = $phpSpieler;
					$currentPlayer[$temp][1] = $lvl;
					$currentPlayer[$temp][2] = $pkt;
					$currentPlayer[$temp][3] = $lifes;
				}
				
			}
			//Speichern des Highscores an richtiger Position in dem Highscorearray.
			if($_GET['neu'] == 'high'){
				if(sizeof($highscore) == 0){
					$highscore[0][0] = $_GET['scorename'];
					$highscore[0][1] = $_GET['points'];
				} else {
				
				for($i=0; $i<sizeof($highscore);$i++){
					if($_GET['points']>=$highscore[$i][1]){
						for($j=sizeof($highscore)-1; $j>=$i;$j--){
							$highscore[$j+1][0] = $highscore[$j][0];
							$highscore[$j+1][1] = $highscore[$j][1];
						}
						$highscore[$i][0] = $_GET['scorename'];
						$highscore[$i][1] = $_GET['points'];
						
						break;
					}
				}
				}

				if($_GET['points']<$highscore[sizeof($highscore)-1][1]){
					$highscore[sizeof($highscore)][0] = $_GET['scorename'];
					$highscore[sizeof($highscore)-1][1] = $_GET['points'];
					
				}
				for($i=0; $i<sizeof($currentPlayer); $i++){
					if($currentPlayer[$i][0] == $_GET['scorename']){
						unset($currentPlayer[$i]);
						$currentPlayer = array_values($currentPlayer);
					}
				}
			}
			//Speichern der Highscore- und Savegamearrays.
			$savePlayer = fopen("files/savegames.txt", "w");
			fwrite($savePlayer, serialize($currentPlayer));
			$saveScore = fopen("files\highscore.txt", "w");
			fwrite($saveScore, serialize(array_slice($highscore,0,10)));
			
		}
		
		
		?>
	</div>
	<script type="text/javascript">
	var player = "<?php echo $phpSpieler ?>";
	var c;	//Canvas
	var dots = 0;
	var punkte = <?php echo $pkt ?>;
	var xpos; //X-Position von Pacman
	var ypos; //Y-Position von Pacman
	var fruit = 0;
	var leben = <?php echo $lifes ?>;
	var pmove = "none";
	var pac = new Image();
	pac.src = "img/Pacman.png";
	var kirsche = new Image();
	kirsche.src = "img/frucht.png";
	var dot = new Image();
	dot.src = "img/Punkt.png"; 
	var wand = new Image();
	wand.src = "img/wand.png"
	var progress = <?php echo $lvl ?>;
	var geistEins;
	var geistZwei;
	var geistDrei;
	<?php
		include 'level/level01.php';
		include 'level/level02.php';
		include 'level/level03.php';

		
	?>
	

	
	//Klasse für die Geister, mit Positionen und Aussehen, sowie der Methode fürs zufällige Bewegen
	function Geist(xStart, yStart, spriteStart){
		this.x = xStart;
		this.y = yStart;
		this.gmove = "none";
		this.sprite = new Image();
		this.sprite.src = spriteStart;

		//Methode, damit die Geister sich zufällig bewegen.
		this.jagd =function(){
			
			c.clearRect(this.x*40, this.y*40, 40,40);
			if(level[this.x][this.y]=="punkt"){
				c.drawImage(dot,this.x*40, this.y*40);
			}
			if(level[this.x][this.y]=="frucht"){
				c.drawImage(kirsche,this.x*40, this.y*40);
			}
			var zufall = Math.floor((Math.random()*4)+1);
			if(zufall == 1){
				gmove = "oben";
			}
			if(zufall == 2){
				gmove = "unten";
			}
			if(zufall == 3){
				gmove = "links";
			}
			if(zufall == 4){
				gmove = "rechts";
			}


			if(gmove=="oben" && level[this.x][this.y-1]!= "wand"){
				this.y=this.y-1;
			}
			if(gmove=="unten" && level[this.x][this.y+1]!= "wand"){
				this.y=this.y+1;
			}
			if(gmove=="links" && level[this.x-1][this.y]!= "wand"){
				this.x=this.x-1;
			}
			if(gmove=="rechts" && level[this.x+1][this.y]!= "wand"){
				this.x=this.x+1;
			}

			c.drawImage(this.sprite, this.x*40, this.y*40);
		}	
	}

	window.onload = function(){
		//Wenn noch kein Name gewählt wurde, lade Namenseingabefeld
		if(player == "NoNameChosen"){
			document.getElementById("welcome").innerHTML = '<p>Welcome to my Pac-Man game. Please enter your name in the box below and hit Start Game.</p>'
				+'<form action="index.php" method="get" style="display: table; margin: 0 auto;"><input  type="text" name="playername"><input  type="hidden" value="yes" name="neu"><input type="submit" value="Start Game" ></form>';
		//wurde ein Namen eingegeben, lade Canvas mit Spiel und Erklärungen
		} else if(player != ""){
			document.getElementById("game").innerHTML = '<SECTION style="border-style: solid; border-width: 2px; width: 1200px; margin: 0 auto;"><CANVAS WIDTH="1200" HEIGHT="600" ID="canvas"></CANVAS></SECTION><br>'
				+'<div style="display: table; margin: 0 auto;"><p> Controls: WASD to Move</p><p>Collect the fruits to temporarily be able to kill the ghosts.</p></div>'
		
			var canvas = document.getElementById("canvas");
			window.addEventListener("keydown", richtung, true);
			if(canvas.getContext){
				c = canvas.getContext("2d");
			} 
		
		
	
			var scores = <?php echo json_encode($highscore); ?>;
		
			c.fillStyle = "black";
			c.font = "48px Helvetica";
			c.fillText("Lifes: " + leben, 810, 90);
			c.fillText("Points: " + punkte, 810, 40);

			//Schreibe Highscoreliste
			c.fillText("Highscores", 810, 160);
			for(var i = 0; i<scores.length; i++){
				c.fillText(scores[i][0], 810, 220+(i*40));
				c.clearRect(1030, 180+(i*40), 300, 50);
				c.fillText(scores[i][1], 1050, 220+i*40);
			}
		
			laden();
		}
	}

	
	//Lade nächsten Level anhand der Progress-Variable
	function nLevel(){
		if(progress == 2){
			level = JSON.parse(JSON.stringify(level2));
			geistEins = new Geist(18,13, "img/Geist1.png");
			geistZwei = new Geist(1, 13, "img/Geist2.png");
			geistDrei = new Geist(18, 1, "img/Geist3.png");
		} else if(progress == 3){
			level = JSON.parse(JSON.stringify(level3));
			geistEins = new Geist(18,13, "img/Geist1.png");
			geistZwei = new Geist(1, 13, "img/Geist2.png");
			geistDrei = new Geist(18, 1, "img/Geist3.png");
		} else {
			level = JSON.parse(JSON.stringify(level1));
			geistEins = new Geist(18,13, "img/Geist1.png");
			geistZwei = new Geist(1, 13, "img/Geist2.png");
			geistDrei = new Geist(18, 1, "img/Geist3.png");
			progress = 1;
		}
	}

	//Zeichne Spielfeld anhand des geladenen Levels, starte Timer für Pacman und Geister
	function laden(){
		c.clearRect(100,200,700,200);
		pmove = "none";
		progress++;
		nLevel();
		for(var i=0; i<20; i++){
			for(var j = 0; j<15; j++){
				if(level[i][j] == "wand"){
					
					c.drawImage(wand, i*40, j*40);
				} 
				if(level[i][j] =="punkt"){
				
				c.drawImage(dot, i*40, j*40);
				dots++;
				}

				if(level[i][j] == "frucht"){
					c.drawImage(kirsche, i*40, j*40);
				}
			}
		}

		timerPac();
		timerG();
		
	}

	//Lese Richtung aus, in die der Spieler sich bewegen möchte.
	function richtung(r){
		
		if(r.keyCode === 87){
			pmove = "oben";
		}
		if(r.keyCode === 83){
			pmove = "unten";
		}
		if(r.keyCode === 65){
			pmove = "links";
		}
		if(r.keyCode === 68){
			pmove = "rechts";
		}
	}

	//Timer für die Geister
	function timerG(){
		gTimerID = setInterval("moveG()", 500);
		c.drawImage(geistEins.sprite, geistEins.x*40, geistEins.y*40);
		c.drawImage(geistZwei.sprite, geistZwei.x*40, geistZwei.y*40);
		c.drawImage(geistDrei.sprite, geistDrei.x*40, geistDrei.y*40);
	}

	//Timer für Pacman
	function timerPac(){
		xpos = 1;
		ypos = 1;
		c.drawImage(pac, xpos*40, ypos*40)
		timerID = setInterval("move()", 300);
	}

	//Bewegung der Geister, abgleich für das Töten von Pacman oder Geist
	function moveG(){
		geistEins.jagd();
		geistZwei.jagd();
		geistDrei.jagd();

		if(xpos == geistEins.x && ypos==geistEins.y){
			kill();
			
		}
		if(xpos == geistZwei.x && ypos==geistZwei.y){
			kill();
			
		}
		if(xpos == geistDrei.x && ypos==geistDrei.y){
			kill();
			
		}
	}

	//Bewegung von Pacman, abgleich für verschiedene Events im Spiel
	function move(){
		
		c.clearRect(xpos*40, ypos*40,40,40);
		if(pmove=="oben" && level[xpos][ypos-1]!= "wand"){
			ypos=ypos-1;
		}
		if(pmove=="unten" && level[xpos][ypos+1]!= "wand"){
			ypos=ypos+1;
		}
		if(pmove=="links" && level[xpos-1][ypos]!= "wand"){
			xpos=xpos-1;
		}
		if(pmove=="rechts" && level[xpos+1][ypos]!= "wand"){
			xpos=xpos+1;
		}
		

		c.drawImage(pac, xpos*40, ypos*40);

		//Wenn sich die Position von zwei Charakteren überlappen, töte einen der beiden
		if(xpos == geistEins.x && ypos==geistEins.y){
			kill();
			
		}
		if(xpos == geistZwei.x && ypos==geistZwei.y){
			kill();
			
		}
		if(xpos == geistDrei.x && ypos==geistDrei.y){
			kill();
			
		}

		
		//Wenn der Timer für die Frucht läuft, verringere um 1
		if(fruit > 0){
			fruit--;
		}
		//Wenn die Frucht nicht aktiv ist, gib Pacman sein normales aussehen
		if(fruit == 0){
			pac.src = "img/Pacman.png"
		}

		//Wenn Pacman eine Frucht einsammelt, setze den Timer auf 25 und gib ihm ein anderes Aussehen.
		if(level[xpos][ypos] == "frucht"){
			fruit = 25;
			pac.src = "img/Pacred.png"
			level[xpos][ypos] = "none";
		}

		//Ist auf dem Feld ein Punkt, erhöhe die Punktzahl und lösche den Punkt
		if(level[xpos][ypos]=="punkt"){
			dots--;
			punkte = punkte + 10;
			level[xpos][ypos]="none";
			c.clearRect(810,0,400,50);
			c.fillStyle = "black";
			c.font = "48px Helvetica";
			c.fillText("Points: " + punkte, 810, 40);
		}
		
		//Sind alle Punkte gefressen, stoppe das Level und gib dem Spieler eine Nachricht.
		if(dots==0){

			clearInterval(timerID);
			clearInterval(gTimerID);
			c.clearRect(0,0,800,600);
			c.font = "40px Helvetica";
			c.fillText("Congratulations on beating the level.", 120, 300);
			c.font = "30px Helvetica";
			c.fillText("Press the button above the game to continue.",150,340);
			document.getElementById("loadNext").innerHTML = "<form action='index.php' method='get' style='display: table; margin: 0 auto;'><input  type='hidden' value='"+ player +"' name='playername'><input  type='hidden' value='"+ punkte +"' name='points'><input  type='hidden' value='"+ leben +"' name='leben'><input  type='hidden' value='"+ progress +"' name='progress'><input  type='hidden' value='no' name='neu'><input type='submit' value='Load next Level'></form><br>";
			

			
		}
	}

	//Funktion für das Überlappen zweier Charaktere
	function kill(){
		//Wenn ein Geist Pacman erwischt, töte Pacman
		if(fruit == 0){
		leben--;
		pmove = "none";
		clearInterval(timerID);
		timerPac();
		c.clearRect(810,50,400,50);
		c.fillStyle = "black";
		c.font = "48px Helvetica";
		c.fillText("Lifes: " + leben, 810, 90);
		}

		//Wenn Pacman eine Frucht aktiv hat, töte Geist
		if(fruit>0){
			if(xpos == geistEins.x && ypos==geistEins.y){
			geistEins.x = 18;
			geistEins.y = 13;
			
			}
			if(xpos == geistZwei.x && ypos==geistZwei.y){
			geistZwei.x = 1;
			geistZwei.y = 13;
			
			}
			if(xpos == geistDrei.x && ypos==geistDrei.y){
			geistDrei.x = 18;
			geistDrei.y = 1;
			
			}
			punkte = punkte + 50;
		}

		//Wenn Pacman keine Leben mehr hat, Game Over
		if(leben == 0){
			c.clearRect(0,0,800,600);
			c.font = "40px Helvetica";
			c.fillText("GAME OVER.", 300, 300);
			c.font = "30px Helvetica";
			c.fillText("Press the button above to save your highscore.",100,340);
			document.getElementById("loadNext").innerHTML = "<form action='index.php' method='get' style='display: table; margin: 0 auto;'><input  type='hidden' value='"+ player +"' name='scorename'><input  type='hidden' value='"+ punkte +"' name='points'><input  type='hidden' value='high' name='neu'><input type='submit' value='Save Highscore'></form><br>";
			clearInterval(timerID);
			clearInterval(gTimerID);
			
			
		}
	}


	</script>
</body>
<footer >
		<p style="float: left">© 2016 - Kevin Haustein - Alle Rechte vorbehalten</p>
	</footer>
</html>
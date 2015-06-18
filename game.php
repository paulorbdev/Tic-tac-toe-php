<?php
session_start(); 
(isset($_SESSION['id'])) ?  : header('location: index.php'); 
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">  
<title>Tic Tac Toe</title>
<link rel="icon" type="image/png" href="img/16.png" sizes="16x16">
<link rel="icon" type="image/png" href="img/32.png" sizes="32x32">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/jquery.js"> </script>
<script type="text/javascript" src="js/game.js"> </script>
</head>
<body>
<!-- load page !-->
<section id="loading"> 
<div id="text">Waiting loading room.</div>
<img src="img/load.GIF" id="gif" alt="loading"/>
</section>
<!-- end load page !-->
<section id="allgame">	
<header id="hd"><span id="hdp1">Hello, <b class="b1">player </b>(Total:3 wins and 3 defeats).</span><span id="your">You're playing with:</span> 
<span id="hdp2">Player2 (Total: 2 wins and 2 defeats).</span>
</header>
<div class="mes">Testando mensagem</div>
<section id="score"></section><!-- section score !-->
<section id="game">
<div id="players"> 
<div id="player1"></div><!-- player one !-->
<div id="player2"></div><!-- player two !-->
<div id="middle">
<div id="p1"><b class="b1">O<b/></div><!-- div p1(player 1) !-->
<div id="p2"><b class="b2">X<b/></div><!-- div p2(player 2) !-->
<div id="line"></div><!-- line of middle !-->
</div><!-- div middle !-->
</div><!-- div players !-->

<div id="box">

<div id="div0" class="boxs"></div> 
<div id="div1" class="boxs"></div> 
<div id="div2" class="boxs marginr0"></div>
<div id="div3" class="boxs"></div>
<div id="div4" class="boxs"></div>
<div id="div5" class="boxs marginr0"></div>
<div id="div6" class="boxs marginb0"></div>
<div id="div7" class="boxs marginb0"></div>
<div id="div8" class="boxs marginb0 marginr0"></div>

</div> <!-- box(Box of the game) !-->
</section><!--section game !-->
</section><!-- Close all game !-->
</body>
</html>
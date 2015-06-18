<?php
session_start(); 
(!isset($_SESSION['id'])) ?  : header('location: game.php'); 
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login - Tic Tac Toe</title>
<link rel="icon" type="image/png" href="img/16.png" sizes="16x16">
<link rel="icon" type="image/png" href="img/32.png" sizes="32x32">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<style type="text/css"> 
      *{margin:0; padding:0;}
      body{background: #404040; }
      section#cont, #cont2{width: 800px; height: 65px; background:#5D5D5D; margin: 0px auto; border-radius: 2px; padding-top: 15px;}
      section#message{width: 800px; height: 60px; margin: 0 auto; padding-top: 200px;}
      .mes{width:500px; margin:0 auto; height:32px; background:#CE0000; border: 2px solid #8C0000; border-radius: 3px; 
      text-align: center; font: bold 18px arial; color: #fff; padding-top: 13px; cursor: pointer;}
      .sucess{background: #009900; border-color: #006600;}
      div#form {width: 600px; height: 40px; margin: 0 auto;}
      div#form a {float:right; margin: 3px 140px; color: #fff; font:16px arial; text-decoration: none;}
      div#form a:hover {text-decoration: underline;}
      input.em, .put2{border:1px solid #999999; width: 38%; height: 30px; outline: none; border-radius: 2px;
      	margin-right: 5px; font: 15px verdana; color: #999999;}
      input.em:focus, .put2:focus{border-color: #707070;}
      input#bt, #bt2 {width: 105px; height: 32px; background:#46AA5D; border: none; border-radius: 2px;
      	font: 15px verdana; color: #fff; outline: none;}
      input#bt:hover, #bt2:hover{background: #449955;}
      .hover {cursor: pointer;}
      .disabled {opacity: 0.7; cursor: wait;}
      /* Register Page */
      #cont2 {width: 450px; height: 210px; padding-top: 10px;}
      #form2{width: 400px; margin: 0 auto; height: 290px;}
      .put2{width: 100%; height: 30px; font: 14px verdana; color: #999999; margin-bottom: 10px;}
      #bt2{float:right;}
</style>
</head>
<body>
<section id="message">
<div class="mes"></div>
</section>
<section id="cont"> 
<div id="form">
<form method="post" name="login"> 
<input type="text" class="em" id="mail" placeholder="E-mail or login" name="login"/>
<input type="password" class="em" id="pass" placeholder="Password" name="pass"/>
<input type="submit" class="hover" id="bt" value="Login"/>
<div id="register"><a id="link" href="">Register now</a></div>
</form>
</div><!-- div form !-->
</section><!-- section cont !-->

<!-- Register Page !-->
<section id="cont2">
<div id="form2">
<form method="post" name="register">
  <input type="text" id="lg2" class="put2" placeholder="Login" name="login"/><br/>
  <input type="email" id="em2" class="put2" placeholder="Email" name="email"/><br/>
  <input type="password" id="pw1" class="put2" placeholder="Password" name="pass"/><br/>
  <input type="password" id="pw2" class="put2" placeholder="Repeat password" name="pass2"/><br/>
  <input type="submit" class="hover" id="bt2" value="Sign up"/></form>
</div><!-- div form2 !-->
</section><!-- section  cont2 !-->
</body>
</html>
<?php
session_start();
if(isset($_SESSION['id'])):
require_once 'constant.php';
require_once '../class/connection.class.php';
require_once '../class/crud.class.php';
require_once '../class/rooms.class.php';
$room = new Rooms;

if($fetch = $room->selectRoom($_SESSION['id'])){
 $div = $_POST['div'];
 $player = ($fetch->idp1 == $_SESSION['id']) ? 'p1' : 'p2';
  if($player == $fetch->playing && $fetch->time >= date("Y-m-d H:i:s") && $fetch->$div == ''){
 	 if($room->updateDiv($div, $player, $fetch->id)){
      echo $player;
  }
 }
}

endif;
<?php
session_start();
if(isset($_SESSION['id'])):
require_once 'constant.php';
require_once '../class/connection.class.php';
require_once '../class/crud.class.php';
require_once '../class/users.class.php';
require_once '../class/rooms.class.php';
$room = new Rooms;
$users = new Users;
$infoOnline = $users->selectUser($_SESSION['id']);
$users->updateOnline($_SESSION['id']);
if(!$fetch = $room->selectRoom($_SESSION['id'])){
    if(!$room->updatePlayer(0,$_SESSION['id'])){
            $room->insertRoom($_SESSION['id']);
      }
	  echo json_encode('nothing');
}else if($fetch->idp1 == 0 || $fetch->idp2 == 0){
    
    $room->updatePlaying(0,$fetch->id);
	 $player = ($_SESSION['id'] == $fetch->idp1 ? 4 : 3);
   echo json_encode(array('cod'=>$player, 'online' => $infoOnline->nick));

}else if($fetch->playing === '0'){
  $players = array('p1','p2');
	$room->updatePlaying($players[rand(0,1)],$fetch->id);
   echo json_encode('nothing');
}else if($fetch->time < date("Y-m-d H:i:s")){
  if($fetch->playing == 'p1' && $users->selectUser($fetch->idp1)->online <= date("Y-m-d H:i:s")){
     $room->updatePlayer($fetch->idp1, 0);
     $room->updatePlaying(0,$fetch->id);
     $room->cleanRoom($fetch->id);
     echo json_encode(array('cod'=>3, 'online' => $infoOnline->nick));

  }else if($fetch->playing == 'p2' && $users->selectUser($fetch->idp2)->online <= date("Y-m-d H:i:s")){
     $room->updatePlayer($fetch->idp2, 0);
     $room->updatePlaying(0,$fetch->id);
     $room->cleanRoom($fetch->id);
     echo json_encode(array('cod'=>4, 'online' => $infoOnline->nick));
  }else if($fetch->playing == 'p1'){
    $room->updatePlaying('p2',$fetch->id);
	echo json_encode('nothing');

  }else{
    $room->updatePlaying('p1',$fetch->id); 
	echo json_encode('nothing');
  }
} else {

    $player = ($_SESSION['id'] == $fetch->idp1 ? 'idp1' : 'idp2');
    $infoUser = $users->selectUser($fetch->$player);
    $infoPlayer2 = ($player == 'idp1') ? $users->selectUser($fetch->idp2) : $users->selectUser($fetch->idp1);

    $ret = array('playing' => $fetch->playing, 'div0' => $fetch->div0, 'div1' => $fetch->div1, 'div2' => $fetch->div2, 
      'div3' => $fetch->div3, 'div4' => $fetch->div4, 'div5' => $fetch->div5, 'div6' => $fetch->div6, 'div7' => $fetch->div7, 
      'div8' => $fetch->div8);

    $ret['me']['idp'] = $player;
    $ret['me']['nick'] = $infoUser->nick;
    $ret['me']['wins'] = $infoUser->wins;
    $ret['me']['defeats'] = $infoUser->defeats;
    $ret['p2']['nick'] = $infoPlayer2->nick;
    $ret['p2']['wins'] = $infoPlayer2->wins;
    $ret['p2']['defeats'] = $infoPlayer2->defeats;  
    echo (json_encode($ret));
}
usleep(500000);
endif;
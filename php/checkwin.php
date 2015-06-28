<?php
session_start();
if(isset($_SESSION['id'])):
require_once 'constant.php';
require_once '../class/connection.class.php';
require_once '../class/crud.class.php';
require_once '../class/rooms.class.php';
require_once '../class/users.class.php';
$room = new Rooms;
$users = new Users;


//Check possibilities.
function check($div1,$div2,$div3){
if($div1 == 'div0' && $div2 == 'div1'&& $div3 == 'div2'){
    return TRUE;

}else if($div1 == 'div3' && $div2 == 'div4' && $div3 == 'div5'){
    return true;
}else if($div1 == 'div6' && $div2 == 'div7' && $div3 == 'div8'){
   return true;
}else if($div1 == 'div0' && $div2 == 'div4' && $div3 == 'div8'){
  return true;
}else if($div1 == 'div2' && $div2 == 'div4' && $div3 == 'div6'){
  return true;
}else if($div1 == 'div2' && $div2 == 'div5' && $div3 == 'div8'){
  return true;
}else if($div1 == 'div0' && $div2 == 'div3' && $div3 == 'div6'){
  return true;
}else if($div1 == 'div1' && $div2 == 'div4' && $div3 == 'div7'){
  return true;

} else {
  return FALSE;
}
}

if($fetch = $room->selectRoom($_SESSION['id'])){
  $div1 = $_GET['div1'];
  $div2 = $_GET['div2'];
  $div3 = $_GET['div3'];
 
 if( check($div1,$div2,$div3) && $fetch->$div1 == 'p1' && $fetch->$div2 == 'p1' && $fetch->$div3 == 'p1' || $fetch->$div1 == 'p2' && $fetch->$div2 == 'p2' && $fetch->$div3 == 'p2'){
     $room->updatePlaying(0,$fetch->id);
     $room->cleanRoom($fetch->id);
     if($fetch->$div1 == 'p1'){
      $users->updateWinsDefeats('wins',$fetch->idp1);
      $users->updateWinsDefeats('defeats',$fetch->idp2);
        echo '<b class="b1">'.$users->selectUser($fetch->idp1)->nick.'</b>';
     }else {
      $users->updateWinsDefeats('wins',$fetch->idp2);
      $users->updateWinsDefeats('defeats',$fetch->idp1);
       echo '<b class="b2">'.$users->selectUser($fetch->idp2)->nick.'</b>';
     }
 } else if($div1 == 'all'){
  if($fetch->div1 != '' && $fetch->div1 != '' && $fetch->div1 != '' && $fetch->div1 != '' && $fetch->div1 != '' && 
    $fetch->div1 != '' && $fetch->div1 != '' && $fetch->div1 != '' && $fetch->div1 != ''){
    $room->updatePlaying(0,$fetch->id);
    $room->cleanRoom($fetch->id);
    echo 'tie';
  }
 }

}


endif;

<?php
session_start();
(!isset($_SESSION['id'])) ?  : header('location: game.php'); 
require_once 'constant.php';
require_once '../class/connection.class.php';
require_once '../class/crud.class.php';
require_once '../class/users.class.php';
require_once '../class/rooms.class.php';
$user = new Users();

$action = $_POST['action'];
switch($action):

  case 'register':
     $password = $_POST['pass'];
     $email = strip_tags($_POST['email']);
     $nick = strip_tags($_POST['login']);
     if($user->insertInto($email,$nick,$password)):
      echo 'true';
    else:
       echo 'false';
    endif;
    break;
  

    case 'login':
   $room = new Rooms;
     $pass = strip_tags($_POST['pass']);
     $nick = strip_tags($_POST['login']);
      if(!$fetch = $user->login($nick,$pass)){
        //Login or password incorret.
            echo 'wrong';
    }else if($fetch->online > date("Y-m-d H:i:s")){
      //If user is online
        echo 'online';
    }else if(!$fetch2 = $room->selectRoom($fetch->id)){
      //If dosen't exist room with id of user.
      if( !$room->updatePlayer(0,$fetch->id)){
            $room->insertRoom($fetch->id);
        }
        $_SESSION['id'] = $fetch->id;
     echo 'não tem sala - loga';
    }else if(($fetch2->time) >= date("Y-m-d H:i:s")){
      //If exist exist room with id of player and it's playing.
      $_SESSION['id'] = $fetch->id;
      echo 'existe sala - jogando - loga';
    }else{
     //If exist room with id of player but it's not playing.
     $room->deleteRoom($fetch2->id);
      if(!$room->updatePlayer(0,$fetch->id)){
            $room->insertRoom($fetch->id);
        }
     $_SESSION['id'] = $fetch->id;
    echo 'existe sala - não jogando';
  }
    break;

  default:
  header('Location: ../index.php');
endswitch;

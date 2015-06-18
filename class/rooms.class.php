<?php

class Rooms extends Crud{

	protected $table = 'rooms';

    //Select a room by id of user.
    public function selectRoom($idplayer,$values='*'){
    try{
      $query = Connection::getCon()->prepare("SELECT $values FROM $this->table WHERE idp1 = ? OR idp2 = ? LIMIT 1");
      $query->bindValue(1, $idplayer, PDO::PARAM_INT);
      $query->bindValue(2, $idplayer, PDO::PARAM_INT);
      $query->execute();
      return $query->fetch(PDO::FETCH_OBJ);
      } catch(PDOException $e){
      	echo Connection::handlePDO($e);
      }
    }

    //Clean all divs of table room.
    public function cleanRoom($id){
      try{
        $query = Connection::getCon()->prepare("UPDATE $this->table SET div0 = '', div1 = '', div2 = '', div3 = '', div4 = '', 
        div5 = '', div6 = '', div7 = '', div8 = '' WHERE id = ?");
        $query->bindValue(1, $id, PDO::PARAM_INT);
        return $query->execute();
      } catch(PDOException $e){
        echo Connection::handlePDO($e);
      }
    }

    //Delete room by id.
    public function deleteRoom($idroom){
     try{
      $query = Connection::getCon()->prepare("DELETE FROM $this->table WHERE id = ?");
      $query->bindValue(1, $idroom, PDO::PARAM_INT);
      return $query->execute();
     } catch(PDOException $e){
        echo Connection::handlePDO($e);
     }
    }
    
    //Insert a room with id of player.
    public function insertRoom($idplayer1,$idplayer2=0){
      try{
         $query = Connection::getCon()->prepare("INSERT INTO $this->table (idp1, idp2) VALUES (?, ?)");
         $query->bindValue(1, $idplayer1, PDO::PARAM_INT);
         $query->bindValue(2, $idplayer2, PDO::PARAM_INT);
         return  $query->execute();     
      } catch(PDOException $e){
        echo Connection::handlePDO($e);
      }
    }

   
   //Update data of room.
   public function updateRoom($player1,$player2,$idroom){
    try{
      $query = Connection::getCon()->prepare("UPDATE $this->table SET idp1 = ?, idp2 = ? WHERE id = ?");
      $query->bindValue(1, $player1, PDO::PARAM_INT);
      $query->bindValue(2, $player2, PDO::PARAM_INT);
      $query->bindValue(3, $idroom,  PDO::PARAM_INT);
      return $query->execute();
    }catch(PDOException $e){
       echo Connection::handlePDO($e);
    }
    }

    //Update the column of "playing".
    public function updatePlaying($playing, $idRoom){
      if($playing == 'p1' || $playing == 'p2' || $playing == 0){
       try{
       $query = Connection::getCon()->prepare("UPDATE $this->table SET playing = ?, time = ? WHERE id = ?");
       $query->bindValue(1, $playing, PDO::PARAM_STR);
       $query->bindValue(2, date('Y-m-d H:i:s',strtotime('+30 seconds')));
       $query->bindValue(3, $idRoom, PDO::PARAM_INT);
       return $query->execute();
      }catch(PDOException $e){
        echo Connection::handlePDO($e);
      } 

     }

    }
    
    //Update a div and the "playing" of the table room.
    public function updateDiv($div, $value, $idRoom){
      $divs = array('div0','div1','div2','div3','div4','div5','div6','div7','div8');
      $other = ($value == 'p1') ? 'p2' : 'p1';
      if(in_array($div,$divs) && $value == 'p1' || $value='p2'){
       try{
       $query = Connection::getCon()->prepare("UPDATE $this->table SET $div = ? WHERE id = ?");
       $query->bindValue(1, $value, PDO::PARAM_STR);
       $query->bindValue(2, $idRoom, PDO::PARAM_INT);
       $this->updatePlaying($other, $idRoom);
       return $query->execute();
      }catch(PDOException $e){
        echo Connection::handlePDO($e);
      }       
     }
    }

    //Update player of room.
    public function updatePlayer($idplayer,$idupdate=0){
      try{
          if($room = $this->selectRoom($idplayer,'id, idp1, idp2')){
            if($room->idp1 == $idplayer){
               return $this->updateRoom($idupdate,$room->idp2,$room->id);
            } else if($room->idp2 == $idplayer) {
              return $this->updateRoom($room->idp1,$idupdate,$room->id);     
            }
          } 
        } catch(PDOException $e){
          echo Connection::handlePDO($e);
        }    
    }

  
	

}//End of the class.
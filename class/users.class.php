<?php


class Users extends Crud{

	protected $table = 'user';
    
    //Insert a new register in the table.
	public function insertInto($email,$nick,$password){
	try{
	    $password = $this->convertPass($password);	
        $query = Connection::getCon()->prepare("INSERT INTO $this->table (email, nick, pass) VALUES (?,?,?)");
        $query->bindValue(1, $email, PDO::PARAM_STR);
        $query->bindValue(2, $nick, PDO::PARAM_STR);
        $query->bindValue(3, $password, PDO::PARAM_STR);
        return $query->execute();
      } catch (PDOException $e){
       echo Connection::handlePDO($e);
     }
	}
  
  //Select user by id
  public function selectUser($id){
   try{  
    $query = Connection::getCon()->prepare("SELECT * FROM $this->table WHERE id = ?");
    $query->bindValue(1, $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_OBJ);
   } catch(PDOException $e){
        echo Connection::handlePDO($e);
   }
  }
 
  
	public function login($nickmail, $password){
	try{	
		$password = $this->convertPass($password);
		$query = Connection::getCon()->prepare("SELECT * FROM $this->table WHERE (email = ? OR nick = ?) AND pass = ?");
		$query->bindValue(1, $nickmail, PDO::PARAM_STR);
		$query->bindValue(2, $nickmail, PDO::PARAM_STR);
		$query->bindValue(3, $password, PDO::PARAM_STR);
    $query->execute();
    return $query->fetch(PDO::FETCH_OBJ);
	 } catch(PDOException $e){
        echo Connection::handlePDO($e);
	 }
	}

  //Update date of user.
  public function updateOnline($id){
    try{
      $query = Connection::getCon()->prepare("UPDATE $this->table SET online = ? WHERE id = ?");
      $query->bindValue(1, date('Y-m-d H:i:s',strtotime('+10 seconds')));
      $query->bindValue(2, $id, PDO::PARAM_INT);
      return $query->execute();
    } catch (PDOException $e){
      echo Connection::handlePDO($e);
    }
  }

  public function updateWinsDefeats($winorde, $id){
   if($winorde == 'wins' || $winorde == 'defeats'){
    try{
      $query = Connection::getCon()->prepare("UPDATE $this->table SET $winorde = $winorde+1 WHERE id = ?");
      $query->bindValue(1, $id, PDO::PARAM_INT);
      return $query->execute();
    } catch (PDOException $e){
      echo Connection::handlePDO($e);
    }
  }
  }

   //Convert password to md5.
   private function convertPass($password){
   	 $randomWord = 'numqo1po309éíx';
   	 return md5($randomWord.$password);
   }	

}//End of the class.
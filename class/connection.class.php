<?php


abstract Class Connection {
   
     private static $con;

    //Open the connection to MySql and get it.
    protected static function getCon(){

    	if(empty(self::$con)){

          try{

          self::$con = new PDO('mysql:host='.HOST.';dbname='.DB,USER,PASS);
          self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch(PDOException $e) {
          echo Connection::handlePDO($e);
      }
      
    }    
      return self::$con;
  }

  //Handle PDOException's
  protected function handlePDO(PDOException $exception){
  	$return  = '<b>Erro message: </b>'.$exception->getMessage().'<br/>';
  	$return .= '<b>Erro code: </b>'.$exception->getCode().'<br/>';
  	$return .= '<b>Erro file: </b>'.$exception->getFile().'<br/>';
    $return .= '<b>Erro line: </b>'.$exception->getLine();
  	return $return;
  }

} //End of the class.
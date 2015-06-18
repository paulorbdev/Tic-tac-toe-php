<?php
// Class of transitions.
final class Transition {
 
   private static $connection;
  
  //prevent create objects of this class.
  private function  __construct(){}
  
  //Open a new transition
  public static function open(){
  	if(empty(self::$conection)){
  		self::$connection = new PDO('mysql:host='.HOST.';dbname='.DB,USER,PASS);
  		//start the transition
  		self::$connection->beginTransaction();
  	}
  }

  //get the connection 
  public static function get(){
  	return self::$connection;
  }
  
  //Undoes all changes.
  public static function rollBack(){
       if(self::$connection){
       	 self::$connection->rollback();
       	 self::$connection = NULL;
       }
  }
  
  //Make everything and close the transition.
  public static function close(){
  	if(self::$connection){
  		self::$connection->commit();
  		self::$connection = NULL;
  	}
  }
 
}
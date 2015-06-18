<?php
abstract class Crud extends Connection{
     
     protected $table;

     //Select All registers of the table.
     protected function selectAll(){

    try{
      $query = Connection::getCon()->query("SELECT * FROM $this->table");
      return $query->fetchAll(PDO::FETCH_OBJ);

     } catch(PDOException $e){
       echo Connection::handlePDO($e);
     }

   }

}//End of the class.
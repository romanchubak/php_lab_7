<?php
  include 'Lector.php';
  include_once "../configs/config_for_lab6.php";

  $mysqli = new mysqli($link,$username,$password,$dbname);

  if(isset($_POST["AddLector"])){
      $FirstName=$_POST["FirstName"];
      $SecondName = $_POST["SecondName"];
      $Birthday = $_POST["Birthday"];
         if($FirstName!="" && ctype_alpha($FirstName)&&
          $SecondName !="" && ctype_alpha($SecondName)) {
             $lector = new Lector(null,$FirstName,$SecondName,$Birthday);
             $lector->WriteToDB($mysqli,"lector");
             $data = Lector::getFromDb($mysqli,"lector");
         }
  }
  $data = Lector::getFromDb($mysqli,"lector");
  $mysqli->close();
 ?>

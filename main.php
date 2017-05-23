<?php
      include  "Subject.php";
      include_once "../configs/config_for_lab6.php";

      $mysqli = new mysqli($link,$username,$password,$dbname);
      $data=array();
      $atrybut = array();
      $selectForFormControl = FormControl::makeSelect("FormOfControl","Форма контролю",
                                  FormControl::getFromDb($mysqli,"formcontrol") );
      $selectForLectors = Lector::makeSelect("Lector","Лектор",
                                Lector::getFromDb($mysqli,"lector"),true);

      if(isset($_POST['selectAtrybut']))
      {
          $atrybut = array($_POST['atrybut'] => $_POST['atrybut_text']);
      }

      if(isset($_POST["Add"])){
      $NameOfSubject=$_POST["NameOfSubject"];
      $NumberOfTerm = $_POST["NumberOfTerm"];
      $CountOfHours = $_POST["CountOfHours"];
      $FormOfControl = new FormControl($_POST["FormOfControl"]);
      $Lector = Lector::getFromDb($mysqli,"lector",$_POST["Lector"]);
      if($_POST["Lector"] === "addnew")
      {
        header('Location: IndexForAddLector.php');
        exit();
      }
      if($NameOfSubject!="" && ctype_alpha($NameOfSubject)&&
            $NumberOfTerm !="" && is_numeric($NumberOfTerm)&&
            $CountOfHours !="" && is_numeric($CountOfHours))
             {
          $subject = new Subject($NameOfSubject,$NumberOfTerm,$CountOfHours
                                  ,$FormOfControl,$Lector);
          $subject->WriteToDB($mysqli,"subject");
          $data = Subject::getFromDb($mysqli,"subject",$atrybut);
      }
    }
    $data = Subject::getFromDb($mysqli,"subject",$atrybut);
      $mysqli->close();
?>

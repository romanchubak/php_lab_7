<?php
  include_once "FormControl.php";
  include_once 'Lector.php';


  class Subject{
    private $Name;
    private $NumberOfSemestr;
    private $CountOfHours;
    private $FormControl;
    private $Lector;

    public function __construct($name,$num,$countH,$formC,$lector)
    {
        $this->Name = $name;
        $this->NumberOfSemestr = $num;
        $this->CountOfHours = $countH;
        $this->FormControl = $formC;
        $this->Lector = $lector;
    }
    public function __toString()
    {
        return $this->Name." | ".$this->NumberOfSemestr." | ".
               $this->CountOfHours." | ". $this->FormControl." | ".
               $this->Lector;
    }
    public function GetName()
    {
        return $this->Name;
    }
    public function GetNumberOfSemestr()
    {
        return $this->NumberOfSemestr;
    }
    public function GetCountOfHours()
    {
        return $this->CountOfHours;
    }
    public function GetFormControl()
    {
        return $this->FormControl;
    }
    public function GetLector()
    {
        return $this->Lector;
    }
    public function WriteToDB($mysqli,$table)
    {
        $sql = "INSERT INTO ".$table." (Name, NumberOfSemestr, CountOfHours,
                                                IdFormControl, IdLector)
                         VALUES ('".$this->Name."',
                                 '".$this->NumberOfSemestr."',
                                 '".$this->CountOfHours."',
                                 '".$this->FormControl->GetValue(true)."',
                                 '".$this->Lector->GetId()."')";
        $mysqli->query($sql);
    }
    public static function getFromDb($mysqli,$table,$atrybut)
    {
        $sql = "SELECT Name, NumberOfSemestr, CountOfHours,
              IdFormControl, IdLector FROM ".$table." WHERE ";
        foreach ($atrybut as $key => $value) {
            $sql .= $key."='".$value."'";
        }
        $subjects = array();
        if($result = $mysqli->query($sql))
        while ( $obj = $result->fetch_object())
        {
          $tmp = new Subject($obj->Name,$obj->NumberOfSemestr,
                               $obj->CountOfHours,
                               new FormControl($obj->IdFormControl),
                               Lector::getFromDb($mysqli,"lector",$obj->IdLector));
          $subjects[] = $tmp;
        }
        return $subjects;
    }
    public static function makeTable($values)
    {
      $table="";
      $table.='<table border cellspacing="0"><thead><tr>';
      $table.='<th width="14%">Name</th>
               <th width="14%">NumberOfSemestr</th>
               <th width="14%">CountOfHours</th>
               <th width="14%">Birth Day</th>
               <th width="14%">First Name</th>
               <th width="14%">Second Name</th>';
      $table.='</tr></thead><tbody>';
      foreach ($values as $value)
      {
          $table .= '<tr>';
          $table .= '<td align="center">'.$value->GetName().'</td>';
          $table .= '<td align="center">'.$value->GetNumberOfSemestr().'</td>';
          $table .= '<td align="center">'.$value->GetCountOfHours().'</td>';
          $table .= '<td align="center">'.$value->GetFormControl()->GetValue().'</td>';
          $table .= '<td align="center">'.$value->GetLector()->GetFirstName().'</td>';
          $table .= '<td align="center">'.$value->GetLector()->GetSecondName().'</td>';
          $table .= '</tr>';
      }
      $table .= '</tbody></table>';
      return $table;
    }
  }
 ?>

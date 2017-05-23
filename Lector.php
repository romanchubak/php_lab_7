<?php

  class Lector
  {
    private $IdLector;
    private $FirstName;
    private $SecondName;
    private $Birthday;
    function __construct($IdL,$Fname,$Sname,$Bday)
    {
        $this->IdLector = $IdL;
        $this->FirstName = $Fname;
        $this->SecondName = $Sname;
        $this->Birthday = $Bday;
    }
    public function GetId()
    {
      return $this->IdLector;
    }
    public function GetFirstName()
    {
      return $this->FirstName;
    }
    public function GetSecondName()
    {
      return $this->SecondName;
    }
    public function GetBirthday()
    {
      return $this->Birthday;
    }
    public function WriteToDB($mysqli,$table)
    {
        $mysqli->query("INSERT INTO ".$table." ( FirstName, SecondName, BirthDay)
                        VALUES ('".$this->FirstName."',
                                '".$this->SecondName."',
                                '".$this->Birthday."')");
    }
    public static function getFromDb($mysqli,$table,$id = null)
    {
        $lector = array();
        $sql = "SELECT IdLector, FirstName, SecondName, BirthDay FROM ".$table;
        if($id!=null)
        {
            $sql .=" WHERE IdLector='".$id."'";
            $result = $mysqli->query($sql);
            $lector = $result->fetch_array();
            return new Lector($lector[0],$lector[1],$lector[2],$lector[3]);
        }
        else {
          $result = $mysqli->query($sql);
          while ( $obj = $result->fetch_object())
          {
            $tmp = new Lector($obj->IdLector,$obj->FirstName,
                              $obj->SecondName,$obj->BirthDay);
            $lector[] = $tmp;
          }
          return $lector;
        }
    }
    public static function makeSelect($name,$label,$list,$addnew = false)
    {
      $select = "";
      $select .= '<label for="'.$name.'">'.$label.'</label><br>';
      $select .= '<select name="'.$name . '">';
      foreach ($list as $value) {
        $select .= '<option value="'.$value->GetId().'">';
        $select .= $value->GetFirstName()." ".$value->GetSecondName()." </option> ";
      }
      if($addnew) $select .= '<option value="addnew">Додати</option>';
      $select .= "</select><br>";
      return $select;
    }
    public static function makeTable($values)
    {
      $table="";
      $table.='<table border cellspacing="0"><thead><tr>';
      $table.='<th width="14%">Id</th><th width="14%">First Name</th>
               <th width="14%">Second Name</th><th width="14%">Birth Day</th>';
      $table.='</tr></thead><tbody>';
      foreach ($values as $value)
      {
          $table .= '<tr>';
          $table .= '<td align="center">'.$value->GetId().'</td>';
          $table .= '<td align="center">'.$value->GetFirstName().'</td>';
          $table .= '<td align="center">'.$value->GetSecondName().'</td>';
          $table .= '<td align="center">'.$value->GetBirthday().'</td>';
          $table .= '</tr>';
      }
      $table .= '</tbody></table>';
      return $table;
    }

    public function __toString()
    {
      return  $this->FirstName." | ".$this->SecondName." | ".$this->Birthday;
    }
  }

 ?>

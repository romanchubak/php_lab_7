<?php
  class FormControl {
    private $value;
    function __construct($val)
    {
       $this->value = "Zalic";
       if($val === 2 || $val === "Exzamen") $this->value = "Exzamen";
    }
    public function __toString()
    {
        return $this->value;
    }
    public function GetValue($num=false)
    {
        if(!$num)
          return  $this->value;
        else
          return ($this->value === "Zalic")?1:2;
    }
    public static function getFromDb($mysqli,$table)
    {
      $sql = "SELECT * FROM ".$table;
      $forms= array();
      $result = $mysqli->query($sql);
      while ( $obj = $result->fetch_object())
      {
        $tmp = new FormControl($obj->NameFormControl);
        $subjects[] = $tmp;
      }
      return $subjects;
    }
    public static function makeSelect($name,$label,$list,$addnew = false)
    {
      $select = "";
      $select .= '<label for="'.$name.'">'.$label.'</label><br>';
      $select .= '<select name="'.$name . '">';
      foreach ($list as $value) {
        $select .= '<option value="'.$value->GetValue().'">';
        $select .= $value->GetValue()." </option> ";
      }
      if($addnew) $select .= '<option value="addnew">Додати</option>';
      $select .= "</select><br>";
      return $select;
    }
  }
 ?>

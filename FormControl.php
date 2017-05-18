<?php
  class FormControl {
    const Zalic = 1;
    const Exzamen = 2;
    private $value;
    function __construct($val)
    {
        if($val === 1 || $val === "Zalic") $this->value = "Zalic";
        else if($val === 2 || $val === "Exzamen") $this->value = "Exzamen";
        else $this->value = "undefine";
    }
    public function __toString()
    {
        return $this->value;
    }

    public function GetValue()
    {
        return  $this->value;
    }
  }
 ?>

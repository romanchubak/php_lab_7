<?php

  class Lector
  {
    private $FirstName;
    private $SecondName;
    private $Birthday;
    function __construct($Fname,$Sname,$Bday)
    {
        $this->FirstName = $Fname;
        $this->SecondName = $Sname;
        $this->Birthday = $Bday;
    }
    public function WriteToDB($mysqli)
    {
        $mysqli->query("INSERT INTO lector ( FirstName, SecondName, BirthDay)
                        VALUES (NULL, '".$this->FirstName."',
                                      '".$this->SecondName."',
                                      '".$this->BirthDay."')");
    }
  }

 ?>

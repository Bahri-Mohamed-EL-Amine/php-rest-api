<?php
class Student
{

    public $name;
    public $email;
    public $phone_number;


    private mysqli $conn  ;
    private $table_name;

    //  constructor
    public function __construct( $db)
    {
        $this->conn = $db;
        $this->table_name = "students";
    }
    public  function  create_data() 
    {


        // sql query to insert data

        $query = "INSERT INTO " . $this->table_name .
            "( name, email,phone_number) values( ?,  ?, ?)";
        $obj = $this->conn->prepare($query);

        // removing special characters 
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));


        // bingin params with prepared statement
        $obj->bind_param('sss',$this->name,$this->email,$this->phone_number);
        return $obj->execute();
    }
}




?>
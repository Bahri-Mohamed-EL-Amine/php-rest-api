<?php
class Student
{

    public $name;
    public $email;
    public $phone_number;


    protected mysqli $conn ;
    protected $table_name;

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

    public function read_all_data(){
        $query = "SELECT * FROM ". $this->table_name;
        $obj =  $this->conn->prepare($query);
        $obj->execute();
        return $obj->get_result();
    }
    public function read_data($id){
        $query ='SELECT * FROM '.$this->table_name." WHERE id = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param('i',$id);
        $obj->execute();
        $data = $obj->get_result();
        return $data->fetch_assoc();
    }
    


}

class StudentUpdate extends Student{
    public $status;
    public $created_at;
    public $id;
    function __construct($db){
        parent::__construct($db);
    }
    public function update_data()
    {
        $query = "UPDATE " . $this->table_name . " SET name = ? , email = ? ,phone_number = ? , status = ? , created_at = ? WHERE id = ?";
        $obj = $this->conn->prepare($query);
        $obj->bind_param('sssssi',$this->name,$this->email,$this->phone_number,$this->status,$this->created_at,$this->id);
        return $obj->execute();
    }
}




?>
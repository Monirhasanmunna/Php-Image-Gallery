<?php
 class Database{

     private $dsn ="mysql:host=localhost;dbname=db_evento";
     private $dbuser = "root";
     private $dbpass = "";

     public $conn;

     public function __construct()
     {
         try{

             $this->conn = new PDO($this->dsn,$this->dbuser,$this->dbpass);

         }catch(PDOException $e){

            echo 'Error: '.$e->getMessage();

         }
         return $this->conn;
     }

     //Check Input
     public function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
     //Error Success Message Alert
     public function showMessage($type ,$message){
 
        return '<div class="alert alert-'.$type.'" role="alert">
                    <strong>'.$message.'</strong>
                </div>';

                
     }

     //Display all events
     public function display_events(){
         
        $sql = "SELECT * FROM tbl_events WHERE status = 1";
        $stmt =$this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
     }
   
     //display single event
     public function show_events($id){
        $sql ="SELECT * FROM tbl_events WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    //View Events
    public function edit_events($id){
        $sql ="SELECT * FROM tbl_events WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

 }



    $viewevents = new Database();
  

   //Handle View Event Ajax Request
    if(isset($_POST['view_id'])){
        $id = $_POST['view_id'];

        $row= $viewevents->edit_events($id);
        echo json_encode($row);
   }

?>
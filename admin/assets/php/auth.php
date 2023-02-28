<?php

 require_once 'config.php';


 class Auth extends Database{

    //Register New User
    public function register($name,$email,$password){

        $sql ="INSERT INTO users (name, email ,password) VALUES(:name,:email,:pass)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' =>$name, 'email'=>$email, 'pass'=>$password]);
        return true;
    }

    //Check if user already registered
    public function user_exist($email){
        $sql = "SELECT email FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' =>$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    //Login Existing User
    public function login($email){
        $sql = "SELECT email, password FROM users WHERE email = :email ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    //Current User In Session
    public function currentUser($email){
        $sql = "SELECT * FROM users WHERE email = :email ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    //Forgot PAssword 
    public function forgot_password($token,$email){

        $sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(),INTERVAL 10 MINUTE) WHERE email= :email";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['token'=>$token, 'email'=>$email]);

        return true;
    }
    //Reset Password User Auth
    public function reset_pass_auth($email, $token){
        $sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token != '' AND token_expire > NOW()";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email,'token'=>$token]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    //Update New Password
    public function update_new_pass($pass, $email){

        $sql = "UPDATE users SET token = '' ,password = :pass WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['pass'=>$pass,'email'=>$email]);
        return true;
    }

    //Add new Events 
    public function add_new_event($title,$description,$place,$address,$date,$image){

        $sql ="INSERT INTO tbl_events(title,description,place_name,address,date,image) VALUES (:title,:description,:place,:address,:date,:image)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['title'=>$title,'description'=>$description,'place'=>$place,'address'=>$address,'date'=>$date,'image'=>$image]);

        return true;
    }
    //Fetch all events
    public function get_events(){
        
        $sql = "SELECT * FROM tbl_events";
        $stmt =$this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    //Edit Events 
    public function edit_events($id){
        $sql ="SELECT * FROM tbl_events WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    //Update Events
    public function update_event($id,$title,$description,$place,$address,$date){
        $sql = "UPDATE tbl_events SET title = :title,description =:description,place_name = :place,address = :address,date = :date WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['title'=>$title,'description'=>$description,'place'=>$place,'address'=>$address,'date'=>$date,'id'=>$id]);
        return true;

    }
    //Delete Events
    public function delete_event($id){
        $sql = "DELETE FROM tbl_events WHERE id = :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }
    //Active Events
    public function active_event($id){
        $sql = " UPDATE tbl_events SET status = 1 WHERE id = :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }
    //Inactive Events
    public function inactive_event($id){
        $sql = " UPDATE tbl_events SET status = 0 WHERE id = :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }

 }

?>
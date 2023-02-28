<?php

class db{

    public $hostName = 'localhost';
    public $userName = 'root';
    public $password;
    public $dbName = 'phpproject';
    public $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect( $this->hostName, $this->userName, $this->password, $this->dbName);

        if(!$this->conn){
            echo 'not connected';
        }
    }

    public function insert($title, $description, $file)
    {
        $fileName    = $file['image']['name'];
        $tmpfileName= $file['image']['tmp_name'];
        $x           = uniqid();
        $x           = str_shuffle($x);
        $image       = '../admin/uploads/'.substr($x, 0,6).substr($fileName ,-5);
        $destination = "../admin/uploads/".substr($x, 0,6).substr($fileName ,-5);
        $move        = move_uploaded_file($tmpfileName,$destination);

        if($title != '' && $description != '' && $fileName != ''){
            $sql = "INSERT INTO `gallery`(`title`, `image`, `description`) VALUES ('$title','$image','$description')";
            $query = mysqli_query($this->conn, $sql);
            if($query){
                header("Location: ../admin/index.php", true, 301);
            }else{
                echo mysqli_error($this->conn);
            }
        }
    }

    public function excelupload($file)
    {
            $fileName = $file["excel"]["name"];
			$fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));
			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

			$targetDirectory = "uploads/" . $newFileName;
			move_uploaded_file($file['excel']['tmp_name'], $targetDirectory);

			error_reporting(0);
			ini_set('display_errors', 0);

			require 'excelReader/excel_reader2.php';
			require 'excelReader/SpreadsheetReader.php';

			$reader = new SpreadsheetReader($targetDirectory);
			foreach($reader as $key => $row){
				$title = $row[0];
				$description = $row[1];
				$sql = "INSERT INTO `gallery`(`title`, `description`) VALUES ('$title','$description')";
                $query = mysqli_query($this->conn, $sql);
			}

            if($query){
                header("Location: ../admin/index.php", true, 301);
            }else{
                echo mysqli_error($this->conn);
            }
    }

    public function allimage()
    {
        $sql = "SELECT * FROM `gallery`";
        $query = mysqli_query($this->conn, $sql);
        $rows = mysqli_num_rows($query);
        
        return $query;
    }


    public function edit($id)
    {
        $sql = "SELECT * FROM `gallery` WHERE id = '$id'";
        $query = mysqli_query($this->conn, $sql);
        return $query;
    }


    public function update($title, $description, $file, $id)
    {

        $s = "SELECT * FROM `gallery` WHERE id = '$id'";
        $q = mysqli_query($this->conn, $s);

        
        $fileName    = $file['image']['name'];
        $tmpfileName= $file['image']['tmp_name'];
        $x           = uniqid();
        $x           = str_shuffle($x);
        $image       = '../admin/uploads/'.substr($x, 0,6).substr($fileName ,-5);
        $destination = "../admin/uploads/".substr($x, 0,6).substr($fileName ,-5);
        $move        = move_uploaded_file($tmpfileName,$destination);

        if($fileName){
            $sql = "UPDATE `gallery` SET `title`='$title',`image`='$image',`description`='$description' WHERE `id`= '$id'";
        }else{
            $sql = "UPDATE `gallery` SET `title`='$title',`description`='$description' WHERE `id`= '$id'";
        }

        

        $query = mysqli_query($this->conn, $sql);
        if($query){
            header("Location: ../admin/index.php", true, 301);
        }else{
            echo mysqli_error($this->conn);
        }
    }


    public function delete($id)
    {
       $sql = "DELETE FROM `gallery` WHERE `id`='$id'";
       $query = mysqli_query($this->conn, $sql);
       if($query){
        header("Location: ../admin/index.php", true, 301);
        }else{
            echo mysqli_error($this->conn);
        }
    }
}
    $database = new db();
?>
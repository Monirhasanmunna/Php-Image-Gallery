<?php
        include_once '../db.php';
        $db = new db();

        if(isset($_GET['id'])){
            $id = $_GET['id'];
          }

        $datas = $db->delete($id);
    ?>
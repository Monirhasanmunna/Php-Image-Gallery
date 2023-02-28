<?php

require_once 'session.php';

//Handle Add avent ajax request
   if(isset($_FILES['image'])){

       $date        = $_POST['date'];
       $title       = $_POST['title'];
       $description = $_POST['description'];
       $place       = $_POST['place'];
       $address     = $_POST['address'];

       $fileName   = $_FILES['image']['name'];
       $tmpfileName= $_FILES['image']['tmp_name'];

       $x           =uniqid();
       $x           =str_shuffle($x);
       $image       =substr($x, 0,6).substr($fileName ,-5);
       $destination ="../image/".substr($x, 0,6).substr($fileName ,-5);
       $move        = move_uploaded_file($tmpfileName,$destination);

       
       $insert = $cuser->add_new_event($title,$description,$place,$address,$date,$image);
       if($insert){
           
           echo "Data Insert Successfully";
           
           //$_SESSION['message'] = "Data Insert Successfully";
       }
       else{
           echo "Probelem";
       }
   }

   //Display evets ajax request
   if(isset($_POST['action']) && $_POST['action'] =='display_events'){
     $output='';

     $events = $cuser->get_events();

     if($events){

          $output .='<table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Place Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    
          foreach($events as $row){

               if($row['status'] == 1){
                    $row['status']='<span class="badge badge-success">Active</span>';
               }else{
                    $row['status']='<span class="badge badge-danger">Inactive</span>';
               }


               $output .=' <tr>
                         <td>'.$row['id'].'</td>
                         <td>'.$row['date'].'</td>
                         <td>'.$row['title'].'</td>
                         <td>'.$row['description'].'</td>
                         <td>'.$row['place_name'].'</td>
                         <td><img src="assets/image/'.$row['image'].'" width="70px;"></td>
                         
                         <td>'.$row['status'].'</td>
                         <td>
                         
                         <a href="" id="'.$row['id'].'" title="Active" class="btn btn-info btn-sm mb-2 activeBtn"><i class="fa fa-thumbs-up"></i></a>

                         <a href="" id="'.$row['id'].'" title="Deactive" class="btn btn-warning mb-2 btn-sm inactiveBtn"><i class="fa fa-thumbs-down"></i></a>


                         <a href="" id="'.$row['id'].'" class="btn btn-primary mb-2 btn-sm editBtn" data-toggle="modal" data-target="#edit-event-modal"><i class="fa fa-edit"></i></a>
                         <a href="" id="'.$row['id'].'" class="btn btn-danger mb-2 btn-sm deleteBtn"><i class="fa fa-trash"></i></a>
                         </td>
                         </tr>';
          }
          $output .='</tbody></table>';
          echo $output;
     }
   }

   //Handle Edit events of an user Ajax Request
   if(isset($_POST['edit_id'])){
        $id = $_POST['edit_id'];

        $row=$cuser->edit_events($id);
        echo json_encode($row);
   }
   //Handle Update Events Ajax Request
   if(isset($_POST['action']) && $_POST['action'] == 'update_event'){

          $id        = $_POST['id'];
          $date        = $_POST['date'];
          $title       = $_POST['title'];
          $description = $_POST['description'];
          $place       = $_POST['place'];
          $address     = $_POST['address'];

          $update = $cuser->update_event($id,$title,$description,$place,$address,$date);
          if($update){
               echo "Updated";
          }
   }
   //Handle Delete Events Ajax Requset
   if(isset($_POST['del_id'])){
        $id = $_POST['del_id'];

        $delete = $cuser->delete_event($id);
        
   }
   //Handle Active Events Ajax Requset
   if(isset($_POST['active_id'])){

        $id = $_POST['active_id'];

        $delete = $cuser->active_event($id);
        
   }
   //Handle Active Events Ajax Requset
   if(isset($_POST['inactive_id'])){

        $id = $_POST['inactive_id'];

        $delete = $cuser->inactive_event($id);
        
   }

   


   
?>
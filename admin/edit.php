<?php

  include_once '../db.php';
  $db = new db();
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $insert = $db->update($_POST['title'],$_POST['description'], $_FILES, $id);
  }

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-3"></div>
            <div class="col-lg-6">
            <a href="../admin/index.php" class="btn btn-primary float-end mb-3"style='width:150px;'>Show Images</a>
            <br>
            <?php

               $datas = $db->edit($id);
               if($datas){
                while($data = mysqli_fetch_array($datas)){
                    ?>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" value="<?php echo $data['title']?>" id="title" name="title" placeholder="Enter Title Here">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" value="<?php echo $data['image'] ?>" id="image">
                            </div>
                            <img style="width:80px;" src="<?php echo $data['image'] ?>" alt="">
                            <br>

                            <label for="image" class="form-label">Description</label>
                            <div class="form-floating mb-2">
                                <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"><?php echo $data['description']?></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </form>
                    <?php
                }
               }
            ?>
            </div>
        </div>
    </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>
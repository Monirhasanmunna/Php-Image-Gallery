<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>

    <?php
        include_once '../db.php';
        $db = new db();
        $datas = $db->allimage();
    ?>
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
            <a href="../admin/form.php" class="btn btn-primary float-end"style='width:100px;'>Add New</a>
            <br>
            <br>
            <div class="card">
              <div class="card-body">
              <table class="table">
                    <thead>
                      <tr>
                        <th width='10%'>#</th>
                        <th width='30%'>Title</th>
                        <th width='20%'>Photo</th>
                        <th width='30%'>Description</th>
                        <th width='30%'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        while ($data = mysqli_fetch_assoc($datas)){
                      ?>
                        <tr>
                          <th scope="row">1</th>
                          <td><?php echo $data['title'] ?></td>
                          <td><img style="width:50px;height:50px;border-radius:50%;" src="<?php echo $data['image'] ?>" alt=""></td>
                          <td><?php echo $data['description'] ?></td>
                          <td>
                            <a class="btn btn-sm btn-primary" href="../admin/edit.php?id=<?php echo $data['id'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="../admin/delete.php?id=<?php echo $data['id'] ?>">Delete</a>
                          </td>
                        </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
              </div>
            </div>
            </div>
        </div>
    </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>
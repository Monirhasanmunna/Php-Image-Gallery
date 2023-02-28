<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <!-------Font Awesome cdn------>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
  <!-------Data Tables-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css" />
  <title>Admin </title>
</head>

<body>
  <div class="sidebar">
    <div class="sidebar-header">
      <h3 class="Brand m-3">
        <span class="fa fa-tachometer"></span>
        <span>Dashboard</span>
      </h3>
      <span class="ti-menu alt"></span>
    </div>

    <div class="sidebar-menu">
      <ul>
        <li class="nav-link">
          <a href="dashboard.php">
            <span class="fa fa-home"></span>
            <span>Home</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="index.php">
            <span class="fa fa-bars"></span>
            <span>Images</span>
          </a>
        </li>
        <li class="nav-link">
          <a href="form.php">
            <span class="fa fa-plus"></span>
            <span>Add New</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <!----Main Content----->
  <div class="main-content">
    <main>
      <div class="container">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h3>Image List</h3>
            </div>
          <div class="row">
            <div class="col-lg-12 pb-3">
              <a href="../admin/form.php" class="btn btn-primary float-right mr-3 mt-2" style='width:100px;'>Add New</a>
            </div>
          </div>
          <?php
          include_once '../db.php';
          $db = new db();
          $datas = $db->allimage();
          ?>
          <table class="table">
            <thead>
              <tr>
                <th width='10%'>#</th>
                <th width='30%'>Title</th>
                <th width='10%'>Photo</th>
                <th width='30%'>Description</th>
                <th width='15%'>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($data = mysqli_fetch_assoc($datas)){
              ?>
              <tr>
                <th scope="row">1</th>
                <td><?php echo $data['title'] ?></td>
                <td><img style="width:50px;height:50px;border-radius:50%;" src="<?php echo $data['image'] ?>" alt="">
                </td>
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
    </main>
    <!----main---->
  </div>
  <!----Main Content end--->

  <!-- Option 1: Bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <!-------Sweet Alert------>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-----Data Table Js-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
  <!------For add notes---->
</body>

</html>
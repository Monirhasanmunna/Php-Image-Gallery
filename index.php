<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
<head>
    <title>Gallery</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <!----Bootstrap Css--->
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <!-------Font Awesome cdn------>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<body>
    <!-------Nav------>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Gallery</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <!-- <a class="nav-link text-white" href="admin/dashboard.php" target="__blank">Dashboard</a> -->

            <a class="btn btn-danger" href="admin/dashboard.php" target="_blank">Dashboard</a>
        </li>
        </li>
        </ul>
    </div>
    </nav>
<?php
  include_once 'db.php';

  $db = new db();
  $image = $db->allimage();
?>
<section class="events" style="padding-bottom:100px;">
<div class="container-fluid">
    <div class="row">
        <h1 class="text-center col-md-12 events-header">Gallery</h1>
        <?php 
          while($data = mysqli_fetch_assoc($image)){
        ?>
        <div class="col-lg-3 mb-3">
            <div class="card" style="width: 22rem;">
              <img class="card-img-top img-fluid" style="width:100%;height:250px;"  src="<?php echo $data['image'] ?>" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?php echo $data['title'] ?></h5>
                <p class="card-text"><?php echo $data['description'] ?></p>
              </div>
            </div>
        </div>
        <?php 
        }
        ?>

        <?php 
            if($data = mysqli_num_rows($image) < 1){
        ?>
            <div class="message" style="width:100%;">
                <h4 class="text-center">No Picture Found.</h4>
            </div>
        <?php
            }
        ?>
    </div>    
</div>
</section>
<!------Jquery--->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!----Bootstrap js------->
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>
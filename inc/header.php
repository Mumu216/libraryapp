<!-- inc/header.php -->
<?php
  ob_start();
  session_start();
 include "admin/inc/db.php"; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome Icons -->
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
 
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

     <!-- JQuery Library File-->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 
 
    <!-- jquery ui -->
 
    <link rel="stylesheet" href="/code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <!-- custom css -->
    <!-- <link rel="stylesheet" href="assets/css/all.min.css"> -->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Library Management System</title>
  </head>
 
 
 
  <body>
    <!-- header start -->
    <header>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">online <span>library</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

                  <!-- Main menu start-->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
 
        <?php
        $sql = "SELECT cat_id AS 'pCatID', cat_name AS 'pCatName' FROM category WHERE is_parent = 0 AND status = 1 ORDER BY cat_name ASC";
        $parentMenu = mysqli_query($db, $sql);
 
        while ($row = mysqli_fetch_assoc($parentMenu)) {
          extract($row);
 
          $subcat = "SELECT cat_id AS 'cCatID', cat_name AS 'cCatName' FROM category WHERE is_parent = 'pCatID' AND status = 1 ORDER BY cat_name ASC";
 
          $subMenu = mysqli_query($db, $subcat);
          $countMenu= mysqli_num_rows($subMenu);
 
          if ( $countMenu == 0) {
            ?>
 
         <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="category.php?category=<?php echo $pCatName; ?>&catid=<?php echo $pCatId ?>"><?php echo $pCatName; ?> </a>
         </li>
 
          <?php
          }else{
            ?>
 
 
            <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="category.php?category=<?php echo $pCatName;  ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $pCatName;  ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php 
 
            while ($row = mysqli_fetch_assoc($subMenu)) {
              extract($row);
              ?>
 
              <li><a class="dropdown-item"  href="category.php?category=<?php echo $cCatName; ?>&subcatid=<?php echo $cCatId; ?>"><?php echo $cCatName; ?></a></li>
 
              <?php
            }
 
            ?>
 
 
          </ul>
        </li>
 
      <?php
          }

        }



 
 
        

 
        if (empty($_SESSION['email']) || empty($_SESSION['user_id']) ) {
         ?>
         <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="login.php"> SignIn </a>
         </li>
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="register.php"> SignUp </a>
         </li>
 
 
         <?php
        }else{ ?>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="category.php?do=<?php echo $pCatName;  ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <?php 
            $user_id =$_SESSION['user_id'];
            $query="SELECT * FROM users WHERE user_id ='$user_id'";
            $userName =mysqli_query($db, $query);
            while ($row=mysqli_fetch_assoc($userName)) {
 
              $fullname= $row['fullname'];
              // $id= $row['id'];
              $image =$row['image'];
                    if(!empty($image)){
                      ?>
                      <img src="admin/dist/img/users/<?php echo $image ;?>" class="img-circle elevation-2" alt="User Image">
                      <?php echo $fullname; 
 
                    }else{
                      ?>
                      <img src="admin/dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
                      <?php echo $fullname;
 
                    }
            }
 
            ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item"  href="order-history.php" > Booking Item List </a></li>
            <li><a class="dropdown-item"  href="manage_profile.php?do=<?php echo $user_id; ?>" > Manage Profile </a></li>
            <li><a class="dropdown-item"  href="logout.php" > LogOut </a></li>
 
 
          </ul>
        </li>
 
          <?php
 
 
        }
 
        ?>
 
      </ul>
 
    </div>
  </div>
</nav>
</div>
</div>
</div>
</header>  
     <!-- header end -->
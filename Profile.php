<?php
  require_once('includes/db.php');
  require_once('includes/functions.php');
  require_once('includes/sessions.php');
?>

<?php
  $SearchQueryParameter = $_GET['username'];
  $sql = "SELECT aname,aheadline,abio,aimage FROM admins WHERE username=:userName";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':userName',$SearchQueryParameter);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if($Result==1){
      while($DataRows=$stmt->fetch()){
          $ExistingName = $DataRows["aname"];
          $ExistingBio = $DataRows["abio"];
          $ExistingImage = $DataRows["aimage"];
          $ExistingHeadline = $DataRows["aheadline"];
      }
  }
  else {
    $_SESSION["ErrorMessage"]="Bad Request !!";
    Redirect_to("blog.php?page=1");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome css -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Css style sheet -->
    <link rel="stylesheet" href="css/style.css">
    <title>Impulse Author Profile</title>
</head>
<body>
  <!-- Navigation Bar for the Website -->
  <!-- <div style="height:10px; background:#27aae1;"></div> -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand">IMPULSE</a>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarcollapseCMS" aria-controls="navbarcollapseCMS" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
        <!-- Navlinks Section -->
        <ul class="navbar-nav mr-auto">
         
          <li class="nav-item">
            <a href="blog.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">About Us</a>
          </li>
          <li class="nav-item">
            <a href="blog.php" class="nav-link">Blog</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Contact Us</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Features</a>
          </li>
        </ul>

        <!-- Right Section in Nav -->
        <ul class="navbar-nav ms-auto">
          <form class="form-inline d-none d-sm-block " action="blog.php">
              <div class="form-group custom_inline">
                <input class="form-control mr-4 custom_pad" type="text" name="Search" placeholder="Search here">
                <button name="SearchButton" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
                
              </div>
              
          </form>
        </ul>
        
      </div>

    </div>
  </nav>
  <div style="height:10px; background:#27aae1;"></div>

  <!-- Header Section for Impulse Website -->

  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fas fa-user text-success mr-2" style="color:#27aae1;"></i> <?php echo $ExistingName;?></h1>
          <h3><?php echo $ExistingHeadline;?></h3>
        </div>
      </div>
    </div>
  </header>

  <section class="container py-2 mb-4">
      <div class="row">
          <div class="col-md-3">
              <img class="d-block img-fluid mb-3 rounded-circle" src="images/<?php echo $ExistingImage;?>" alt="">
          </div>
          <div class="col-md-9" style="min-height:420px;">
              <div class="card">
                  <div class="card-body">
                      <p class="lead"><?php echo $ExistingBio;?></p>
                  </div>
              </div>
          </div>
      </div>
  </section>


  <!-- Footer Section for the Impulse Website -->

  <footer class="bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col">
          <p class="lead text-center">&copy;<span id="year"></span> Copyrights ----All rights Reserved.</p>
          <p class="text-center small">This Site is developed by Impulse Team for the Official Magazine of SEEE</p>
        </div>
      </div>
    </div>
  </footer>






<!---------------------------------------XXXXXXXXX ---------------------------------------------------- -->

   <!-- Jquery js -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> 
   <!-- Popper js -->
   <script src="./js/popper.min.js"></script>
   <!-- Bootstrap js -->
   <script src="./js/bootstrap.min.js"></script>
   <!-- Font Awesome js -->
   <script src="./js/all.min.js"></script>

  
  <script>
    // Using Jquery module for getting year
    $('#year').text(new Date().getFullYear());
  </script>
   

</body>
</html>
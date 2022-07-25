<?php
  require_once('includes/db.php');
  require_once('includes/functions.php');
  require_once('includes/sessions.php');
?>

<?php 
  
  $_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
  Confirm_Login();
  
?>

<?php
  $AdminId = $_SESSION["UserId"];
  $sql = "SELECT * FROM admins WHERE id=$AdminId";
  $stmt = $conn->query($sql);
  while($DataRows = $stmt->fetch()){
      $ExistingName = $DataRows['aname'];
      $ExistingUserName = $DataRows['username'];
      $ExistingHeadline = $DataRows['aheadline'];
      $ExistingBio = $DataRows['abio'];
      $ExistingImage = $DataRows['aimage'];

  }

  if(isset($_POST['Submit'])){
    $AName= $_POST["Name"];
    $AHeadline = $_POST["Headline"];
    $ABio = $_POST["Bio"];

    $Image = $_FILES["Image"]["name"];
    $Target = "images/".basename($_FILES["Image"]["name"]);

    if (strlen($AHeadline)>30){
      $_SESSION["ErrorMessage"] = "Headline should be less than 30 characters";
      Redirect_to("myprofile.php");
    }
    elseif (strlen($ABio)>500){
      $_SESSION["ErrorMessage"] = "Bio should be less than 500 characters";
      Redirect_to("myprofile.php");
    }
    else{
        // Query to Admin Bio in Impulse Database
        // Values containing dummy variable with a colan :
        // Our posts table is laid in the mysql database

        if(!empty($Image)){
            $sql = "UPDATE admins SET aname='$AName', aheadline='$AHeadline',abio='$ABio', aimage='$Image' WHERE id=$AdminId";
        }
        else{
            $sql = "UPDATE admins SET aname='$AName', aheadline='$AHeadline',abio='$ABio' WHERE id=$AdminId";
        }
        
        $Execute = $conn->query($sql);
        
        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

        if($Execute){
            // Message with the id alerting functionality...
            $_SESSION["SuccessMessage"] = "Hey!! 🤩 Impulse Admin, your Details updated Succesfully";
            Redirect_to("myprofile.php");
        }
        else{
            $_SESSION["ErrorMessage"] = "Something Went wrong. Try Again !";
            Redirect_to("myprofile.php");
        }
    }

    
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
    <title>My Profile</title>
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
            <a href="myprofile.php" class="nav-link"> <i class="fas fa-user text-success"></i> My Profile</a>
          </li>
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="posts.php" class="nav-link">Posts</a>
          </li>
          <li class="nav-item">
            <a href="Categories.php" class="nav-link">Categories</a>
          </li>
          <li class="nav-item">
            <a href="admin.php" class="nav-link">Manage Admins</a>
          </li>
          <li class="nav-item">
            <a href="comments.php" class="nav-link">Comments</a>
          </li>
          <li class="nav-item">
            <a href="blog.php?page=1" class="nav-link" target="_blank">Live Blog</a>
          </li>
        </ul>

        <!-- Logout Section in Nav -->
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a href="logout.php" class="nav-link text-danger"><i class="fas fa-user-times"></i> Logout</a>
          </li>
        </ul>
      </div>

    </div>
  </nav>
  <div style="height:10px; background:#27aae1;"></div>

  <!-- Header Section for Impulse Website -->

  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fas fa-user mr-2" style="color:#27aae1;"></i> <?php echo $ExistingUserName;?></h1>
          <small style="font-size:1rem;" class="lead"><?php echo $ExistingHeadline; ?></small>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Section of Site -->

  <section class="container py-2 mb-4">
      <div class="row">
        <!-- Left Area -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h3><?php echo $ExistingName;?></h3>
                </div>
                <div class="card-body">
                    <img src="images/<?php echo $ExistingImage;?>" class="block img-fluid mb-3" alt="profile pic">
                </div>
                <div class="">
                    <?php echo $ExistingBio?>
                </div>
            </div>
        </div>

        <!-- Right Area -->
        <div class="col-md-9" style="min-height:400px;">
            <?php 
              echo ErrorMessage();
              echo SuccessMessage();
            ?>
            <form action="myprofile.php" method="post" enctype="multipart/form-data">
                <div class="card bg-dark text-light">
                    <div class="card-header bg-secondary text-light">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">      <!--form body-->
                        
                        <div class="form-group mb-4"> <!--form input group-->
                            <!-- Input Field for the Category Section with name Title -->
                            <input class="form-control" type="text" name="Name"  placeholder="Your Name here">
                            
                        </div>

                        <div class="form-group mb-4"> <!--form input group-->
                            <!-- Input Field for the Category Section with name Title -->
                            <input class="form-control" type="text" name="Headline" placeholder="Headline">
                            <small class="muted"> Add a Handsome Headline like 'Designer at Impulse' or 'Creator at Impulse'</small>
                            <span class="text-danger">Not more than 30 characters</span>
                        </div>

                        <!-- The textarea for the Posts to add -->
                        <div class="form-group mb-2">
                          <textarea class="form-control" name="Bio" id="Post" cols="30" rows="10" placeholder="Enter your Bio here.."></textarea>
                        </div>
                        

                        <!-- Image selection field for input -->
                        <div class="form-group ">
                          <div class="custom-file">
                            <label for="imageSelect"><span class="FieldInfo">Choose a Pic</span></label>
                            <input class="form-control" type="file" name="Image" id="imageSelect" value="">
                          </div>
                        </div>
                        

                        <div class="row pt-3">
                            <div class="col-lg-6 mb-2">
                              <!-- Back to Dashboard Button on a anchor tag with class btn -->
                                <a href="Dashboard.php" class="btn btn-primary w-100"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                            </div>
                            <div class="col-lg-6 mb-2">
                              <!-- Publish button with name submit where the Category entered gets published -->
                                <button type="submit" name="Submit" class="btn btn-success w-100"><i class="fas fa-check"></i> Publish</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
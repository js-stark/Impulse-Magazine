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
  if(isset($_POST['Submit'])){
    $UserName = $_POST["Username"];
    $Name = $_POST["Name"];
    $Password = $_POST["Password"];
    $ConfirmPassword = $_POST["ConfirmPassword"];
    $Admin = $_SESSION["UserName"];
    date_default_timezone_set("Asia/calcutta");
    $DateTime = strftime("%B-%d-%Y-%H:%M:%S",time());
  
    if(empty($UserName) || empty($Password) || empty($ConfirmPassword)){
      $_SESSION["ErrorMessage"] = "All Fields must be filled";
      Redirect_to("admin.php");
    }
    elseif (strlen($Password)<4){
      $_SESSION["ErrorMessage"] = "Password should be more than 4 characters";
      Redirect_to("admin.php");
    }
    elseif ($Password !== $ConfirmPassword){
      $_SESSION["ErrorMessage"] = "Password and Confirm Password should match";
      Redirect_to("admin.php");
    }
    elseif (CheckUserNameExits($UserName)){
      $_SESSION["ErrorMessage"] = "Username {$UserName} already exists. Try Another one..";
      Redirect_to("admin.php");
    }

    else{
      // Query to insert the New Admin into the Impulse Database
      // Values containing dummy variable with a colan :
      // Our category table is laid in the mysql database
      $sql = "INSERT INTO admins(datetime,username,password,aname,addedby) VALUES(:dateTime,:userName,:password,:aName,:adminName)"; 
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':dateTime',$DateTime);
      $stmt->bindValue(':userName',$UserName);
      $stmt->bindValue(':password',$Password);
      $stmt->bindValue(':aName',$Name);
      $stmt->bindValue(':adminName',$Admin);

      $Execute = $stmt->execute();

      if($Execute){
        // Message with the id alerting functionality...
        $_SESSION["SuccessMessage"] = "New Admin with name {$Name} Added Succesfully";
        Redirect_to("admin.php");
      }
      else{
        $_SESSION["ErrorMessage"] = "Something Went wrong. Try Again !";
        Redirect_to("admin.php");
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
    <title>Admin Page</title>
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
          <h1><i class="fas fa-user" style="color:#27aae1;"></i> Manage Admins</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Section of Site -->

  <section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
            <?php 
              echo ErrorMessage();
              echo SuccessMessage();
            ?>
            <form action="admin.php" method="post">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-header">    <!--form header -->
                        <h1>Add New Admin</h1>
                    </div>
                    <div class="card-body bg-dark">      <!--form body-->
                        <div class="form-group"> <!--form input group-->
                            <label  for="Username"><span class="FieldInfo"> Username </span></label>
                            <!-- Input Field for the Category Section with name Title -->
                            <input class="form-control" type="text" name="Username" id="Username" placeholder="Enter Your Username">
                        </div>
                        <div class="form-group"> <!--form input group-->
                            <label  for="Name"><span class="FieldInfo"> Name </span></label>
                            <!-- Input Field for the Category Section with name Title -->
                            <input class="form-control" type="text" name="Name" id="Name" placeholder="Enter Your Name">
                            <small class="text-warning text-muted">*Optional</small>
                        </div>
                        <div class="form-group"> <!--form input group-->
                            <label  for="Password"><span class="FieldInfo"> Password </span></label>
                            <!-- Input Field for the Category Section with name Title -->
                            <input class="form-control" type="password" name="Password" id="Password" placeholder="Enter Your Password">
                        </div>
                        <div class="form-group"> <!--form input group-->
                            <label  for="ConfirmPassword"><span class="FieldInfo"> Confirm Password </span></label>
                            <!-- Input Field for the Category Section with name Title -->
                            <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Re-Enter Your Password">
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
            <h2>Existing Admins</h2>
            <table class="table table-stripped table-hover">
                <thead class="thead-light text-light bg-dark">
                    <th>No. </th>
                    <th>Date&Time</th>
                    <th>Username </th>
                    <th>Admin Name</th>
                    <th>Added by</th>
                    <th>Action</th>
                </thead>
          
                <?php
                    global $conn; 
                    $sql = "SELECT * FROM admins ORDER BY id desc";
                    $stmt = $conn->query($sql);
                    $stmt->execute();
                    $i = 0;
                    while($DataRows=$stmt->fetch()){
                        $AdminId = $DataRows["id"];
                        $DateTime = $DataRows["datetime"];
                        $AdminUsername = $DataRows["username"];
                        $AdminName= $DataRows["aname"];
                        $AddedBy= $DataRows["addedby"];
                        $i++;  
                ?>
                <tbody>
                    <tr>
                        <td><?php echo htmlentities($i);?></td>
                        <td><?php echo htmlentities($DateTime);?></td>
                        <td><?php echo htmlentities($AdminUsername);?></td>
                        <td><?php echo htmlentities($AdminName);?></td>
                        <td><?php echo htmlentities($AddedBy);?></td>
                        <td><a class="btn btn-danger" href="DeleteAdmin.php?id=<?php echo $AdminId?>">Delete</a></td>
                        
                    </tr>
                </tbody>

                <?php }; ?>

            </table>
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
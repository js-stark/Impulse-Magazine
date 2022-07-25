<?php
  require_once('includes/db.php');
  require_once('includes/functions.php');
  require_once('includes/sessions.php');
?>

<?php
    if(isset($_SESSION["UserId"])){
      Redirect_to("dashboard.php");
    }


    if(isset($_POST['Submit'])){
        $UserName = $_POST["Username"];
        $Password = $_POST["Password"];
        if(empty($UserName)|| empty($Password)){
            $_SESSION["ErrorMessage"] = "All fields must be filled out";
            Redirect_to("Login.php");
        }
        else{
           $Found_Account =  Login_Attempt($UserName,$Password);
           if($Found_Account){
               $_SESSION["UserId"] = $Found_Account["id"];
               $_SESSION["UserName"] = $Found_Account["username"];
               $_SESSION["AdminName"] = $Found_Account["aname"];

               $_SESSION["SuccessMessage"] = "Welcome ".$_SESSION["AdminName"];
               if(isset($_SESSION["TrackingURL"])){
                Redirect_to($_SESSION["TrackingURL"]);
               }
               else{
                Redirect_to("dashboard.php");
               }   
           }
           else{
            $_SESSION["ErrorMessage"] = "Incorrect Username/Password";
            Redirect_to("login.php");
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
    <title>Login</title>
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

      </div>

    </div>
  </nav>
  <div style="height:10px; background:#27aae1;"></div>

  <!-- Header Section for Impulse Website -->

  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        </div>
      </div>
    </div>
  </header><br>

  <!-- Main Area of the Login Page -->
  <section class="container py-2 mb-4">
      <div class="row">
          <div class=" offset-sm-3 col-sm-6" style="min-height:480px;">
          <?php
            echo ErrorMessage();
            echo SuccessMessage();
           ?>
            <div class="card text-dark">
                <div class="card-header">
                    <h4>Welcome Back</h4>
                </div>
                <div class="card-body bg-dark">
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label text-light">Username</label>
                        <input type="text" name="Username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label text-light">Password</label>
                        <input type="password" name="Password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <input name="Submit" type="submit" class="btn btn-primary" value="Login"></input>
                </form>
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
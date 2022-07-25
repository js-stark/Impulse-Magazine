<?php
  require_once('includes/db.php');
  require_once('includes/functions.php');
  require_once('includes/sessions.php');
?>

<?php 
  
  $_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
  Confirm_Login();
  
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
    <title>Document</title>
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
          <h1><i class="fas fa-comments" style="color:#27aae1;"></i> Manage Comments</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Sections of Comments Management of Impulse by JS😋 -->
    <section class="container py-2 mb-4">
        <div class="row" style="min-height:30px;">
            <div class="col-lg-12" style="min-height:470px;">
                <?php 
                    echo ErrorMessage();
                    echo SuccessMessage();
                ?>
                <h2>Un-Approved Comments</h2>
                <table class="table table-stripped table-hover">
                    <thead class="thead-light text-light bg-dark">
                        <th>No. </th>
                        <th>Date&Time</th>
                        <th>Name </th>
                        <th>Comment</th>
                        <th>Approve</th>
                        <th>Action</th>
                        <th>Details</th>
                    </thead>
                

                
                    <?php
                        global $conn; 
                        $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
                        $stmt = $conn->query($sql);
                        $stmt->execute();
                        $i = 0;
                        while($DataRows=$stmt->fetch()){
                            $CommentId = $DataRows["id"];
                            $DateTime = $DataRows["datetime"];
                            $CommenterName = $DataRows["name"];
                            $CommentContent = $DataRows["comment"];
                            $commentPostId = $DataRows["post_id"];
                            $i++;  
                        
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo htmlentities($i);?></td>
                            <td><?php echo htmlentities($DateTime);?></td>
                            <td><?php echo htmlentities($CommenterName);?></td>
                            <td><?php echo htmlentities($CommentContent);?></td>
                            <td><a class="btn btn-primary" href="ApproveComments.php?id=<?php echo $CommentId;?>">Approve</a></td>
                            <td><a class="btn btn-danger" href="DeleteComments.php?id=<?php echo $CommentId?>">Delete</a></td>
                            <td><a style="min-width:120px;" class="btn btn-success" href="FullPost.php?id=<?php echo $commentPostId?>">Live Preview</a></td>
                        </tr>
                    </tbody>

                    <?php }; ?>

                </table>
                <h2>Approved Comments</h2>
                <table class="table table-stripped table-hover">
                    <thead class="thead-light text-light bg-dark">
                        <th>No. </th>
                        <th>Date&Time</th>
                        <th>Name </th>
                        <th>Comment</th>
                        <th>Revert</th>
                        <th>Action</th>
                        <th>Details</th>
                    </thead>
                

                
                    <?php
                        global $conn; 
                        $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
                        $stmt = $conn->query($sql);
                        $stmt->execute();
                        $i = 0;
                        while($DataRows=$stmt->fetch()){
                            $CommentId = $DataRows["id"];
                            $DateTime = $DataRows["datetime"];
                            $CommenterName = $DataRows["name"];
                            $CommentContent = $DataRows["comment"];
                            $commentPostId = $DataRows["post_id"];
                            $i++;  
                        
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo htmlentities($i);?></td>
                            <td><?php echo htmlentities($DateTime);?></td>
                            <td><?php echo htmlentities($CommenterName);?></td>
                            <td><?php echo htmlentities($CommentContent);?></td>
                            <td><a class="btn btn-warning" href="DisApproveComments.php?id=<?php echo $CommentId;?>">DisApprove</a></td>
                            <td><a class="btn btn-danger" href="DeleteComments.php?id=<?php echo $CommentId?>">Delete</a></td>
                            <td><a style="min-width:120px;" class="btn btn-success" href="FullPost.php?id=<?php echo $commentPostId?>">Live Preview</a></td>
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
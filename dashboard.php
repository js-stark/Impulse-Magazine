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
    <title>Dashboard</title>
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
        <div class="col-md-12 mb-2">
          <h1><i class="fas fa-cog" style="color:#27aae1;"></i> Dashboard</h1>
        </div>
        <div class="col-lg-3 mb-2">
            <a href="addposts.php" class="btn btn-primary w-100">
                <i class="fas fa-edit"></i> Add New Post
            </a>
        </div>
        <div class="col-lg-3 mb-2">
            <a href="Categories.php" class="btn btn-info w-100">
                <i class="fas fa-folder-plus"></i> Add New Category
            </a>
        </div>
        <div class="col-lg-3 mb-2">
            <a href="admin.php" class="btn btn-warning w-100">
                <i class="fas fa-user-plus"></i> Add New Admin
            </a>
        </div>
        <div class="col-lg-3 mb-2">
            <a href="Comments.php" class="btn btn-success w-100">
                <i class="fas fa-check"></i> Approve Comments
            </a>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Section of the Posts  -->

  <section class="container py-2 mb-4">
      <div class="row">
            <?php 
                echo ErrorMessage();
                echo SuccessMessage();
            ?>
          <div class="col-lg-2 d-none d-sm-block">
            <!-- Left Section of Dashboard with 2 Bootstrap columns for Impulse  -->
            <div class="card text-centre bg-dark text-white mb-3">
                <div class="card-body">
                    <h1 class="lead">Posts</h1>
                    <h4 class="display-5">
                        <i class="fab fa-readme"></i>
                        <?php echo TotalPosts();?>
                    </h4>
                </div>
            </div>
            <div class="card text-centre bg-dark text-white mb-3">
                <div class="card-body">
                    <h1 class="lead">Categories</h1>
                    <h4 class="display-5">
                        <i class="fas fa-folder"></i>
                        <?php echo TotalCategories();?>
                    </h4>
                </div>
            </div>
            <div class="card text-centre bg-dark text-white mb-3">
                <div class="card-body">
                    <h1 class="lead">Admins</h1>
                    <h4 class="display-5">
                        <i class="fas fa-users"></i>
                        <?php echo TotalAdmin();?>
                    </h4>
                </div>
            </div>
            <div class="card text-centre bg-dark text-white mb-3">
                <div class="card-body">
                    <h1 class="lead">Comments</h1>
                    <h4 class="display-5">
                        <i class="fas fa-comments"></i>
                        <?php echo TotalComments();?>
                    </h4>
                </div>
            </div>
          </div>
          <div class="col-lg-10">
              <!-- Right Section of Dashboard with 10 Bootstrap columns for Impulse  -->
              <h1>Top Posts</h1>
              <table class="table table-stripped table-hover">
                  <thead class="thead-dark">
                      <tr>
                          <th>No.</th>
                          <th>Title</th>
                          <th>Date&Time</th>
                          <th>Author</th>
                          <th>Comments</th>
                          <th>Details</th>
                      </tr>
                  </thead>
                  
                  <?php
                    $i = 0;
                    global $conn;
                    $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,6";
                    $stmt=$conn->query($sql);
                    while ($DataRows=$stmt->fetch()) {
                    $PostId = $DataRows["id"];
                    $DateTime = $DataRows["datetime"];
                    $Author  = $DataRows["author"];
                    $Title = $DataRows["title"];
                    $i++;
                 ?>
                  <tbody>
                      <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $Title; ?></td>
                          <td><?php echo $DateTime; ?></td>
                          <td><?php echo $Author; ?></td>
                          <td>
                              
                                <?php
                                    $sqlApprove="SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='ON'";
                                    $stmtApprove=$conn->query($sqlApprove);
                                    $RowsTotal = $stmtApprove->fetch();
                                    $Total = array_shift($RowsTotal);
                                    if($Total>0){ ?>
                                <span class="badge bg-success">
                                    <?php echo $Total;?>
                                </span>
                                <?php };?>
                              
                              
                                <?php
                                    $sqlDisApprove="SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='OFF'";
                                    $stmtDisApprove=$conn->query($sqlDisApprove);
                                    $RowsTotal = $stmtDisApprove->fetch();
                                    $Total = array_shift($RowsTotal);
                                    if($Total > 0){
                                ?>
                                <span class="badge bg-danger">
                                    <?php echo $Total; ?>
                                </span>
                                <?php }; ?>
                                    
                              
                          </td> 
                          <td> 
                              <a target="_blank" href="FullPost.php?id=<?php echo $PostId; ?>">
                                <span class="btn btn-info">Preview</span>
                              </a>
                          </td>
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
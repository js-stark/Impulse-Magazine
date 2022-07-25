<?php
  require_once('includes/db.php');
  require_once('includes/functions.php');
  require_once('includes/sessions.php');
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
    <title>Impulse Blogs</title>
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
            <a href="blog.php?page=1" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="aboutus.php" class="nav-link">About Us</a>
          </li>
          <li class="nav-item">
            <a href="blog.php?page=1" class="nav-link">Blog</a>
          </li>
          <li class="nav-item">
            <a href="magazine.php" class="nav-link">Magazine</a>
          </li>
          <li class="nav-item">
            <a href="contact/contact.php" class="nav-link">Contact Us</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Features</a>
          </li>
          <li class="nav-item">
            <a href="login.php" class="nav-link">Admin</a>
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


  <div class="animcont">
    
    <div class="main">
      <div class="update">
        <h2 data-text="Please Check out our Latest Magazine Launch for the year 2021...">Please Check out our Latest Magazine Launch for the year 2021...</h2>
      </div>
      
      <div class="box1"></div>

      <div class="box2">
        <div class="text">
          IMPULSE<br><span class="mag" style="color:#27aae1">MAGAZINE<span>
        </div>
      </div>
    
    </div>

  </div>

  

  <div class="container">
  <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
      <div class="row mt-4" style="min-height:300px;">
          <div class="col-sm-8">
              <h1>The Next Wave Of Triggering Ideas</h1>
              <h1 class="lead">The Official Magazine of SEEE</h1>
              <?php
              echo ErrorMessage();
              echo SuccessMessage();
              ?>
              <?php
              // Search query php codes of the Impulse blog
                if(isset($_GET["SearchButton"])){
                    $Search = $_GET["Search"];
                    $sql = "SELECT * FROM posts WHERE datetime LIKE :search OR title LIKE :search OR category LIKE :search OR post like :search OR author LIKE :search";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':search','%'.$Search.'%');
                    $stmt->execute();
                }
                // Navigating to Different Pages in the blogs pages
                elseif(isset($_GET["page"])){
                  $Page = $_GET["page"];
                  if($Page==0||$Page<1){
                    $ShowPostFrom=0;
                  }
                  else{
                    $ShowPostFrom = ($Page*5)-5;
                  }
                  $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,5";
                  $stmt=$conn->query($sql);
            
                }
                // Query when the category pages are active
                elseif(isset($_GET["category"])){
                  $Category = $_GET["category"];
                  $sql = "SELECT * FROM posts WHERE category=:categoryName ORDER BY id desc ";
                  $stmt = $conn->prepare($sql);
                  $stmt->bindValue(':categoryName',$Category);
                  $stmt->execute();

                }
                else{
                    $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,4";
                    $stmt = $conn->query($sql);
                }
                   
                while($DataRows = $stmt->fetch()){
                    $PostId = $DataRows["id"];
                    $DateTime = $DataRows["datetime"];
                    $PostTitle = $DataRows["title"];
                    $Category = $DataRows["category"];
                    $Admin = $DataRows["author"];
                    $Image = $DataRows["image"];
                    $PostDescription = $DataRows["post"];
                
              ?>
              <div class="card mb-4">
                  <img class="img-fluid card-top blog_img" src="uploads/<?php echo htmlentities($Image);?>" alt="Blog-image">
                  <div class="card-body">
                      <h4 class="card-title"><?php echo htmlentities($PostTitle);?></h4>
                      <h6 style="font-size:1.1rem;" class="lead text-muted"><a href="blog.php?category=<?php echo htmlentities($Category); ?>"><?php echo htmlentities($Category); ?></a></h6>
                      <!-- My Handcrafted section for the display of Legacy Authors and Admins -->
                      <?php 

                        $sqlAuthor="SELECT COUNT(*) FROM admins WHERE username='$Admin'";
                        $stmtAuthor=$conn->query($sqlAuthor);
                        $RowsTotalAuthor = $stmtAuthor->fetch();
                        $TotalAuthor = array_shift($RowsTotalAuthor);                                               
                        if($TotalAuthor>0){ ?>
                            <small class="text-muted">Written by <a href="Profile.php?username=<?php echo htmlentities($Admin);?>"><?php echo htmlentities($Admin);?></a> On <?php echo htmlentities($DateTime);?></small>
                       <?php } else{ ?>
                        <small class="text-muted">Written by <a href="#"><?php echo htmlentities($Admin);?></a> On <?php echo htmlentities($DateTime);?></small>

                        <?php }?>
                      

                      <?php
                          $sqlApprove="SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='ON'";
                          $stmtApprove=$conn->query($sqlApprove);
                          $RowsTotal = $stmtApprove->fetch();
                          $Total = array_shift($RowsTotal);
                          if($Total>0){ ?>
                      <span class="badge bg-primary" style="float:right;">
                         Comments <?php echo $Total;?>
                      </span>
                      <?php };?>
  
                      <hr>
                      <p class="card-text">
                          <?php 
                            if(strlen($PostDescription)>200){
                                $PostDescription = substr($PostDescription,0,199)."...";
                                echo htmlentities($PostDescription);
                            }
                          ?>
                      </p>
                      <a href="FullPost.php?id=<?php echo $PostId;?>" style="float:right">
                        <span class="btn btn-primary">Read More >> </span>
                      </a>
                  </div>
              </div>
              <?php } ?>
              <!-- Pagination Algorithm to navigate to different pages in the Impulse Blog by JS 😁😂 -->
              <nav>
                <ul class="pagination pagination-lg">
                  <!-- Backward Button for pagination -->
                  <?php if(isset($Page) && !empty($Page)){ 
                       
                    if($Page>1){

                    ?>
                    <li class="page-item ">
                      <a class="page-link" href="blog.php?page=<?php echo $Page-1; ?>">&laquo;</a>
                    </li>
                  <?php } };?>

                  <?php
                    $sql = "SELECT COUNT(*) FROM posts";
                    $stmt = $conn->query($sql);
                    $RowPagination = $stmt->fetch();
                    $TotalPosts = array_shift($RowPagination);
                    
                    $PostPagination = $TotalPosts/5;
                    $PostPagination = ceil($PostPagination);
                    for($i=1; $i<=$PostPagination; $i++){
                      if(isset($Page)){
                        if($i==$Page){ ?>
                          <li class="page-item active">
                            <a class="page-link" href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                          </li>
                        <?php }
                        
                        else{ ?>
                          <li class="page-item ">
                            <a class="page-link" href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                          </li>

                      <?php  }

                     } }; ?>
                     <!-- Creating Forward Buttons for Pagination -->
                     <?php if(isset($Page) && !empty($Page)){ 
                       
                       if($Page+1<=$PostPagination){

                       ?>
                        <li class="page-item ">
                          <a class="page-link" href="blog.php?page=<?php echo $Page+1; ?>">&raquo;</a>
                        </li>
                      <?php } };?>

                </ul>
              </nav>
          </div>
          
          <!-- Impulse Blog Side Area -->
          <div class="col-sm-4">

            <!-- The Area for displaying advertisements -->
            <div class="card mt-4">
              <div class="card-body">
                <img src="images/add1.jpg" class="sideimg d-block img-fluid mb-3" alt="side img-blog">
                <div class="mx-2">
                       suscipit consequuntur repellat optio, reiciendis quibusdam perspiciatis nostrum. Numquam dignissimos recusandae, voluptatum nostrum perferendis iste provident voluptates rem quam cumque quaerat iure est sequi quod voluptate quae voluptas ipsam praesentium voluptatem esse beatae odit! Quo quos molestias nam! Ipsa, atque dolorem!
                </div>
              </div>
              
            </div><br><br><br>

            <!-- The Area for signing in and email subscription -->
            <div class="card">
              <div class="card-header bg-dark text-light">
                <h2 class="lead">Sign Up!</h2>
              </div>

              <div class="card-body">
                <button class="form-control btn btn-primary btn-block text-center text-white mb-2" name="button" type="submit">Join the forum</button>
                <button class=" form-control btn btn-danger btn-block text-center text-white mb-2" name="button" type="submit">Login</button>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text pb-2">We'll never share your email with anyone else.</div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </div><br><br>

            

            <!-- The Area for Displaying Categories  -->
            <div class="card">
              <div class="card-header bg-info text-light">
                <h2 class="lead">Categories</h2>
                </div>
                <div class="card-body">
                  <?php
                  $sql = "SELECT * FROM category ORDER BY id desc LIMIT 0,6";
                  $stmt = $conn->query($sql);
                  while ($DataRows = $stmt->fetch()) {
                    $CategoryId = $DataRows["id"];
                    $CategoryName=$DataRows["title"];
                  ?>
                  <button class=" form-control btn btn-block text-center text-white mb-2" name="button" type="botton">
                  <a href="blog.php?category=<?php echo htmlentities($CategoryName); ?>"> <span class="lead"> <?php echo $CategoryName; ?></span> </a>
                  </button>
                  
                <?php } ?>
              </div>
            </div><br><br>

            <!-- The Area for recent posts page  -->
            <div class="card">
              <div class="card-header bg-info text-white">
                <h2 class="lead">Recent Posts</h2>
              </div>
              <div class="card-body">
                <?php
                  $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
                  $stmt = $conn->query($sql);
                  while($DataRows=$stmt->fetch()){
                    $Id = $DataRows['id'];
                    $Title = $DataRows['title'];
                    $DateTime = $DataRows['datetime'];
                    $Image = $DataRows['image'];

                  
                ?>
                <div class="media custom_inline">
                    <img  class="recent_img d-block img-fluid align-self-start" src="uploads/<?php echo htmlentities($Image);?>" alt="recent post img">
                    <div class="media-body ml-2">
                      <a target="_blank" href="FullPost.php?id=<?php echo htmlentities($Id); ?>">
                        <h6 class="lead"><?php echo htmlentities($Title);?></h6>
                      </a>
                      <p class=" small lead-xm"><?php echo htmlentities($DateTime);?></p>
                    </div>
                </div>
                <hr>
                  <?php }; ?>
              </div>
            </div>
          
        </div>
        <!-- -------Ending of the Side Area------- -->
      </div>
  <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
  </div>

  <!-- Footer Section for the Impulse Website -->

  <footer class="bg-dark text-white mt-3">
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
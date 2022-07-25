<?php
  require_once('includes/db.php');
  require_once('includes/functions.php');
  require_once('includes/sessions.php');
?>
<?php $SearchQueryParameter = $_GET["id"];?>

<?php
  if(isset($_POST['Submit'])){
    $Name = $_POST["CommenterName"];
    $Email = $_POST["CommenterEmail"];
    $Comment = $_POST["CommenterThoughts"];

    date_default_timezone_set("Asia/calcutta");
    $DateTime = strftime("%B-%d-%Y-%H:%M:%S",time());
  
    if(empty($Name)||empty($Email) || empty($Comment)){
      $_SESSION["ErrorMessage"] = "All Fields must be filled ..";
      Redirect_to("FullPost.php?id=$SearchQueryParameter");
    }
    elseif (strlen($Comment)>500){
      $_SESSION["ErrorMessage"] = "Comment should be less than 500 Characters ..";
      Redirect_to("FullPost.php?id=$SearchQueryParameter");
    }

    else{
      // Query to insert the Comments into the Impulse Database
      // Values containing dummy variable with a colan :
      // Our category table is laid in the mysql database
      $sql = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id) VALUES(:dateTime,:name,:email,:comment,'Pending','OFF',:postIdFromURL)"; 
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':dateTime',$DateTime);
      $stmt->bindValue(':name',$Name);
      $stmt->bindValue(':email',$Email);
      $stmt->bindValue(':comment',$Comment);
      $stmt->bindValue(':postIdFromURL',$SearchQueryParameter);
      $Execute = $stmt->execute();

      if($Execute){
        // Message with the id alerting functionality...
        $_SESSION["SuccessMessage"] = "Comment Submitted Succesfully";
        Redirect_to("FullPost.php?id=$SearchQueryParameter");
      }
      else{
        $_SESSION["ErrorMessage"] = "Something Went wrong. Try Again !";
        Redirect_to("FullPost.php?id=$SearchQueryParameter");
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
    <title>Full Posts</title>
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

  <div class="container">
      <div class="row mt-4" style="min-height:300px;">
          <div class="col-sm-8">
              <h1>The Next Wave Of Triggering Ideas</h1>
              <h1 class="lead">The Official Magazine of SEEE</h1>
              <?php 
                echo ErrorMessage();
                echo SuccessMessage();
              ?>
              
              <?php
                if(isset($_GET["SearchButton"])){
                    $Search = $_GET["Search"];
                    $sql = "SELECT * FROM posts WHERE datetime LIKE :search OR title LIKE :search OR category LIKE :search OR post like :search OR author LIKE :search";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':search','%'.$Search.'%');
                    $stmt->execute();
                }
                else{
                    $PostIdFromURL = $_GET["id"];

                    if(!isset($PostIdFromURL)){
                      $_SESSION["ErrorMessage"] = "Bad Request !";
                      Redirect_to("blog.php");
                    }

                    $sql = "SELECT * FROM posts WHERE id= $PostIdFromURL";
                    $stmt = $conn->query($sql);
                    $Result = $stmt->rowcount();
                    if($Result!=1){
                      $_SESSION["ErrorMessage"] = "Bad Request !";
                      Redirect_to("blog.php?page=1");
                    }
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
  
                      <hr>
                      <p class="card-text">
                          <?php 
                          //nl2br Add this instead of htmlentities when you need to add extra images and stuff like that
                            echo nl2br($PostDescription); 
                          ?>
                      </p>
     
                  </div>
              </div>
              <?php } ?>

          <!--Displaying the Existing comment into the Comment Section of Impulse Page  -->
          <span class="FieldInfo bottom_border">Comments</span><br><br>
          <?php 
            $sql = "SELECT * FROM comments WHERE post_id='$SearchQueryParameter' AND status='ON'";
            $stmt = $conn->query($sql);
            while($DataRows=$stmt->fetch()){
              $Commentdate = $DataRows['datetime'];
              $CommenterName = $DataRows['name'];
              $CommentContent = $DataRows['comment'];
          
            
          ?>
          <div>
            
            <div class="media avatar">
              <img class=" d-block img-fluid align-self-start" src="images/comment.png" alt="">
              <div class="media-body ml-2 pad_avatar">
                <h6 class="lead"><?php echo $CommenterName;?></h6>
                <p class="small"><?php echo $Commentdate;?></p>
                <p><?php echo $CommentContent;?></p>
              </div>
            </div>
          </div>
          <hr>

          <?php } ;?>

          

          <!-- Comment Section of the blog post  -->
          <form  action="FullPost.php?id=<?php echo $SearchQueryParameter;?>" method="post">
            <div class="card mt-3">
                    <div class="card-header">
                      <h5 class="lead">Comments</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Name</label>
                          <input type="text" name="CommenterName" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Email address</label>
                          <input type="email" name="CommenterEmail" class="form-control"  aria-describedby="emailHelp">
                          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                          <textarea class="form-control" name="CommenterThoughts"  cols="30" rows="4" placeholder="Enter your comment here .."></textarea>
                        </div>
                        
                        <div class="mb-3 form-check">
                          <input required type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Connect with us</label>
                        </div>
                        <button name="Submit" type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
            </form>
              
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
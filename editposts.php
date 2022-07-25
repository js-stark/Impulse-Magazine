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
  $SearchQueryParameter = $_GET['id'];
  if(isset($_POST['Submit'])){
    $PostTitle= $_POST["PostTitle"];
    $Category = $_POST["Category"];
    $Image = $_FILES["Image"]["name"];
    $Target = "uploads/".basename($_FILES["Image"]["name"]);
    $PostText = $_POST["PostDescription"];
    $Admin = "Js";
    date_default_timezone_set("Asia/calcutta");
    $DateTime = strftime("%B-%d-%Y-%H:%M:%S",time());
  
    if(empty($PostTitle)){
      $_SESSION["ErrorMessage"] = "Title can't be empty";
      Redirect_to("posts.php");
    }
    elseif (strlen($PostTitle)<5){
      $_SESSION["ErrorMessage"] = "Category Title should be more than 5 characters";
      Redirect_to("posts.php");
    }
    elseif (strlen($PostText)>9999){
      $_SESSION["ErrorMessage"] = "Post Description should be less than 10000 characters";
      Redirect_to("posts.php");
    }
    else{
      // Query to Update the Post data into the Impulse Database
      // Values containing dummy variable with a colan :
      // Our posts table is laid in the mysql database
      if(!empty($Image)){
        $sql = "UPDATE posts SET title='$PostTitle', category='$Category',image='$Image', post='$PostText' WHERE id=$SearchQueryParameter";
      }
      else{
        $sql = "UPDATE posts SET title='$PostTitle', category='$Category', post='$PostText' WHERE id=$SearchQueryParameter";
      }
      
      $Execute = $conn->query($sql);
      
      move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

      if($Execute){
        // Message with the id alerting functionality...
        $_SESSION["SuccessMessage"] = "Post Updated Succesfully";
        Redirect_to("posts.php");

      }
      else{

        $_SESSION["ErrorMessage"] = "Something Went wrong. Try Again !";
        Redirect_to("posts.php");

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
    <title>Edit Post</title>
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
          <h1><i class="fas fa-edit" style="color:#27aae1;"></i>Edit Post</h1>
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

              $sql = "SELECT * FROM posts WHERE id='$SearchQueryParameter'";
              $stmt = $conn->query($sql);
              while($DataRows=$stmt->fetch()){
                  $TitleToBeUpdated = $DataRows['title'];
                  $CategoryToBeUpdated = $DataRows['category'];
                  $ImageToBeUpdated = $DataRows['image'];
                  $PostToBeUpdated = $DataRows['post'];
              }
            ?>
            <form action="editposts.php?id=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
                    
                    <div class="card-body bg-dark">      <!--form body-->
                        <div class="form-group"> <!--form input group-->
                            <label  for="title"><span class="FieldInfo"> Post Title: </span></label>
                            <!-- Input Field for the Category Section with name Title -->
                            <input class="form-control" type="text" name="PostTitle" id="title" value="<?php echo $TitleToBeUpdated;?>" placeholder="Type title here">
                        </div>


                        <div class="form-group"> <!--form input group-->
                            
                            <label  for="CategoryTitle"><span class="FieldInfo">Choose Category</span></label><br/>
                            <span class="field-info">Existing Category:</span>
                            <?php echo $CategoryToBeUpdated?>
                            <!-- Input Field for the Category Section with name Title -->
                            <select class="form-select" name="Category" id="CategoryTitle">
                               <?php 
                                //taking all the categories from the Category table to display
                                $sql = "SELECT id,title FROM category";
                                $stmt = $conn->query($sql);
                                while($DataRows = $stmt->fetch()){
                                  $Id = $DataRows["id"];
                                  $CategoryName = $DataRows["title"];
                               ?>
                               <!-- Options to display inside the while loop -->
                               <option><?php echo $CategoryName;?></option>
                                <!-- While Loop ending inside a php scope keep in mind -->
                               <?php } ?>
                            </select>
                        </div>
                        

                        <!-- Image selection field for input -->
                        <div class="form-group mb-2">
                          <div class="custom-file">
                            <label for="imageSelect"><span class="FieldInfo">Select Image</span></label><br/>
                            <span class="field-info">Existing Image:</span>
                            <img class="img_edit" src="uploads/<?php echo $ImageToBeUpdated?>" alt="image">
                            <input class="form-control" type="file" name="Image" id="imageSelect" value="">
                          </div>
                        </div>
                        <!-- The textarea for the Posts to add -->
                        <div class="form-group">
                          <label for="Post"><span class="FieldInfo">Post: </span></label>
                          <textarea class="form-control" name="PostDescription" id="Post" cols="30" rows="10">
                            <?php echo $PostToBeUpdated;?>
                          </textarea>
                          
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
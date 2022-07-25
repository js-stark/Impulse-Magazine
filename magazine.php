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
    <link rel="stylesheet" href="css/magazine.css">
    <title>Magazine</title>

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

  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fas fa-book" style="color:#27aae1;"></i> Magazines</h1>
        </div>
      </div>
    </div>
  </header>


  <!-- Displaying Magazines -->

  <div class="body">
    <div class="contain">
      <div class="box">
        <div class="name">IMPULSE 2021</div>
        <a href="newmagazine/Glowing.html" class="read">Read Now</a>
        <div class="circle">
          <img class="product" src="./images/magazine/IM2021ed1/cover/3d pic.png" alt="">
        </div>
      </div>
      <div class="box">
        <div class="name">IMPULSE 2021</div>
        <a href="2020/2020ed1.php" class="read">Read Now</a>
        <div class="circle">
          <img class="product" src="./images/magazine/IM2020ed1/cover/3d pic.png" alt="">
        </div>
      </div>
      <div class="box">
        <div class="name">IMPULSE 2020</div>
        <a href="2020/2020ed2.php" class="read">Read Now</a>
        <div class="circle">
          <img class="product" src="./images/magazine/IM2020ed2/cover/3d pic.png" alt="">
        </div>
      </div>
      <div class="box">
        <div class="name">IMPULSE 2020</div>
        <a href="2020/2020ed3.php" class="read">Read Now</a>
        <div class="circle">
          <img class="product" src="./images/magazine/IM2020ed3/cover/3d pic.png" alt="">
        </div>
      </div>
      
      <div class="box">
        <div class="name">IMPULSE 2019</div>
        <a href="#" class="read">Read Now</a>
        <div class="circle">
          <img class="product" src="./images/magazine/1/7.png" alt="">
        </div>
      </div>
      <div class="box">
        <div class="name">IMPULSE 2019</div>
        <a href="#" class="read">Read Now</a>
        <div class="circle">
          <img class="product" src="./images/magazine/1/2.png" alt="">
        </div>
      </div>
      
    </div>
  </div>



  <!-- The Body Section for the Magazines -->

  <!-- <div class="magazine">
    <div class="book">
        <div class="front-cover">
            <div class="first-half"></div>
            <div class="second-half"></div>
        </div>
        <div class="back-cover"></div>
    </div>

  </div>
  <div class="magazine">
    <div class="book">
        <div class="front-cover">
            <div class="first-half"></div>
            <div class="second-half"></div>
        </div>
        <div class="back-cover"></div>
    </div>

  </div> -->

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
   <!-- Magazine js -->
   <script src="./js/magazine.js"></script>
   <!-- tilt js -->
   <script src="./js/tilt.js"></script>
   <script>
     VanillaTilt.init(document.querySelectorAll(".box"), {
     max: 25,
     speed: 400
	 });
   </script>
   

  
  <script>
    // Using Jquery module for getting year
    $('#year').text(new Date().getFullYear());
  </script>
   

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome css -->
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- Css style sheet -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/magazine.css">
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
            <a href="../blog.php?page=1" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="../aboutus.php" class="nav-link">About Us</a>
          </li>
          <li class="nav-item">
            <a href="../blog.php?page=1" class="nav-link">Blog</a>
          </li>
          <li class="nav-item">
            <a href="../magazine.php" class="nav-link">Magazine</a>
          </li>
          <li class="nav-item">
            <a href="../contact/contact.php" class="nav-link">Contact Us</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Features</a>
          </li>
          <li class="nav-item">
            <a href="../login.php" class="nav-link">Admin</a>
          </li>
        </ul>

        <!-- Right Section in Nav -->
        <ul class="navbar-nav ms-auto">
          <form class="form-inline d-none d-sm-block " action="../blog.php">
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
          <h1><i class="fas fa-book" style="color:#27aae1;"></i> Impulse Edition 2020</h1>
        </div>
      </div>
    </div>
  </header>


  <!-- The Body Section for the Magazines -->

    <div class="card-body">
        <div class="wrapper">
            <div class="imgBx">
            </div>
            <div class="details">
                <div class="content">
                    <h2>Impulse Magazine<br><span>Triggering Ideas</span></h2>
                    <p>For many of us, each new year marks a chance for renewal, and 2021 is no exception. In this strange new world of the coronavirus that we all face, maintaining the Electrical systems in place for the responders on the front line remains the top priority. Every Article in this issue speaks to challlenge, opportunity and the transformative power of Electricity. In this issue, we are focusing on the innovative technologies that bring in Artificial Intelligence into power systems, Roads that work with Transformative Electricity, new fangled Anti Sleep Alarms that makes you a better person, kinaesthetic communication that can create an experience of touch by applying forces and singapore's Float voltaic Technology. Having laid its roots in the early 21st Centuary Artificial Intelligence Compounded with smart technologies shall hover the realm of Electricity pretty soon.</p>
                    <h3>30 min</h3>
                    <a href="./read2021ed1.php"><button>Read Now</button></a>
                </div>
            </div>
        </div>
        <div class="t21ed1 magazine">
          <div class="book">
            <img src="../images/magazine/IM2021ed1/cover/1.jpg">
          </div>
        </div>
    </div>





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
   <script src="../js/popper.min.js"></script>
   <!-- Bootstrap js -->
   <script src="../js/bootstrap.min.js"></script>
   <!-- Font Awesome js -->
   <script src="../js/all.min.js"></script>
   <!-- Magazine js -->
   <script src="../js/magazine.js"></script>
   <!-- tilt js -->
   <script src="../js/tilt.js"></script>
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
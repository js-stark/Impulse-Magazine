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
    <link rel="stylesheet" href="../css/readMagazine.css">
    <title>Impulse Magazine</title>

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
                <!-- <input class="form-control mr-4 custom_pad" type="text" name="Search" placeholder="Search here">
                <button name="SearchButton" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button> -->
                
              </div>
              
          </form>
        </ul>
        
      </div>

    </div>
  </nav>
  <div style="height:10px; background:#27aae1;"></div>



  <!-- The Body Section for the Magazines -->

  <div class="magbody">
      <!-- Previous Button -->
      <!-- left Arrow -->
      <button class="bp arrow" id="prev-btn">
          <i class="ap zbold fas fa-angle-left"></i>
      </button>

    <!-- Book -->
    <div id="book" class="book">

        <!-- Paper 1 -->
        <div id="p1" class="paper">
            <div class="front">
                <div id="f1" class="front-content">
                    <img src="../images/magazine/IM2020ed1/1.jpg" alt="">
                </div>
            </div>
            <div class="back">
                <div id="b1" class="back-content">
                <img src="../images/magazine/IM2020ed1/2.jpg" alt="">
                </div>
            </div>
        </div>
        <!-- Paper 2 -->
        <div id="p2" class="paper">
            <div class="front">
                <div id="f2" class="front-content">
                <img src="../images/magazine/IM2020ed1/3.jpg" alt="">
                </div>
            </div>
            <div class="back">
                <div id="b2" class="back-content">
                <img src="../images/magazine/IM2020ed1/4.jpg" alt="">
                </div>
            </div>
        </div>
        <!-- Paper 3 -->
        <div id="p3" class="paper">
            <div class="front">
                <div id="f3" class="front-content">
                <img src="../images/magazine/IM2020ed1/5.jpg" alt="">
                </div>
            </div>
            <div class="back">
                <div id="b3" class="back-content">
                <img src="../images/magazine/IM2020ed1/6.jpg" alt="">
                </div>
            </div>
        </div>
        <!-- Paper 4 -->
        <div id="p4" class="paper">
            <div class="front">
                <div id="f4" class="front-content">
                <img src="../images/magazine/IM2020ed1/7.jpg" alt="">
                </div>
            </div>
            <div class="back">
                <div id="b4" class="back-content">
                <img src="../images/magazine/IM2020ed1/8.jpg" alt="">
                </div>
            </div>
        </div>
        <!-- Paper 5 -->
        <div id="p5" class="paper">
            <div class="front">
                <div id="f5" class="front-content">
                <img src="../images/magazine/IM2020ed1/9.jpg" alt="">
                </div>
            </div>
            <div class="back">
                <div id="b5" class="back-content">
                <img src="../images/magazine/IM2020ed1/10.jpg" alt="">
                </div>
            </div>
        </div>
        <!-- Paper 6 -->
        <div id="p6" class="paper">
            <div class="front">
                <div id="f6" class="front-content">
                <img src="../images/magazine/IM2020ed1/11.jpg" alt="">
                </div>
            </div>
            <div class="back">
                <div id="b6" class="back-content">
                <img src="../images/magazine/IM2020ed1/12.jpg" alt="">
                </div>
            </div>
        </div>
        <!-- Paper 7 -->
        <div id="p7" class="paper">
            <div class="front">
                <div id="f7" class="front-content">
                <img src="../images/magazine/IM2020ed1/13.jpg" alt="">
                </div>
            </div>
            <div class="back">
                <div id="b7" class="back-content">
                <img src="../images/magazine/IM2020ed1/14.jpg" alt="">
                </div>
            </div>
        </div>
        <!-- Paper 8 -->
        <div id="p8" class="paper">
            <div class="front">
                <div id="f8" class="front-content">
                <img src="../images/magazine/IM2020ed1/15.jpg" alt="">
                </div>
            </div>
            <div class="back">
                <div id="b8" class="back-content">
                <img src="../images/magazine/IM2020ed1/16.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- Next Button -->
    <button class="bn arrow" id="next-btn">
          <i class="an zbold fas fa-angle-right"></i>
    </button>

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
   <script src="./readMag2020ed1.js"></script>
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
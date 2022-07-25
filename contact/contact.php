<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="style.css">
    <title>Contact Us | Impulse</title>

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
            <a href="contact.php" class="nav-link">Contact Us</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Features</a>
          </li>
          <li class="nav-item">
            <a href="../login.php" class="nav-link">Admin</a>
          </li>
        </ul>

        <!-- Right Section in Nav -->
      </div>

    </div>
  </nav>
  <div style="height:10px; background:#27aae1;"></div>


  <!-- Displaying info -->

  <div class="body">
    <div class="wrapper">
      <header>Contact The Impulse Team</header>
      <form action="#">
        <div class="dbl-field">
          <div class="field">
            <input type="text" name="name" placeholder="Enter your name">
            <i class='fas fa-user'></i>
          </div>
          <div class="field">
            <input type="text" name="email" placeholder="Enter your email">
            <i class='fas fa-envelope'></i>
          </div>
        </div>
        <div class="dbl-field">
          <div class="field">
            <input type="text" name="phone" placeholder="Enter your phone">
            <i class='fas fa-phone-alt'></i>
          </div>
          <div class="field">
            <input type="text" name="website" placeholder="Enter your website">
            <i class='fas fa-globe'></i>
          </div>
        </div>
        <div class="message">
          <textarea placeholder="Write your message" name="message"></textarea>
          <i class="material-icons">message</i>
        </div>
        <div class="button-area">
          <button type="submit">Send Message</button>
          <span></span>
        </div>
      </form>
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
   <script src="script.js"></script>
   

  
  <script>
    // Using Jquery module for getting year
    $('#year').text(new Date().getFullYear());
  </script>
   

</body>
</html>
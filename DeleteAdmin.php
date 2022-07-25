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
    if(isset($_GET["id"])){
        $SearchQueryParameter = $_GET["id"];
        $sql = "DELETE FROM admins WHERE id='$SearchQueryParameter'";
        $stmt = $conn->query($sql);
        if($stmt){
            $_SESSION["SuccessMessage"] = "Admin Deleted Succesfully";
            Redirect_to("admin.php");
        }
        else{
            $_SESSION["ErrorMessage"] = "Something Went wrong. Try Again !";
            Redirect_to("admin.php");
          }
    }

?>

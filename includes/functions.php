<?php require_once('db.php');?>
<?php

    function Redirect_to($New_Location){
        header("Location:".$New_Location);
        exit;
      }

    function CheckUserNameExits($UserName){
      global $conn;
      $sql    = "SELECT username FROM admins WHERE username=:userName";
      $stmt   = $conn->prepare($sql);
      $stmt->bindValue(':userName',$UserName);
      $stmt->execute();
      $Result = $stmt->rowcount();
      if ($Result==1) {
        return true;
      }else {
        return false;
      }
    }

    function Login_Attempt($UserName,$Password){
          global $conn;
          $sql = "SELECT * FROM admins WHERE username=:userName AND password=:passWord LIMIT 1";
          $stmt = $conn->prepare($sql);
          $stmt->bindValue(':userName',$UserName);
          $stmt->bindValue(':passWord',$Password);
          $stmt->execute();
          $Result = $stmt->rowcount();
          if($Result == 1){
              return $Found_Account = $stmt->fetch();
          }
          else{
              return null;
          }
    }

    function Confirm_Login(){
      if(isset($_SESSION["UserId"])){
        return true;
      }
      else{
        $_SESSION["ErrorMessage"] = "Login Required !";
        Redirect_to("login.php");
      }
    }

    function TotalPosts(){
        global $conn;
        $sql = "SELECT COUNT(*) FROM posts";
        $stmt = $conn->query($sql);
        $TotalRows = $stmt->fetch();
        $TotalPosts = array_shift($TotalRows);
        return $TotalPosts;
    }
    function TotalCategories(){
        global $conn;
        $sql = "SELECT COUNT(*) FROM category";
        $stmt = $conn->query($sql);
        $TotalRows = $stmt->fetch();
        $TotalCategories = array_shift($TotalRows);
        return $TotalCategories;
    }
    function TotalAdmin(){
        global $conn;
        $sql = "SELECT COUNT(*) FROM admins";
        $stmt = $conn->query($sql);
        $TotalRows = $stmt->fetch();
        $TotalAdmin = array_shift($TotalRows);
        return $TotalAdmin;
    }
    function TotalComments(){
        global $conn;
        $sql = "SELECT COUNT(*) FROM comments";
        $stmt = $conn->query($sql);
        $TotalRows = $stmt->fetch();
        $TotalComments = array_shift($TotalRows);
        return $TotalComments;
    }
?>
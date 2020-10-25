<?php
require_once "pdo.php";
session_start();
$_SESSION['status']=0;
 ?><!DOCTYPE html>
<html>
<head>
<title>Luigy David Miranda Sandoval</title>
<link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
    crossorigin="anonymous">
</head>
<body>
<div class="container">
<h1>Editing Profile for UMSI</h1>
<?php    
       if (isset($_SESSION["error"])) {
        echo('<p style="color: red;">' . $_SESSION["error"]);
        unset($_SESSION["error"]);
    }?>
<form method="post">
<p>First Name:
<input type="text" name="first_name" size="60"/></p>
<p>Last Name:
<input type="text" name="last_name" size="60"/></p>
<p>Email:
<input type="text" name="email" size="30"/></p>
<p>Headline:<br/>
<input type="text" name="headline" size="80"/></p>
<p>Summary:<br/>
<textarea name="summary" rows="8" cols="80"></textarea>
<p>
<input type="submit" name="add" value="Add">
<input type="submit" name="cancel" value="Cancel">
</p>
</form>
</div>
</body>
</html>
<?php
if (!isset($_SESSION['user_id'])) {
  // code...
  die("ACCESS DENIED");
  return;
}
if(isset($_POST['cancel'])){
  header('Location: index.php');
  return;
}
if (isset($_POST['first_name']) && isset($_POST['last_name']) &&
    isset($_POST['email']) && isset($_POST['headline']) &&
    isset($_POST['summary'])) {
      if (strlen($_POST['first_name']) == 0 || strlen($_POST['last_name']) == 0 ||
          strlen($_POST['email']) == 0 || strlen($_POST['headline']) == 0 ||
          strlen($_POST['summary']) == 0 ) {
            $_SESSION['error'] = "All fields are required";

            header('Location: add.php');
            return;
      }
      if (strpos($_POST['email'], '@') === false ){
            $_SESSION['error'] = "Email address must contaion @";
            header('Location: add.php');
            return;
      }
    }
if (isset($_POST["add"])) {
  if(!isset($_POST['first_name']) &&
  !isset($_POST['last_name']) &&
  !isset($_POST['email']) &&
  !isset($_POST['headline']) &&
  !isset($_POST['summary'])){
     $_SESSION["error"] = "All fields are required";
  
  }
  if (strlen($_POST["first_name"]) < 1
      || strlen($_POST["last_name"]) < 1
      || strlen($_POST["email"]) < 1
      || strlen($_POST["headline"]) < 1
      || strlen($_POST["summary"]) < 1){
        $_SESSION["error"] = "All fields are required";
        ?> 
        <script>alert("All values are required");</script>
        <?php 
      }else{
        $id=$_SESSION['user_id'];
        $name=$_POST['first_name'];
        $setna=$_POST['last_name'];
        $ema=$_POST['email'];
        $head=$_POST['headline'];
        $sum=$_POST['summary'];
        $stmt = ("INSERT INTO profile
        (user_id, first_name, last_name, email, headline, summary)
        VALUES ('$id','$name','$setna','$ema','$head','$sum')");
        $ejecutar=mysqli_query($pdo,$stmt);
    $_SESSION['status']=$_SESSION['status']+1;
    $_SESSION["success"] = "Profile added";
    header('Location: index.php');
    
}
}
 ?>

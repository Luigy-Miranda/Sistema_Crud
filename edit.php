<?php
session_start();
include_once 'pdo.php';
$id = $_GET['profile_id'];
$consul = "SELECT * FROM profile WHERE profile_id = ' ".$id." ' ";
$resul = mysqli_query($pdo, $consul);
$ex = mysqli_fetch_array($resul);

if (isset($_POST["cancel"])) {
  header("Location: index.php");
  die();
}


if (isset($_POST["save"])) {
    if (strlen($_POST["first_name"]) < 1
        || strlen($_POST["last_name"]) < 1
        || strlen($_POST["email"]) < 1
        || strlen($_POST["headline"]) < 1
        || strlen($_POST["summary"]) < 1){
          $_SESSION["error"] = "All fields are required";
        }else{  
          $id=$_SESSION['user_id'];
          $name=$_POST['first_name'];
          $setna=$_POST['last_name'];
          $ema=$_POST['email'];
          $head=$_POST['headline'];
          $sum=$_POST['summary'];
          
          $stmt = "UPDATE profile set user_id = '" .$id. "', first_name = '" .$name."'
          , last_name = '" .$setna."', email = '".$setna."', headline = '".$head."'
          , summary = '".$sum."' WHERE profile_id ='".$_GET['profile_id']."' ";

          $ejecutar=mysqli_query($pdo,$stmt);
          ?> 
          <script>alert("Register update!")</script>
          <?php
          $_SESSION["success"] = "Profile updated";
          header('Location: index.php');
        }
}
?>
<!DOCTYPE html>
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
<form method="post">
        <label>First Name:</label>
        <input type="text" name="first_name" value="<?php echo $name ?>">
        <br>
        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $setna ?>">
        <br>
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $ema ?>">
        <br>
        <label>Headline:</label>
        <br>
        <input type="text" name="headline" value="<?php echo $head ?>">
        <br>
        <label>Summary:</label>
        <br>
        <textarea
            name="summary"
            cols="100"
            rows="20"
            style="resize: none;"
        >
        <?php echo $sum ?>
        </textarea>
        <br>
        <input type="hidden" name="profile_id" value="<?php echo $profile_id ?>">
        <input type="submit" name="save" value="Save">
        <input type="submit" name="cancel" value="Cancel">
    </form>
</div>
</body>
</html>
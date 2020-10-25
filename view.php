<?php
require_once "pdo.php";
$id=$_GET['profile_id'];
$consul ="SELECT * FROM profile WHERE profile_id = '" .$id."' ";
$resul = mysqli_query($pdo,$consul);
$extraido= mysqli_fetch_array($resul);
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Luigy David Miranda Sandoval</title>
  </head>
  <body>
    <div id=”tabla1″>
    
      <h1>Profiles information</h1>
      <?php 
        $ver1= htmlentities($extraido['first_name']);
        $ver2= htmlentities($extraido['last_name']);
        $ver3 = htmlentities($extraido['email']);
        $ver4= htmlentities($extraido['headline']);
        $ver5 = htmlentities($extraido['summary']);
        ?>
      <p>First Name: <?php echo $ver1 ?></p>
      <p>Last Name: <?php echo $ver2 ?></p>
      <p>Email:  <?php echo $ver3 ?></p>
      <p>
      Headline: 
      <br>
      <?php echo $ver4?>
      </p>
      <p>
      Summary: 
      <br>
      <?php echo $ver5?>
      </p>
      <h1>-------------------------------------</h1>
      </div>
      <?php ?>
      <a href="index.php">Done</a>
  </body>
</html>

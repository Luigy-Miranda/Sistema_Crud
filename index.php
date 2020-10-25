<?PHP
session_start(); 
$_SESSION['status']=0;
require_once "pdo.php";
$consul ="SELECT * FROM profile";
$resul = mysqli_query($pdo,$consul);
$extraido= mysqli_fetch_array($resul);
$first_na = $extraido['first_name'];
$last_na = $extraido['last_name'];
$head_la = $extraido['headline'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Luigy David Miranda Sandoval</title>
  </head>
  <body>
    <h1>Chuck Serverance's Resume Registry</h1>
          <?php
              if (isset($_SESSION['success']) ) {
                echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
                unset($_SESSION['success']);
            }
              if (!isset($_SESSION['user_id'])) {
                # code...
                ?>
                <html>    
                <div id="login" class="login">
                <a href="login.php">Please log in</a>
              </div></html>
              <?php
              }else{
                ?>
                <html><a href="logout.php">Logout</a>
                </html>
                <?php
                              }
    if (isset($_SESSION['user_id'])){
      echo '<table border="1">'."\n";
      echo "<tr><td>";
      echo "Name";
      echo "</td><td>";
      echo "Headline";
      echo "</td>";
      echo "<td>Action</td>";

      while ($extraido = mysqli_fetch_array($resul)) {
      echo "<tr><td>";
      echo "<a href='view.php?profile_id=" . $extraido['profile_id'] .
      "'>" . htmlentities($extraido['first_name'] . " " . $extraido['last_name']) .
      "</a>";
            echo("</td><td>");
            echo(htmlentities($extraido['headline']));
            echo'<td><a href="edit.php?profile_id=' . $extraido['profile_id'] .'">Edit</a>';
            echo'  ';
            echo'<a href="delete.php?profile_id=' . $extraido['profile_id'] . '">Delete</a>';
            echo("</td>");
    }
 }
  

      
      if (isset($_SESSION['user_id'])) {
     
            ?>
              <p>
            
  <br>
  </p>
            <a href="add.php">Add New Entry</a>
      <?php
          }
       ?>
  </body>

</html>

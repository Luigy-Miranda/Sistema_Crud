<?php
require_once "pdo.php";
session_start();
$consul ="SELECT * FROM users";
$resul = mysqli_query($pdo,$consul);
$extraido= mysqli_fetch_array($resul);
$id = $extraido['user_id'];
$emailver = $extraido['email'];
$clavever = $extraido['password'];

$salt='XyZzy12';
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
<h1>Please Log In</h1>
<form method="POST" action="login.php">
<label for="email">Email</label>
<input type="text" name="email" id="email"><br/>
<label for="id_1723">Password</label>
<input type="password" name="pass" id="id_1723"><br/>
<input type="submit" name="submi" onclick="return doValidate();" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>
</p>
<?php
///Obtener datos
$_SESSION['sesion_iniciada'] = false;
//$check = hash('md5',$salt,$_POST['pass']);
$stmt = $pdo->prepare('SELECT user_id, name FROM users WHERE email = :em AND password = :pw');
//$stnt = execute(array(':em'=> $_POST['email'],':pw' => $check));
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (isset($_POST['submi'])) {
  if ($_POST['email'] == $emailver && $_POST['pass'] == $clavever) {
           $_SESSION['sesion_iniciada'] = true;
           $_SESSION['user_id']=$id['user_id'];
           header('Location: index.php');
           return;
      }else {
          $msg = 'El usuario o Contraseña no son validos';
          echo $msg;
      }
}
if (isset($_POST['cancel'])) {
  header('Location: index.php');
  return;
}
 ?>
<script>
function doValidate() {
    try {
        addr = document.getElementById('email').value;
        pw = document.getElementById('id_1723').value;
        console.log("Validating addr="+addr+" pw="+pw);
        if (addr == null || addr == "" || pw == null || pw == "") {
            alert("Both fields must be filled out");
            return false;
        }
        if ( addr.indexOf('@') == -1 ) {
            alert("Invalid email address");
            return false;
        }
        return true;
    } catch(e) {
        return false;
    }
    return false;
}
</script>
</div>
</body>

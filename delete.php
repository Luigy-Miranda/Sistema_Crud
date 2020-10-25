<?php 
session_start();
include_once 'pdo.php'; 
$id=$_GET['profile_id'];
$consulta = "SELECT * FROM profile WHERE profile_id ='" .$id."' ";
$resulta = mysqli_query($pdo,$consulta);
$ex= mysqli_fetch_array($resulta);
$nombre = $ex['first_name'];
$second = $ex['last_name'];
if (isset($_POST['delete']) && isset($_POST['profile_id'])) {
    #Sentencia para eliminar
    $eliminar = "DELETE FROM profile WHERE profile_id ='" .$id."' ";
    mysqli_query($pdo, $eliminar) or die; 
    ?>
    <script>alert("Profile Delete");</script>
    <?php 
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Luigy David Miranda Sandoval</title>
</head>
<body style="font-family: Helvetica">
    <h1>Deleting Profile</h1>
    <p>First Name: <?php echo $nombre ?></p>
    <p>Last Name: <?php echo $second ?></p>
    <form method="post">
        <input
            type="hidden"
            name="profile_id"
            value="<?php echo $_GET['profile_id'] ?>"
        >
        <input type="submit" name="delete" value="Delete">
        <input type="submit" name="cancel" value="Cancel">
    </form>
</body>
</html>
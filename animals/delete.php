
<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}


require_once '../components/db_connect.php';

if ($_GET['id']) {
   $id = $_GET['id'];
   $sql = "SELECT * FROM animals WHERE pet_id = {$id}" ;
   $result = $connect->query($sql);
   $data = $result->fetch_assoc();
   if ($result->num_rows == 1) {
        $pet_image = $data['pet_image'];
        $pet_name = $data['pet_name'];
        $city = $data['city'];
        $address = $data['address'];
        $zip = $data['zip'];
        $age = $data['age'];
        $description = $data['description'];
        $hobbies = $data['hobbies'];
        $breed = $data['breed'];
        $size = $data['size'];
        $status = $data['status'];
} else {
    header("location: error.php");
}
$connect->close();
} else {
header("location: error.php");
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <?php require_once '../components/boot.php'?>
    <style type= "text/css">
       fieldset {
            margin: auto;
            margin-top: 100px;
            width: 70% ;
        }     
        .img-thumbnail{
            width: 70px !important;
            height: 70px !important;
        }    
   </style>
</head>
<body>
<fieldset>
<legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='<?php echo $pet_image ?>' alt="<?php echo $pet_name ?>"></legend>
<h5>You have selected the data below:</h5>
<table class="table w-75 mt-3">
<tr>
            <td><?php echo $pet_name?></td>
</tr>
</table>

<h3 class="mb-4">Do you really want to delete this pet record?</h3>
<form action ="actions/a_delete.php" method="post">
   <input type="hidden" name="id" value="<?php echo $id ?>" />
   <button class="btn btn-danger" type="submit">Yes, delete it!</button >
   <a href="index.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
</form>
</fieldset>
</body>
</html>


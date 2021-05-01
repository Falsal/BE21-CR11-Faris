
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
    echo "__ id is :".$id;
    $sql = "SELECT * FROM animals WHERE pet_id = {$id}";
    $result = $connect->query($sql);
    if ($result->num_rows == 1) {

        $data = $result->fetch_assoc();
        
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
        // echo "line43";
        header("location: error.php");
    }
    $connect->close();
} else {
    echo "line47";
    header("location: error.php");
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>Edit Product</title>
   <?php require_once '../components/boot.php'?>
   <style type= "text/css">
       fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60% ;
        }  
        .img-thumbnail{
            width: 70px !important;
            height: 70px !important;
        }     
   </style>
</head>
<body>
<fieldset>
   <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='<?php echo $pet_image ?>' alt="<?php echo $pet_name ?>"></legend>
   <form action="actions/a_update.php"  method="post" enctype="multipart/form-data">
       <table class="table">
           <tr>
               <th>Picture</th>
               <td><input class='form-control' type="text" name="pet_image"  placeholder="Insert Image URL" value="<?php echo $pet_image ?>"/></td>
           </tr>    
           <tr>
               <th>Pet Name</th>
               <td><input class='form-control' type="text" name="pet_name"  placeholder="Pet Name" value="<?php echo $pet_name ?>"/></td>
           </tr>    
           <tr>
               <th>City</th>
               <td><input class='form-control' type="text" step="any" name= "city" placeholder="City" value="<?php echo $city ?>"/></td>
           </tr>
           <tr>
               <th>Address</th>
               <td><input class='form-control' type="text" name="address" placeholder="address" value="<?php echo $address ?>"/></td>
           </tr>
           <tr>
               <th>Age</th>
               <td><input class='form-control' type="number" name="age" placeholder="age" value="<?php echo $age ?>"/></td>
           </tr>
           <tr>
               <th>Zip</th>
               <td><input class='form-control' type="number" name="zip" placeholder="zip"value="<?php echo $zip ?>"/></td>
           </tr>
           <tr>
               <th>Description</th>
               <td><input class='form-control' type="text" name="description" placeholder="description" value="<?php echo $description ?>"/></td>
           </tr>
           <tr>
               <th>Hobbies</th>
               <td><input class='form-control' type="text" name="hobbies" placeholder="hobbies" value="<?php echo $hobbies ?>"/></td>
           </tr>
           <tr>
               <th>Breed</th>
               <td><input class='form-control' type="text" name="breed" placeholder="breed" value="<?php echo $breed ?>"/></td>
           </tr>
           <tr>
               <th>Size</th>
               <td><input class='form-control' type="text" name="size" placeholder="size" value="<?php echo $size ?>"/></td>
           </tr>
           <tr>
               <th>Status</th>
               <td><input class='form-control' type="text" name="status" placeholder="status" value="<?php echo $status ?>"/></td>
           </tr>
           <tr>
               <input type= "hidden" name= "pet_id" value= "<?php echo $data['pet_id'] ?>" />
               <td><button class="btn btn-success" type= "submit">Save Changes</button></td>
               <td><a href= "index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
           </tr>
       </table>
   </form>
</fieldset>
</body>
</html>



<?php
session_start();
require_once '../components/db_connect.php';
if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/boot.php'?>
    <title>PHP CRUD  |  Add Pet</title>
    <style>
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60% ;
        }       
    </style>
</head>
<body>

<div class="container text-center text-primary mt-5 mb-0">
<h1 color-primary> ADD PET FORM</h1>
</div>

<fieldset>
   <!-- <legend class='h2'>ADD PET</legend> -->
   <form action="actions/a_create.php" method= "post" enctype="multipart/form-data">
   <table class='table'>
           <tr>
               <th>Picture</th>
               <td><input class='form-control' type="text" name="pet_image"  placeholder="Insert Image URL" /></td>
           </tr>    
           <tr>
               <th>Pet Name</th>
               <td><input class='form-control' type="text" name="pet_name"  placeholder="Pet Name" /></td>
           </tr>    
           <tr>
               <th>City</th>
               <td><input class='form-control' type="text" step="any" name= "city" placeholder="City" /></td>
           </tr>
           <tr>
               <th>Address</th>
               <td><input class='form-control' type="text" name="address" placeholder="address"/></td>
           </tr>
           <tr>
               <th>Age</th>
               <td><input class='form-control' type="number" name="age" placeholder="age"/></td>
           </tr>
           <tr>
               <th>Zip</th>
               <td><input class='form-control' type="text" name="zip" placeholder="zip"/></td>
           </tr>
           <tr>
               <th>Description</th>
               <td><input class='form-control' type="text" name="description" placeholder="description"/></td>
           </tr>
           <tr>
               <th>Hobbies</th>
               <td><input class='form-control' type="text" name="hobbies" placeholder="hobbies"/></td>
           </tr>
           <tr>
               <th>Breed</th>
               <td><input class='form-control' type="text" name="breed" placeholder="breed"/></td>
           </tr>
           <tr>
               <th>Size</th>
               <td><input class='form-control' type="text" name="size" placeholder="size"/></td>
           </tr>
           <tr>
               <th>Status</th>
               <td><input class='form-control' type="text" name="status" placeholder="status" value='available'/></td>
           </tr>

           <tr>
               <td><button class='btn btn-success' type="submit">Insert Pet</button></td>
               <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
           </tr>
       </table>
   </form>
</fieldset>
</body>
</html>


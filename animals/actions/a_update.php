
<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit;
}


require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';


// testing array
// printArray($_POST);

// function printArray($array){
//      foreach ($array as $key => $value){
//         echo "$key => $value";
//         if(is_array($value)){ //If $value is an array, print it as well!
//             printArray($value);
//         }  
//     } 
// };

if ($_POST) { 
    $pet_id=$_POST['pet_id'];   
    $pet_image = $_POST['pet_image'];
    $pet_name = $_POST['pet_name'];   
    $city = $_POST['city'];   
    $address = $_POST['address'];   
    $zip = $_POST['zip'];   
    $age = $_POST['age'];   
    $description = $_POST['description'];   
    $hobbies = $_POST['hobbies'];   
    $breed = $_POST['breed'];   
    $size = $_POST['size'];   
    $status = $_POST['status'];   

            
    $sql="UPDATE animals SET pet_image='$pet_image',pet_name ='$pet_name',city='$city',address='$address',age='$age',description='$description',hobbies='$hobbies',breed='$breed',size='$size',status='$status',zip='$zip'  WHERE pet_id={$pet_id}";
    
    
    if ($connect->query($sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . $connect->error;
    }

    $connect->close();  

} else {
    header("location: ../error.php");
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../../components/boot.php'?> 
</head>
<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class;?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
           
            <a href='../update.php?id=<?=$pet_id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>
</body>
</html>


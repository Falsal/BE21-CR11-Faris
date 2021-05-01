
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
// require_once '../../components/file_upload.php';

if ($_POST) {   

    $pet_image = $_POST['pet_image'];
    $pet_name = $_POST['pet_name'];   
    $city = $_POST['city'];   
    $address = $_POST['address'];   
    $age = $_POST['age'];   
    $description = $_POST['description'];   
    $hobbies = $_POST['hobbies'];   
    $breed = $_POST['breed'];   
    $size = $_POST['size'];   
    $status = $_POST['status'];   
   
   
    $sql = "INSERT INTO animals (pet_image,pet_name,city,address,age,description,hobbies,breed,size,status) VALUES ('$pet_image','$pet_name','$city','$address','$age','$description','$hobbies','$breed','$size','$status')";
  
    if ($connect->query($sql) === true) {

        $class = "success";
        $message = "The entry below was successfully created <br>
                        <table class='table w-50'><tr>
                            <td>" .$pet_image."</td>
                            <td>" .$city."</td>
                            <td>" .$address."</td>
                            <td>" .$age."</td>
                            <td>" .$description."</td>
                            <td>" .$hobbies."</td>
                            <td>" .$breed."</td>
                            <td>" .$size."</td>
                            <td>" .$status."</td>
                        </tr></table><hr>
                        ";
        // $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        // $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
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
    <title>A_Create</title>
    <?php require_once '../../components/boot.php'?>
</head>
<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?=$class;?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
          
            <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>
</body>
</html>


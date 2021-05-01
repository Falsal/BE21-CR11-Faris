<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
};

// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
// print_r($_SESSION);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
// print_r($row);
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome - <?php echo $row['first_name']; ?></title>
        <?php require_once 'components/boot.php'?>
        <style>
            .userImage{
                width: 200px;
                height: 200px;
            }
            .hero {
                background: rgb(2,0,36);
                background: linear-gradient(24deg, rgba(2,0,36,1) 0%, rgba(0,212,255,1) 100%);   
            }
        </style>
    </head>
    <body>
        <div class="container">

        <!-- Background image -->
        <div
        class="bg-image"
        style="
                background-image: url('pictures/flying_cats.jpg');
                height: 100vh; "
        >
                <div class="test">
                    <img class="userImage" src="pictures/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>">
                    <p class="text-success text-bold fs-4" >Hi <?php echo $row['first_name']; ?></p>
                </div>
                <a href="animals/index.php">
                    <button class="btn btn-primary">  
                    Pets       
                    </button>
                </a>
                <a href="logout.php?logout">
                    <button class="btn btn-warning">  
                    Sign Out      
                    </button>
                </a>
                <a href="update.php?id=<?php echo $_SESSION['user'] ?>">
                    <button class="btn btn-dark">  
                    Update profile     
                    </button>                
                </a>
        </div>
        <!-- Background image -->



        </div>
    </body>
</html>
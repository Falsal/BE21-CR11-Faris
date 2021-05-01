 
<?php 
session_start();
require_once '../components/db_connect.php';

$userType='';

if(!isset($_SESSION['adm'])){
    if(isset($_SESSION['user']))
    {
        $userType="user";
// echo "user Type is line 10: ".$userType."<br>";
    }
    else {
        header("Location: ../index.php");
    }
    
}else 
{
// print_r("..this is admin sessionwith ID line 18".$_SESSION['adm']."<br>");
    $userType='adm';
// echo "user Type is : line20 ".$userType."<br>";
}


// ======== user session valid so make del and edit buttons disappear ========= 
$admFlag='';
$userFlag='';
if($userType=='user' ) {
    $userFlag='hidden';
    // echo "..userFlag  line 30: ".$userFlag."<br>";
}

if($userType=='adm'){
    $admFlag='hidden';
    // echo "<br> userType is : line34".$userType."<br>";
 
}
// =============== Back Button ====================
$backBtn = '';
//if it is a user it will create a back button to home.php
if(isset($_SESSION["user"])){
    $backBtn = "../home.php";    
}
//if it is a adm it will create a back button to dashboard.php
if(isset($_SESSION["adm"])){
    $backBtn = "../dashBoard.php";    
}


$sql = "SELECT * FROM animals ";

$result = mysqli_query($connect ,$sql);
$tbody=''; //this variable will hold the body for the table
if(mysqli_num_rows($result)  > 0) {  
       
    // $admFlag? print_r("admFlag line 55 : ".$admFlag."<--<br>") : print_r ("admFlag line 53 is empty"); 

     while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        //  echo " ..Line60_row[pet_id]  :".$row['pet_id']."<br>";         
        $tbody .= "<tr>
            <td><img class='img-thumbnail' src='" .$row['pet_image']."'</td>
            <td>" .$row['pet_name']."</td>
            <td>" .$row['city']."</td>
            <td>" .$row['address']."</td>
            <td>" .$row['zip']."</td>
            <td>" .$row['age']."</td>
            <td>" .$row['description']."</td>
            <td>" .$row['hobbies']."</td>
            <td>" .$row['breed']."</td>
            <td>" .$row['size']."</td>
            <td>" .$row['status']."</td>
            <td>
               
                <a ".$userFlag." href='update.php?id=".$row['pet_id']."'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
                <a href='delete.php?id=" .$row['pet_id']."'>
                <button ".$userFlag." class='btn btn-danger btn-sm' type='button'>Delete</button>
                </a>
                
                <a href='adopt.php?id=" .$row['pet_id']."'>
                <button  $admFlag class='btn btn-success btn-sm' type='button'>Take me home</button>
                </a>
            </td>
         </tr>";
            // echo "...Car ID :".$row['id'];
        };
} else  {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}


$connect->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <?php require_once '../components/boot.php' ?>
    <style type="text/css">
        .manageProduct {           
            margin: auto;
        }
        .img-thumbnail{
            width: 100px;
            height: 100px ;
        }
        td 
        {          
            text-align: center;
            vertical-align: middle;
            
        }
        .img_td{
            width: 100px;
        }
        tr
        {
            text-align: center;
        }
    </style>
</head>

</head>
<body>
<div class="manageProduct w-100 mt-3 px-3 ">  
    <div class='container py-3 '>
        <div class="row m-3 ">
            <div class="col-8">
                <p <?php echo $admFlag; ?> class='h1 text-primary text-bold'>Adopt a beautiful creature</p>
                <p <?php echo $userFlag; ?> class='h1 text-success text-bold'>(Admin Panel) Pets List</p>        
            </div>
            <div class="col-4">
                <a href= "create.php"><button <?php echo $userFlag; ?> class='btn btn-primary'type="button" >Add Pet</button></a>
                <a href= "<?php echo $backBtn?>">
                    <button class="btn btn-warning" type="button">Back</button>
                </a>
                <a href= "<?php echo 'seniors.php'?>">
                    <button class="btn btn-success" type="button">Seniors</button>
                </a>
                <a href= "<?php echo 'adopt.php'?>">
                    <button class="btn btn-dark" type="button">Adoption</button>
                </a>
            </div>
        </div>
    </div>
   
   <table class='table table-striped'>
       <thead class='table-success'>
           <tr>
               <th style="width: 15%">Picture</th>
               <th style="width: 3%">Pet Name</th>
               <th style="width: 12%">City</th>
               <th style="width: 11%">Address</th>
               <th style="width:  7%">Zip</th>
               <th style="width:  3%">Age</th>
               <th style="width:  11%">Description</th>
               <th style="width:  11%">Hobbies</th>
               <th style="width:  10%">Breed</th>
               <th style="width:  3%">Size</th>
               <th style="width:  7%">status</th>
               <th style="width:  7%">Action</th>
           </tr>
       </thead>
       <tbody>
          <?= $tbody; ?>
       </tbody>
   </table>
</div>

</body>
</html>


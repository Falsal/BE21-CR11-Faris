<?php
// Both user and adm are ONLY able to view the senior animals
session_start();
require_once('../components/db_connect.php');

// ======== validating user/admin session and assigning userType ========= 
if(!isset($_SESSION['adm'])){
    if(isset($_SESSION['user']))
    {
        $userType="user";
        // echo "line 10_user Type is : ".$userType."<br>";
    }
    else {
        header("Location: ../index.php");
    }
}else 
{
    $userType='adm';
    // echo " line20..user Type is : ".$userType."<br>";
}

//// BACK BUTTON:
//=================create a back button to home.php============
if(isset($_SESSION["user"])){
    $backBtn = "../home.php";    
}
//=================create a back button to dashboard.php============
if(isset($_SESSION["adm"])){
    $backBtn = "../dashBoard.php";    
}

$admFlag='';
$userFlag='';
if($userType=='user' ) {
    $userFlag='hidden';
    // echo "..userFlag  line 30: ".$userFlag."<br>";
}

if($userType=='adm'){
    $admFlag='hidden';
    // echo "<br> line34.. userType is : ".$userType."... and admFlag is :".$admFlag."<br>";
 
}
//================ disabled state =================
$disabled='';

// =============== Back Button ====================
$backBtn = "index.php";

// ======== fetching data from DB ========= 

$sql="SELECT * FROM animals WHERE age >8"; // query variable

$result=mysqli_query($connect,$sql); //execute query

// $row=mysqli_fetch_array($result,MYSQLI_ASSOC); //turn result into array

$tbody =''; // initialize var to carry the row/array/columns 

if(mysqli_num_rows($result)  > 0) { 
    //turn result into array
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
        if($row['status'] =='adopted'){
            $disabled='disabled';
         } else{ $disabled='' ;}
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
                <button  $admFlag $disabled class='btn btn-success btn-sm' type='button'>Take me home</button>
                </a>
            </td>
         </tr>";
        // echo "...Car ID :".$row['id'];
        };
    } else  {
        $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
            };


$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seniors</title>
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
<body>
<div class="manageProduct w-100 mt-3 px-3 ">  
    <div class='container py-3 '>
        <div class="row m-3 ">
            <div class="col-8">
                <p <?php echo $admFlag; ?> class='h1 text-primary text-bold'>Welcome to our Seniors home </p>
                <p <?php echo $userFlag; ?> class='h1 text-success text-bold'>(Admin Panel) Senior Pets List</p>        
            </div>
            <div class="col-4">
          
                <a href= "<?php echo $backBtn?>">
                    <button class="btn btn-warning" type="button">Back</button>
                </a>
            </div>
        </div>
    </div>
   
   <table class='table table-striped'>
       <thead class='table-warning'>
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




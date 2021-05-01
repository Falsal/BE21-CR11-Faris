 
<?php 
// echo "session id is :".session_id();

session_start();
require_once '../components/db_connect.php';

$userType='';

if(!isset($_SESSION['adm'])){
    if(isset($_SESSION['user']))
    {
        $userType="user";
        // echo "user is ".$_SESSION['user'];
    }
    else {
        header("Location: ../index.php");
    }
}else 
{
    // print_r(".line 21 admin session with ID :".$_SESSION['adm']."<br>");
    $userType='adm';
    // echo "user Type is : line20 ".$userType."<br>";
}

// ======== user session valid so make del and edit buttons disappear ========= 
$admFlag='';
$userFlag='';
if($userType=='user' ) {
    $userFlag='hidden';
    // echo "..userFlag  line 31: ".$userFlag."<br>";
}

if($userType=='adm'){
    $admFlag='hidden';
    // echo "<br> userType is : line36".$userType."<br>";
    
}


// =============== Back Button ====================

$backBtn = '';
//if it is a adm it will create a back button to dashboard.php
//
  // DISPLAY for ADMIN only =======================================
if(isset($_SESSION["adm"])){
    // echo "<br>line46, session is : ".$_SESSION["adm"]."<br>";
    $backBtn = "../dashBoard.php";    
    $tbody="";
    if (isset($_SESSION["adm"])){
        $sql="SELECT 
        petadoption.id as petadoption_id, petadoption.fk_user_id as userId,petadoption.fk_pet_id as petId,  animals.status as adoption_status, animals.pet_name as pet_name FROM petadoption JOIN animals WHERE petadoption.fk_pet_id=animals.pet_id";
        $result = mysqli_query($connect ,$sql);
        if(mysqli_num_rows($result)  > 0) {     
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){         
               $tbody .= "<tr>
               <td>" .$row['petadoption_id']."</td>
               <td>" .$row['userId']."</td>
               <td>" .$row['petId']."</td>
               <td>" .$row['pet_name']."</td>
               <td>" .$row['adoption_status']."</td>
               </tr>";
               };
       } else  {
           $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
        }
    }
}
//the GET method will show the info from the booking table to be displayed

// case ADMIN: --> display ALL petAdoption table
// case USER: get id of user from session
//     diplay ONLY Adoptions of this particular user

//if it is a user it will create a back button to home.php
$user_id=0;
if(isset($_SESSION["user"])){
    $backBtn = "../home.php";    
    if ($_GET['id']) {
        $id = $_GET['id'];  //   PET ID
        $user_id=$_SESSION['user'];  // USER ID
        // echo "..L85 ids pet/user :".$id."--".$user_id;

        // Find if animal is already in petAdoption table
        
        $records="SELECT petadoption.id ,petadoption.fk_user_id,animals.pet_name, animals.status FROM petadoption JOIN animals WHERE fk_pet_id=$id";
        // print_r($records);
        
        // execute query
        $result=mysqli_query($connect,$records);
        
        $recordCount=mysqli_num_rows($result);
        // echo "<br> L94, count is  :".$recordCount."<br>";
        $noRecord=$recordCount == 0;
        mysqli_free_result($result); //initialize $ result var
        // echo "<br> L97,  $ norecord is  :".$noRecord."<br>";
        
        // IF THIS RECORD DOES NOT EXIST THEN INSERT
        if($noRecord){
            $sql = "INSERT INTO petadoption (fk_user_id,fk_pet_id) VALUES ($user_id,$id)";
            mysqli_query($connect,$sql);
            
            // change status of pet in animals table
            $sql2= "INSERT INTO animals (animals.status) VALUES ('adopted') WHERE animals.pet_id=$id";

        }else 
        echo "This pet is already adopted by a user";
    };
    // DISPLAY for USER only =======================================
    $tbody ='';

    if (isset($_SESSION["user"])){

        // select all records belonging to this user and display them
        // echo "..L113 userId ->".$user_id;
        $sql="SELECT 
        petadoption.id as petadoption_id, petadoption.fk_user_id as userId,petadoption.fk_pet_id as petId, animals.pet_name as pet_name FROM  petadoption JOIN animals  WHERE petadoption.fk_user_id=$user_id and animals.pet_id=petadoption.fk_pet_id GROUP BY petadoption.fk_pet_id";

        $result = mysqli_query($connect ,$sql);
        if(mysqli_num_rows($result)  > 0) {     
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            //    $row['car_status']='out';         
               $tbody .= "<tr class='justify-content-center'>
               <td>" .$row['petadoption_id']."</td>
               <td>" .$row['petId']."</td>
               <td>" .$row['pet_name']."</td>

               </tr>";
               
                //    echo "...Car ID :".$row['id'];
               };
       } else  {
           $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
       }
    }
}
   
// echo "__L126-> User ID :".$user_id;
$connect->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption</title>
    <?php require_once '../components/boot.php' ?>
    <style type="text/css">
        .manageProduct {           
            margin: auto;
        }
        .img-thumbnail{
            width: 70px !important;
            height: 70px !important;
        }
        td 
        {          
            text-align: center;
            vertical-align: middle;
        }
        tr
        {
            text-align: center;
        }
    </style>
</head>

</head>
<body>
<div class="manageProduct w-75 mt-3">    
   <div class='mb-3'>
    <a href= "<?php echo $backBtn?>">
    <button class="btn btn-warning" type="button">Back</button></a>
   </div>
   <p <?php echo $userFlag; ?> class='h2'>Adptions (Admin)</p>
   <p <?php echo $admFlag; ?> class='h2'>Pet adopted by : <?php echo $user_id; ?> </p>
   
   <table class='table table-striped '>
       <thead class='table-success'>
           <tr>
               <th>AdoptionID</th>
               <th <?php echo $userFlag; ?>>UserID</th>
               <th>PetID</th>
               <th>Pet Name</th>
               <th <?php echo $userFlag; ?> >Pet Status</th>
            </tr>
       </thead>
       <tbody class="container">
          <?= $tbody; ?>
       </tbody>
   </table>
</div>

</body>
</html>


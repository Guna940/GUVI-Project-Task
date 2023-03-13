<?php

$name = $_POST['name'];
$email  = $_POST['email'];
$age = $_POST['age'];
$dob = $_POST['dob'];
$phno = $_POST['phno'];
$upswd1 = $_POST['password'];
$upswd2 = $_POST['upswd2'];

require_once __DIR__ . 'C:\xampp\htdocs\GUVI-Project-master\assets\vendor\autoload.php';
$con = new MongoDB\Client("mongodb://localhost:27017");
$db = $con->guvi_db;
$c = $db->collection;
$client = new MongoDB\Client('mongodb+srv://gunanithi940:Guna2003@cluster0.uwbhlvx.mongodb.net/test');
$db = $client->guvi;
$c = $db->guvi_db;



if (!empty($email) || !empty($upswd1)  )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "guvi_db";



// Create connection
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else if($upswd1 != $upswd2)
{
  echo "Password and Confirm-password are dismatched..!";
}
else if($upswd1 == $upswd2){

  $SELECT = "SELECT * From `register` Where email = ? Limit 1";
  $INSERT = "INSERT INTO `register` ('name','email','age','dob','phno','upswd1','upswd2' )values(?,?,?,?,?,?,?)";
  
//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $rs=mysqli_query($conn,$INSERT);
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssssss",$name,$email,$age,$dob,$phno,$upswd1,$upswd2);
      $stmt->execute();
      $stmt->bind_result($name,$email,$age,$dob,$phno,$upswd1,$upswd2);
      $stmt->store_result();
      $rnum = $stmt->num_rows;


// sending information in Mangodb database
      $c->insertOne(["Name" => $name,
                     "email" => $email,
                     "password" => $upswd1,
                     "Age" => $age, 
                     "DOB" => $dob, 
                     "Phone_number" => $phno]
                  );

      echo "<script> New record inserted sucessfully </script>";

     }
    else 
    {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close(); 
    }
}
else 
{
 echo "All field are required";
 die();
}

?>
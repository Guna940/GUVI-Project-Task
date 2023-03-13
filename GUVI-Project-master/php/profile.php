<?php
session_start();
$email= $_SESSION['email'];

require_once __DIR__ . '...\assets\vendor\autoload.php';
//require_once __DIR__ . 'GUVI-Project-master\assets\vendor\autoload.php';

$client = new MongoDB\Client('mongodb+srv://gunanithi940:Guna2003@cluster0.uwbhlvx.mongodb.net/test');
 
 $db = $client->guvi;
 
 
 $c = $db->guvi_db;
 $con = new MongoDB\Client("mongodb://localhost:27017");
 $db = $con->guvi;
 $c = $db->collection;
 echo $email;
 $cursor = $c->find();

// for selected user information getting
 foreach ($cursor as $document) {
    if($email == $document["email"])
    {

      echo '<tr>
      <td>'. $document["Name"] .'</td>
      <td>'.$document["email"].'</td>
      <td>'.$document["Age"].'</td>
      <td>'.$document["DOB"].'</td> 
      <td>'.$document["Phone_number"].'</td>
      </tr>';
    }


 }
 ?>



 
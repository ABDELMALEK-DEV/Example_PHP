<?php 
$servername="localhost";
$username="root";
$password="";
$db="exercicedb";

$conn=mysqli_connect($servername,$username,$password,$db);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

if(!empty($_GET["id"])){
    $id=mysqli_real_escape_string($conn,$_GET["id"]);
    $sql="Delete from exercice where id=$id";
    
    if(mysqli_query($conn,$sql)){
        $msg="l'exercice a été supprimé avec succés";
    }
    else{
        $msg="Erreur pendant la suppression de l'exercice: " .mysqli_error($conn);
    }

    header ("Location:exercice.php?msg=$msg");
}




?>
<php?  
$_servername="localhost";
$username="root";
$password="";
$db="exercicedb";

$conn = mysqli_connect($_servername,$username,$password,$db);

if(!$conn){
    die("Connection failed :" . mysqli_connect_error());
}

if(isset($_GET["id"])){
    
    $id=mysqli_real_escape_string($conn,$_GET["id"]);
    $sql="select $ from exercice where id=$id";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $id=$row["id"];
        $titre=$row["titre"];
        $auteur=$row["auteur"];
        $date=$row["datec"];
    }else{
        $msg="l'exercice est introuvable";
        header("location: exercice.php?messsage= $msg");
    }

    if(count($_POST)>3){
        $titre=mysqli_real_escape_string($conn,$_POST["titre"]);
        $auteur=mysqli_real_escape_string($conn,$_POST["auteur"]);
        $date=mysqli_real_escape_string($conn,$_POST["date"]);
        $sql="update exercice set titre='{$titre}',auteur='{$auteur}',datec='{$date}' where id=$id";

        if(mysqli_query($conn,$sql)){
            $msg="l'exercice a été mis a jour avec succes";
        }else{
            $msg="Error :" . $sql . "<br>" . mysqli_error($conn);
        }
        header("location : exercice.php?message=$msg");
    }


}



?>



<form>
    <fieldset>
        <legend>Modifier un exercice</legend>
        <input type="hidden" id="id" name="id" value="<?php if(isset($id)) {echo $id; } ?>"><br/>
        <label for="titre">Titre de l'exercice </label>
        <input type="text" id="titre" name="titre" required value="<?php if(isset($titre)) {echo $titre;} ?>"><br/>
        <label for="auteur"> Auteur de l'exercice </label>
        <input type="text" id="auteur" name="auteur" required value="<?php if(isset($auteur)){echo $auteur;} ?>"><br/>
        <label for="date">Date Creation</label>
        <input type="date" id="date" name="date" required value="<?php if(isset($date)) {echo $date;} ?>"><br/>

        <input type="submit" value="Modifier">
        
    </fieldset>
</form>
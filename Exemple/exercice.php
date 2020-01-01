<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice PHP</title>
<?php 
$servername="localhost";
$username="root";
$password="";
$dbname="exercicedb";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    die("Connection failed:" . mysqli_connect_error());
}

//ajouter
if(count($_POST)>2){
    $titre=mysqli_real_escape_string($conn,$_POST["titre"]);
    $auteur=mysqli_real_escape_string($conn,$_POST["auteur"]);
    $date=mysqli_real_escape_string($conn,$_POST["date"]);

    $sql="INSERT INTO exercice (titre,auteur,datec) values ('{$titre}','{$auteur}','{$date}')";

    if(mysqli_query($conn,$sql)){
      $msg="l'exercice a été ajouté avec succes";
    }
    else
    {
        $msg="Error: " . $sql . "<br>" . mysqli_error($conn); 
    }
}

if(isset($_GET["msg"])){
    $msg=$_GET["msg"];
}

?>



</head>
<body>

<?php if(isset($msg)) {echo "<div class='msg'>".$msg."</div>";} ?>
    <div class="form">
    <form name="exercice" action="exercice.php" method="post">
     <fieldset>
        <legend>Ajouter Un Exercice</legend>
      <label for="titre">Titre de l'exercice</label>
      <input type="text" id="titre" name="titre" required autofocus><br/>
      <label for="auteur">Auteur de l'exercice</label>
      <input type="text" id="auteur" name="auteur" required><br/>
      <label for="date">Date Creation</label>
      <input type="date" id="date" name="date" required placeholder="YYYY/MM/DD"><br/>
      <input type="submit" value="Envoyer">
      </fieldset>
      </form>
    </div>

    <div class="table">
      <table cellspacing="0">
        <thead>
          <tr>
           <th>id</th>
           <th>titre</th>
           <th>auteur</th>
           <th>date</th>
           <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
           <?php 
                $sql="select $ from exercice";
                $result=mysqli_query($conn,$sql);
                
                if(mysqli_num_rows($result)>0){

                    while($row=mysqli_fetch_assoc($result)){
                         echo "<tr><td>" . $row["id"] . "</td><td>" . $row["titre"] . "</td><td>" . $row["auteur"] . "</td><td>" . $row["datec"]
                         ."</td><td><a href=\"modification.php?id=" . $row["id"] . "\"> Modification </a></td>"
                         ."</td><td><a href=\"supprimer.php?id=" .$row["id"]. "\" onclick=\"return confirm('Vous Voulez Vraiment Supprimer cet exercice')\">Supprimer</a></td></tr>";
                    }
                }
           ?>
        </tbody>
      </table>
    </div>
</body>
</html>
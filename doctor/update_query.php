<?php
  include '../connect.php';

  echo "in it";
 
  if(ISSET($_POST['updateDoctor'])){
    echo "       in it2";
            $id = mysqli_real_escape_string($linkDB, $_POST['idid']);
            $nom = mysqli_real_escape_string($linkDB, $_POST['nom']);
            $titre = mysqli_real_escape_string($linkDB, $_POST['titre']);
            $username = mysqli_real_escape_string($linkDB, $_POST['username']);
            $email = mysqli_real_escape_string($linkDB, $_POST['email']);
            $experience = mysqli_real_escape_string($linkDB, $_POST['experience']);
            
            if ($_POST['status']== 'on'){
                $status = mysqli_real_escape_string($linkDB, '1');
            }else{
                $status = mysqli_real_escape_string($linkDB, '0');
            }
    echo $id.''.$nom;
   $update= "UPDATE `docteur` SET `nom` = '$nom', `username` = '$username', `titre` = '$titre', `experience` = '$experience', `status` = '$status' WHERE `docteur`.`id` = '$id'";
 
   $result= mysqli_query($linkDB, $update);
   if($result){
    header("location: medecin.php");
   }
    echo "papa nonfonfon";
  }
?>
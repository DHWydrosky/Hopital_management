<?php
  include '../connect.php';

  echo "in it";
 
  if(ISSET($_POST['updatePatient'])){
    echo "       in it2";
            $id = mysqli_real_escape_string($linkDB, $_POST['idid']);
            $nom = mysqli_real_escape_string($linkDB, $_POST['nom']);
            $datenaissance = mysqli_real_escape_string($linkDB, $_POST['date-naissance']);
            $sexe=mysqli_real_escape_string($linkDB, $_POST['sexe']);
            $username = mysqli_real_escape_string($linkDB, $_POST['username']);
            $email = mysqli_real_escape_string($linkDB, $_POST['email']);
            $password = mysqli_real_escape_string($linkDB, $_POST['password']);
            $adresse = mysqli_real_escape_string($linkDB, $_POST['adresse']);
            $groupe = mysqli_real_escape_string($linkDB, $_POST['groupe']);
            $adresse = mysqli_real_escape_string($linkDB, $_POST['adresse']);
            $tel = mysqli_real_escape_string($linkDB, $_POST['tel']);
            $docteur = mysqli_real_escape_string($linkDB, $_POST['docteur']);
            $dateadmis = mysqli_real_escape_string($linkDB, $_POST['date-admis']);
            $datesortie = mysqli_real_escape_string($linkDB, $_POST['date-sortie']);
            
            if ($_POST['status']== 'on'){
                $status = mysqli_real_escape_string($linkDB, '1');
            }else{
                $status = mysqli_real_escape_string($linkDB, '0');
            }

    echo $id.''.$nom;
   $updatePatient= "UPDATE `patient` SET `nom` = '$nom', `username` = '$username', `date_naissance` = '$datenaissance', `date_admis` = '$dateadmis', `date_sortie` = '$datesortie', `adresse` = '$adresse', `tel` = '$tel', `groupe_sanguin` = '$groupe', `sexe` = '$sexe', `status` = '$status', `doctor_id` = '$docteur' WHERE `patient`.`id` = $id";
 
   $result= mysqli_query($linkDB, $updatePatient);
   if($result){
    header("location: patientview.php");
   }
    echo "papa nonfonfon";
  }
?>
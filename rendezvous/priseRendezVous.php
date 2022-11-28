<?php
       // session_start();
        // //------ PHP code for User registration form---
        // $error = "";
        
        include '../connect.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $patient= mysqli_real_escape_string($linkDB, $_POST['patient']);
            $docteur = mysqli_real_escape_string($linkDB, $_POST['docteur']);
            $debut = mysqli_real_escape_string($linkDB, $_POST['datedebut']);
            $fin = mysqli_real_escape_string($linkDB, $_POST['datefin']);
            $motif = mysqli_real_escape_string($linkDB, $_POST['motif']);

            
            $addQuery="INSERT INTO `priserendezvous` ( `datedebut`, `datefin`, `patientid`, `docteurid`, `motif`) VALUES ('$debut', '$fin', '$patient', '$docteur', '$motif')";
            $result = mysqli_query($linkDB,$addQuery);

            if($result){
                echo "reussi";
                header("location: ../patient/patientview.php"); 
                exit();     
            }else{
                echo "non";
            }



        }

   ?>
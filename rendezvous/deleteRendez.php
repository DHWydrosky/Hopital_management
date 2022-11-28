<?php

	if (isset($_GET['id']))
	{
		echo 'in detl';
       include '../connect.php';
        
		$id = $_GET['id'];
        
		$result=mysqli_query($linkDB, "DELETE FROM `priserendezvous` WHERE rendezID = $id ");
            if($result){
                 header("location: ../patient/patientview.php");    
            }
            else{
                die("pa delete");
            }
}
?>
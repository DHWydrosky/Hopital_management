<?php

	if (isset($_GET['id']))
	{
		
       include '../connect.php';
        
		$id = $_GET['id'];
        
		$result=mysqli_query($linkDB, "DELETE FROM `patient` WHERE id = $id ");
            if($result){
                 header("location: patientview.php");    
            }
            else{
                die("pa delete");
            }
}
?>
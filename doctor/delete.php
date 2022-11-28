<?php

	if (isset($_GET['id']))
	{
		
        include '../connect.php';
        
		$id = $_GET['id'];
        
		$result=mysqli_query($linkDB, "DELETE FROM `docteur` WHERE id = $id ");
            if($result){
                 header("location: medecin.php");    
            }
            else{
                die("pa delete");
            }
}
?>
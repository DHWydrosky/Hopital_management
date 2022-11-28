<?php include 'common/head.php'?>

<?php include 'connect.php' ?>
<?php $type= 0 ?>
<?php include_once 'common/navbar.php'?>

<?php

	if (isset($_GET['id']))
	{
		
       include 'connect.php';
        
		$id = $_GET['id'];
        
		$result=mysqli_query($linkDB, "SELECT patient.*, docteur.id as `idoc`, docteur.nom as `docteurnom` FROM `patient` INNER JOIN `docteur` ON patient.doctor_id=docteur.id WHERE patient.id='$id'; ");
            if($result){
                while($row = mysqli_fetch_array($result))
				{ $id=$row['id'];
   ?>


<section class="container">
    <div class="row list-el col-12 pt-4">
        <div class="col-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><small class="fw-bold fs-6">Patient: </small> <?php echo $row['nom']?></h5>
                    <p class="card-text"><small class="fw-bold fs-6"> Date de naissance</small>
                        <?php echo $row['date_naissance']?></p>
                    <p class="card-text"><small class="fw-bold fs-6"> Sexe</small> <?php echo $row['sexe']?></p>
                    <p class="card-text"><small class="fw-bold fs-6"> username</small> <?php echo $row['username']?></p>
                    <p class="card-text"><small class="fw-bold fs-6"> adresse</small> <?php echo $row['adresse']?></p>
                    <p class="card-text"><small class="fw-bold fs-6"> tel</small> <?php echo $row['tel']?></p>
                    <p class="card-text"><small class="fw-bold fs-6"> groupe sanguin</small>
                        <?php echo $row['groupe_sanguin']?></p>
                    <p class="card-text"><small class="fw-bold fs-6"> docteur</small> <?php echo $row['docteurnom']?>
                    </p>
                    <p class="card-text"><small class="fw-bold fs-6"> date admise</small>
                        <?php echo $row['date-admis']?></p>
                    <p class="card-text"><small class="fw-bold fs-6"> date de sortie</small>
                        <?php echo $row['date_sortie']?></p>
                    <p class="card-text"><small class="fw-bold fs-6"> status</small>
                        <?php if($row['status']=='1') {echo 'active';}else{echo "inactive";} ?></p>

                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="list-group">
                <?php
                            $selectAllDoctorQuery = mysqli_query($linkDB, "SELECT priserendezvous.*, docteur.id as `idoc`, docteur.nom as `docteurnom`, patient.id as `patientid`, patient.nom as `patientnom` FROM `priserendezvous` JOIN `docteur` ON priserendezvous.docteurid=docteur.id INNER JOIN `patient` ON priserendezvous.patientid=patient.id WHERE priserendezvous.patientid= '$id' ORDER BY `priserendezvous`.`datedebut` ASC;"); // SQL Query
                           
                            if(!$selectAllDoctorQuery>0){
                                echo 'aucun rendez vous';
                            }
                            while($rendez = mysqli_fetch_array($selectAllDoctorQuery))
                            {
                        ?>

                <div class="list-group-item list-group-item-action active mt-3 py-2" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Rendez vous pour <?php echo $rendez['motif']?> </h5>
                        <small type="button" onclick="confirmerDeleteRendez(<?php echo $rendez['rendezID']?>)"> X
                        </small>
                    </div>
                    <p class="mb-1">Patient; <?php echo $rendez['patientnom']?></p>
                    <p class="mb-1">Docteur; <?php echo $rendez['docteurnom']?></p>
                    <small>date debut; <?php echo $rendez['datedebut']?></small>
                    <small>date fin; <?php echo $rendez['datefin']?></small>
                </div>

                <?php }?>
            </div>
        </div>
        <div class="col-4">
            <form>
                <?php
                        
                       echo $id;
                            $selectAllPrescQuery = mysqli_query($linkDB, "SELECT * FROM `prescription` WHERE prescription.patientid=$id;"); // SQL Query
                            if(mysqli_num_rows($selectAllPrescQuery)==0){
                                echo "<h5>pas de prescription</h5>"; 
                            }
                            while($presc = mysqli_fetch_array($selectAllPrescQuery))
                            {
                        ?>

                <div class="form-group mt-2">
                    <label for="title">Votre prescription de la date du <?php echo $presc['dateemise']?></label>
                    <textarea class="form-control" name="presc" id="presc" rows="3"
                        readonly><?php echo $presc['presc']?></textarea>
                </div>
                <?php }?>
            </form>
        </div>
    </div>
</section>



<?php
                }
            }
            else{
                echo "vide";
            }
}
?>


<?php include '../common/footer.php'?>
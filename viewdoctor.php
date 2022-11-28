<?php include 'common/head.php'?>

<?php include 'connect.php' ?>
<?php $type=0 ?>
<?php include_once 'common/navbar.php'?>




<?php

        if (isset($_GET['id']))
        {
            
        
        
		$id = $_GET['id'];
        $docot=mysqli_query($linkDB, "Select * from `docteur` WHERE id=$id ");
        while($r = mysqli_fetch_array($docot)){
        ?>



<h4>Bonjour Docteur <?php echo $r['nom']; ?></h1>
    <section class="container">
        <div class="row list-el pt-4">
            <div class="col-6">
                <div class="mb-2">
                    <button type="button" class="offset-10 btn btn-warning bout" data-bs-toggle="modal"
                        data-bs-target="#add">
                        presc
                    </button>
                </div>

                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Liste de vos patient

                    </li>


                    <?php }
		$result=mysqli_query($linkDB, "Select * from `patient` WHERE doctor_id=$id ");
            if($result){
                while($list = mysqli_fetch_array($result))
				{ 
        ?>

                    <li class="list-group-item"><?php echo $list['nom'];?> <small class="offset-5 btn-warning "
                            data-bs-toggle="modal" data-bs-target="#profil<?php echo $list['id'];?>">
                            ...
                        </small> </li>
                    <?php
                } 
            }
            else{
                echo "vide";
            }
}
         ?>

                </ul>

            </div>
            <div class="col-6">
                <div class="list-group">
                    <?php
                            $selectAllDoctorQuery = mysqli_query($linkDB, "SELECT priserendezvous.*, docteur.id as `idoc`, docteur.nom as `docteurnom`, patient.id as `patientid`, patient.nom as `patientnom` FROM `priserendezvous` JOIN `docteur` ON priserendezvous.docteurid=docteur.id INNER JOIN `patient` ON priserendezvous.patientid=patient.id WHERE priserendezvous.docteurid= '$id' ORDER BY `priserendezvous`.`datedebut` ASC;"); // SQL Query
                           
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
        </div>
    </section>

    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="ajouterModalel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouterModalel">
                        Donner prescription
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="viewdoctor.php" method="POST">

                        <div class="form-group">
                            <label for="patient">Patient</label>
                            <input type="text" style="display:none;" name="idid" value="<?php echo $id?>">
                            <select class="form-control" name="patient" id="patient">
                                <?php
                            $selectAllDoctorQuery = mysqli_query($linkDB, "Select * from `patient`"); // SQL Query
                            while($patient = mysqli_fetch_array($selectAllDoctorQuery))
                            {
                        ?>
                                <option value="<?php echo $patient['id']?>">
                                    <?php echo $patient['nom']?>
                                </option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Votre prescription</label>
                            <textarea class="form-control" name="presc" id="presc" rows="7"></textarea>
                        </div>

                        <input type="submit" name="addPresc" class="btn btn-primary" value="Add Presc" />

                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php



       // session_start();
        // //------ PHP code for User registration form---
        // $error = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $patient = mysqli_real_escape_string($linkDB, $_POST['patient']);
            $presc = mysqli_real_escape_string($linkDB, $_POST['presc']);
            
           $idd=  mysqli_real_escape_string($linkDB, $_POST['idid']);
            
            
           

            echo "Username entered is: ". $patient . "<br/>";
            echo "status entered is: ". $presc . "<br/>";
            echo "nom entered is: ". $idd . "<br/>";
           
           
           
            $addPrescQuery="INSERT INTO `prescription` ( `patientid`, `presc`, `docteurid`) VALUES ( '$patient', '$presc', '$idd')";
            
            $result = mysqli_query($linkDB, $addPrescQuery);

            if($result){
                echo "reussi";
               print '<script>window.location.assign("viewdoctor.php?id="+'.$idd.');</script>';; 
               exit();     
            }else{
                echo "non";
            }



        }

   ?>

    <!-- Boocle d'info -->
    <?php
				$query = mysqli_query($linkDB, "Select * from `patient` WHERE doctor_id=$id"); // SQL Query
				while($row = mysqli_fetch_array($query))
				{
                    ?>
    <div class="modal fade" id="profil<?php echo $row['id']?>" tabindex="-1" aria-labelledby="ajouterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouterModalLabel">
                        information du patient
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>

                        <div class="form-group">
                            <label for="name<?php echo $row['id']?>">Nom</label>
                            <input type="text" name="nom" class="form-control" id="name<?php echo $row['id']?>"
                                value="<?php echo $row['nom']?>" readonly>
                            <input type="text" style="display:none;" name="idid" value="<?php echo $row['id']?>">
                        </div>
                        <div class="form-group">
                            <label for="date-naissance<?php echo $row['id']?>">Date de naissance</label>
                            <input type="date" name="date-naissance" class="form-control"
                                id="date-naissance<?php echo $row['id']?>" value="<?php echo $row['date_naissance']?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="sexe<?php echo $row['id']?>">Sexe</label>
                            <input type="text" name="sexe" class="form-control" id="sexe<?php echo $row['id']?>"
                                value="<?php echo $row['sexe']?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email<?php echo $row['id']?>">Email</label>
                            <input type="email" name="email" class="form-control" id="email<?php echo $row['id']?>"
                                aria-describedby="emailHelp" readonly>
                        </div>
                        <div class="form-group">
                            <label for="username<?php echo $row['id']?>">username</label>
                            <input type="text" name="username" class="form-control" id="username<?php echo $row['id']?>"
                                value="<?php echo $row['username']?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="adresse<?php echo $row['id']?>">Adresse</label>
                            <input type="text" name="adresse" class="form-control" id="adresse<?php echo $row['id']?>"
                                value="<?php echo $row['adresse']?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tel<?php echo $row['id']?>">Tel</label>
                            <input type="text" name="tel" class="form-control" id="tel<?php echo $row['id']?>"
                                value="<?php echo $row['tel']?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="groupe<?php echo $row['id']?>">Groupe Sanguin</label>
                            <input type="text" name="groupe" class="form-control" id="groupe<?php echo $row['id']?>"
                                value="<?php echo $row['groupe_sanguin']?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date-admis<?php echo $row['id']?>">Date admise</label>
                            <input type="date" name="date-admis" class="form-control"
                                id="date-admis<?php echo $row['id']?>" value="<?php echo $row['date_admis']?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="date-sortie<?php echo $row['id']?>">Date sortie</label>
                            <input type="date" name="date-sortie" class="form-control"
                                id="date-sortie<?php echo $row['id']?>" value="<?php echo $row['date_sortie']?>"
                                readonly>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" name="status" class="form-check-input"
                                value="<?php if($row['status']=='1') echo 'yes' ?>" id="status<?php echo $row['id']?>"
                                <?php if($row['status']=='1') echo 'checked="checked"'; ?> readonly>
                            <label class="form-check-label" for="status<?php echo $row['id']?>">Status</label>
                        </div>

                        <?php
                        $pid = $row['id'];
                       
                            $selectAllPrescQuery = mysqli_query($linkDB, "SELECT * FROM `prescription` WHERE prescription.patientid=$pid;"); // SQL Query
                            if(mysqli_num_rows($selectAllPrescQuery)==0){
                                echo '<h5 class=" mt-2">pas de prescription</h5>'; 
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
        </div>
    </div>




    <?php }?>

    <?php include 'common/footer.php'?>
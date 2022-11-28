<?php include '../common/head.php'?>
<?php $type='admin' ?>
<?php include '../connect.php' ?>
<?php include_once '../common/navbar.php'?>

<h1>gestion des patient</h1>

<section class="container">
    <div class="row list-el pt-4 justify-content-between">
        <div class="col-8">
            <div class="mb-2">
                <button type="button" class="col-2 offset-10 btn btn-primary bout" data-bs-toggle="modal"
                    data-bs-target="#ajouterPatient">
                    Ajouter
                </button>
            </div>
            <div class="mb-2">
                <button type="button" class="col-2 offset-10 btn btn-primary bout" data-bs-toggle="modal"
                    data-bs-target="#prendreRendezvous">
                    Ajouter Rendez-vous
                </button>
            </div>
            <div class="col-">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Date de naissance</th>
                            <th scope="col">Sexe</th>
                            <th scope="col">adresse</th>
                            <th scope="col">telephone</th>
                            <th scope="col">groupe sanguin</th>
                            <th scope="col">docteur resp</th>
                            <th scope="col">date admise</th>
                            <th scope="col">date sortie</th>
                            <th scope="col">status</th>
                            <th scope="col" colspan="2">Action</th>

                        </tr>
                    </thead>
                    <tbody id="sites-table">

                        <?php
				// $selectAllPatientQuery = mysqli_query($linkDB, "Select * from `patient`"); // SQL Query
                $test="SELECT patient.*, docteur.id as `idoc`, docteur.nom as `docteurnom` FROM `patient` INNER JOIN `docteur` ON patient.doctor_id=docteur.id; ";
                $selectAllPatientQuery = mysqli_query($linkDB,$test);
				while($row = mysqli_fetch_array($selectAllPatientQuery))
				{
                    ?>
                        <tr>
                            <td style="text-align:center;"> <?php echo $row['nom']?> </td>
                            <td style="text-align:center;"><?php echo $row['date_naissance']?></td>
                            <td style="text-align:center;"><?php echo $row['sexe']?></td>
                            <td style="text-align:center;"><?php echo $row['adresse']?></td>
                            <td style="text-align:center;"><?php echo $row['tel']?></td>
                            <td style="text-align:center;"><?php echo $row['groupe_sanguin']?></td>
                            <td style="text-align:center;"><?php echo $row['docteurnom']?></td>
                            <td style="text-align:center;"><?php echo $row['date_admis']?></td>
                            <td style="text-align:center;"><?php echo $row['date_sortie']?></td>
                            <td style="text-align:center;"><?php echo $row['status']?></td>
                            <td style="text-align:center;"><button class="btn btn-warning bout" data-bs-toggle="modal"
                                    type="button" data-bs-target="#updatePatient_modal<?php echo $row['id']?>"> edit
                                </button>
                            </td>
                            <td style="text-align:center;"><button class="btn btn-warning bout"
                                    onclick="confirmerDeletePatient(<?php echo $row['id']?>)">delete </button> </td>

                        </tr>
                        <?php } ?>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 ">
            <div class="list-group">
                <?php
                            $selectAllDoctorQuery = mysqli_query($linkDB, "SELECT priserendezvous.*, docteur.id as `idoc`, docteur.nom as `docteurnom`, patient.id as `patientid`, patient.nom as `patientnom` FROM `priserendezvous` INNER JOIN `docteur` ON priserendezvous.docteurid=docteur.id INNER JOIN `patient` ON priserendezvous.patientid=patient.id ORDER BY `priserendezvous`.`datedebut` ASC;"); // SQL Query
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
<script>
function confirmerDeletePatient(id) {
    let r = confirm("Are you sure you want to delete this record?");
    if (r == true) {
        window.location.assign("deletePatient.php?id=" + id);
    }
}

function confirmerDeleteRendez(id) {
    let r = confirm("Are you sure you want to delete this record?");
    if (r == true) {
        window.location.assign("../rendezvous/deleteRendez.php?id=" + id);
    }
}
</script>



<!-- modal ajouter un patient-->


<div class="modal fade" id="ajouterPatient" tabindex="-1" aria-labelledby="ajouterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajouterModalLabel">
                    Ajouter un patient
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="patientview.php" method="POST">

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" name="nom" class="form-control" id="name" placeholder="Entrer votre nom">
                    </div>
                    <div class="form-group">
                        <label for="date-naissance">Date de naissance</label>
                        <input type="date" name="date-naissance" class="form-control" id="date-naissance"
                            placeholder="Entrer la date de naissance">
                    </div>
                    <div class="form-group">
                        <label for="sexe">Sexe</label>
                        <input type="text" name="sexe" class="form-control" id="sexe" placeholder="Entrer le sexe">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                            placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" name="username" class="form-control" id="username"
                            placeholder="Entrer username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" name="adresse" class="form-control" id="adresse"
                            placeholder="Entrer adresse">
                    </div>
                    <div class="form-group">
                        <label for="tel">Tel</label>
                        <input type="text" name="tel" class="form-control" id="tel" placeholder="Entrer tel">
                    </div>
                    <div class="form-group">
                        <label for="groupe">Groupe Sanguin</label>
                        <input type="text" name="groupe" class="form-control" id="groupe"
                            placeholder="Entrer groupe sanguin">
                    </div>
                    <div class="form-group">
                        <label for="docteur">Docteur resp</label>
                        <select class="form-control" name="docteur" id="docteur">
                            <?php
                            $selectAllDoctorQuery = mysqli_query($linkDB, "Select * from `docteur`"); // SQL Query
                            while($row = mysqli_fetch_array($selectAllDoctorQuery))
                            {
                        ?>
                            <option value="<?php echo $row['id']?>">
                                <?php echo $row['nom']?>
                            </option>

                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date-admis">Date admise</label>
                        <input type="date" name="date-admis" class="form-control" id="date-admis"
                            placeholder="Entrer adresse">
                    </div>
                    <div class="form-group">
                        <label for="date-sortie">Date sortie</label>
                        <input type="date" name="date-sortie" class="form-control" id="date-sortie"
                            placeholder="Entrer date de sortie">
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" name="status" class="form-check-input" id="status">
                        <label class="form-check-label" for="status">Status</label>
                    </div>
                    <input type="submit" name="addPatient" class="btn btn-primary" value="Add Patient" />

                </form>
            </div>
        </div>
    </div>
</div>


<!-- prendre rendez vous -->

<div class="modal fade" id="prendreRendezvous" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">
                    assigner rendez vous a un patient
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../rendezvous/priseRendezVous.php" method="POST">

                    <div class="form-group">
                        <label for="rpatient">Patient</label>
                        <select class="form-control" name="patient" id="rpatient">
                            <?php
                            $selectAllDoctorQuery = mysqli_query($linkDB, "Select * from `patient`"); // SQL Query
                            while($row = mysqli_fetch_array($selectAllDoctorQuery))
                            {
                        ?>
                            <option value="<?php echo $row['id']?>">
                                <?php echo $row['nom']?>
                            </option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="rdocteur">Docteur</label>
                        <select class="form-control" name="docteur" id="rdocteur">
                            <?php
                            $selectAllDoctorQuery = mysqli_query($linkDB, "Select * from `docteur`"); // SQL Query
                            while($row = mysqli_fetch_array($selectAllDoctorQuery))
                            {
                        ?>
                            <option value="<?php echo $row['id']?>">
                                <?php echo $row['nom']?>
                            </option>

                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date-debut">Date debut</label>
                        <input type="datetime-local" name="datedebut" class="form-control" id="date-debut"
                            placeholder="Entrer debut rendez vous">
                    </div>
                    <div class="form-group">
                        <label for="date-fin">Date fin</label>
                        <input type="datetime-local" name="datefin" class="form-control" id="date-fin"
                            placeholder="Entrer fin rendez vous">
                    </div>
                    <div class="form-group">
                        <label for="motif">Motif</label>
                        <input type="text" name="motif" class="form-control" id="motif" aria-describedby="emailHelp"
                            placeholder="motif de ce rendez vous">
                    </div>

                    <input type="submit" name="addRendez" class="btn btn-primary" value="Add Rendez vous" />

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Boocle d'ajout -->
<?php
				$query = mysqli_query($linkDB, "Select * from `patient`"); // SQL Query
				while($row = mysqli_fetch_array($query))
				{
                    ?>
<div class="modal fade" id="updatePatient_modal<?php echo $row['id']?>" tabindex="-1"
    aria-labelledby="ajouterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajouterModalLabel">
                    Ajouter un patient
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="updatePatient.php" method="POST">

                    <div class="form-group">
                        <label for="name<?php echo $row['id']?>">Nom</label>
                        <input type="text" name="nom" class="form-control" id="name<?php echo $row['id']?>"
                            value="<?php echo $row['nom']?>">
                        <input type="text" style="display:none;" name="idid" value="<?php echo $row['id']?>">
                    </div>
                    <div class="form-group">
                        <label for="date-naissance<?php echo $row['id']?>">Date de naissance</label>
                        <input type="date" name="date-naissance" class="form-control"
                            id="date-naissance<?php echo $row['id']?>" value="<?php echo $row['date_naissance']?>">
                    </div>
                    <div class="form-group">
                        <label for="sexe<?php echo $row['id']?>">Sexe</label>
                        <input type="text" name="sexe" class="form-control" id="sexe<?php echo $row['id']?>"
                            value="<?php echo $row['sexe']?>">
                    </div>
                    <div class="form-group">
                        <label for="email<?php echo $row['id']?>">Email</label>
                        <input type="email" name="email" class="form-control" id="email<?php echo $row['id']?>"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="username<?php echo $row['id']?>">username</label>
                        <input type="text" name="username" class="form-control" id="username<?php echo $row['id']?>"
                            value="<?php echo $row['username']?>">
                    </div>
                    <div class="form-group">
                        <label for="adresse<?php echo $row['id']?>">Adresse</label>
                        <input type="text" name="adresse" class="form-control" id="adresse<?php echo $row['id']?>"
                            value="<?php echo $row['adresse']?>">
                    </div>
                    <div class="form-group">
                        <label for="tel<?php echo $row['id']?>">Tel</label>
                        <input type="text" name="tel" class="form-control" id="tel<?php echo $row['id']?>"
                            value="<?php echo $row['tel']?>">
                    </div>
                    <div class="form-group">
                        <label for="groupe<?php echo $row['id']?>">Groupe Sanguin</label>
                        <input type="text" name="groupe" class="form-control" id="groupe<?php echo $row['id']?>"
                            value="<?php echo $row['groupe_sanguin']?>">
                    </div>
                    <div class="form-group">
                        <label for="docteur<?php echo $row['id']?>">Docteur resp</label>
                        <select class="form-control" name="docteur" id="docteur<?php echo $row['id']?>">

                            <?php

                                $selectAllDoctorQuery = mysqli_query($linkDB, "Select * from `docteur`"); // SQL Query
                                while($doctor = mysqli_fetch_array($selectAllDoctorQuery))
                                {

                             ?>

                            <option value="<?php echo $doctor['id']?>"
                                <?php if($doctor['id']==$row['doctor_id']) echo 'selected="selected"'; ?>>
                                <?php echo $doctor['nom']?>
                            </option>

                            <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="date-admis<?php echo $row['id']?>">Date admise</label>
                        <input type="date" name="date-admis" class="form-control" id="date-admis<?php echo $row['id']?>"
                            value="<?php echo $row['date_admis']?>">
                    </div>
                    <div class="form-group">
                        <label for="date-sortie<?php echo $row['id']?>">Date sortie</label>
                        <input type="date" name="date-sortie" class="form-control"
                            id="date-sortie<?php echo $row['id']?>" value="<?php echo $row['date_sortie']?>">
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" name="status" class="form-check-input"
                            value="<?php if($row['status']=='1') echo 'yes' ?>" id="status<?php echo $row['id']?>"
                            <?php if($row['status']=='1') echo 'checked="checked"'; ?> />>
                        <label class="form-check-label" for="status<?php echo $row['id']?>">Status</label>
                    </div>
                    <input type="submit" name="updatePatient" class="btn btn-primary" value="modifier Patient" />

                </form>
            </div>
        </div>
    </div>
</div>




<?php }?>

<?php



       // session_start();
        // //------ PHP code for User registration form---
        // $error = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
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
           

            echo "Username entered is: ". $username . "<br/>";
            echo "status entered is: ". $status . "<br/>";
            echo "nom entered is: ". $nom . "<br/>";
            echo "password entered is: ". $password . "<br/>";
           
           
            $addPatientQuery="INSERT INTO `patient` ( `nom`, `username`, `password`, `date_naissance`, `date_admis`, `date_sortie`, `adresse`, `tel`, `groupe_sanguin`, `sexe`, `status`, `doctor_id`) VALUES ( '$nom', '$username', '$password', '$datenaissance', '$dateadmis', '$datesortie', '$adresse', '$tel', '$groupe', '$sexe', '$status', '$docteur')";
         
            $result = mysqli_query($linkDB, $addPatientQuery);

            if($result){
                echo "reussi";
                header("location: patientview.php"); 
                exit();     
            }else{
                echo "non";
            }



        }

   ?>


<?php include '../common/footer.php'?>
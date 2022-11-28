<?php include '../common/head.php'?>

<?php include '../connect.php' ?>
<?php $type='admin' ?>
<?php include_once '../common/navbar.php'?>

<h1>gestion des docteur</h1>

<section class="container">
    <div class="row list-el pt-4">
        <div class="col-6 offset-3">
            <div class="mb-2">
                <button type="button" class="col-2 offset-10 btn btn-primary bout" data-bs-toggle="modal"
                    data-bs-target="#ajouter">
                    Ajouter
                </button>
            </div>
            <div class="col-">
                <table class="table table-striped mt-3 datatable" id="datatable2">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Username</th>
                            <th scope="col">experience</th>
                            <th scope="col">Status</th>
                            <th scope="col" colspan="2">Action</th>

                        </tr>
                    </thead>
                    <tbody id="sites-table">

                        <?php
				$selectAllDoctorQuery = mysqli_query($linkDB, "Select * from `docteur`"); // SQL Query
				while($row = mysqli_fetch_array($selectAllDoctorQuery))
				{
                    ?>
                        <tr>
                            <td style="text-align:center;"> <?php echo $row['nom']?> </td>
                            <td style="text-align:center;"><?php echo $row['titre']?></td>
                            <td style="text-align:center;"><?php echo $row['username']?></td>
                            <td style="text-align:center;"><?php echo $row['experience']?></td>
                            <td style="text-align:center;"><?php echo $row['status']?></td>
                            <td style="text-align:center;"><button class="btn btn-warning bout" data-bs-toggle="modal"
                                    type="button" data-bs-target="#update_modal<?php echo $row['id']?>"> edit
                                </button>
                            </td>
                            <td style="text-align:center;"><button class="btn btn-warning bout"
                                    onclick="confirmerDel(<?php echo $row['id']?>)">delete </button> </td>

                        </tr>
                        <?php } ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
function confirmerDel(id) {
    let r = confirm("Are you sure you want to delete this record?");
    if (r == true) {
        window.location.assign("delete.php?id=" + id);
    }
}
</script>


<!-- modal ajouter un docteur -->


<div class="modal fade" id="ajouter" tabindex="-1" aria-labelledby="ajouterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajouterModalLabel">
                    Ajouter un docteur
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="medecin.php" method="POST">

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" name="nom" class="form-control" id="name" placeholder="Entrer votre nom">
                    </div>
                    <div class="form-group">
                        <label for="title">Qualification/titre</label>
                        <input type="text" name="titre" class="form-control" id="title"
                            placeholder="Entrer votre qualification">
                    </div>
                    <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" name="username" class="form-control" id="username"
                            placeholder="Entrer votre username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                            placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="experience">Annee d'experience</label>
                        <input type="text" name="experience" class="form-control" id="experience"
                            placeholder="Entrer annee d'experience">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="status" class="form-check-input" id="status">
                        <label class="form-check-label" for="status">Status</label>
                    </div>
                    <input type="submit" name="addDoctor" class="btn btn-primary" value="Add Doctor" />

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Boocle d'ajout -->
<?php
				$query = mysqli_query($linkDB, "Select * from `docteur`"); // SQL Query
				while($row = mysqli_fetch_array($query))
				{
                    ?>

<div class="modal fade" id="update_modal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">
                    Modifier docteur
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="update_query.php" method="POST">
                    <div class="form-group">
                        <label for="name<?php echo $row['id']?>">Nom</label>
                        <input type="text" name="nom" class="form-control" value="<?php echo $row['nom']?>"
                            id="name<?php echo $row['id']?>" placeholder="Entrer votre nom">
                        <input type="text" style="display:none;" name="idid" value="<?php echo $row['id']?>">
                    </div>
                    <div class="form-group">
                        <label for="title<?php echo $row['id']?>">Qualification/titre</label>
                        <input type="text" name="titre" class="form-control" value="<?php echo $row['titre']?>"
                            id="title<?php echo $row['id']?>" placeholder="Entrer votre qualification">
                    </div>
                    <div class="form-group">
                        <label for="username<?php echo $row['id']?>">username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $row['username']?>"
                            id="username<?php echo $row['id']?>" placeholder="Entrer votre username">
                    </div>
                    <div class="form-group">
                        <label for="email<?php echo $row['id']?>">Email</label>
                        <input type="email" name="email" class="form-control" id="email<?php echo $row['id']?>"
                            aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="experience<?php echo $row['id']?>">Annee d'experience</label>
                        <input type="text" name="experience" value="<?php echo $row['experience']?>"
                            class="form-control" id="experience<?php echo $row['id']?>"
                            placeholder="Entrer annee d'experience">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="status" class="form-check-input"
                            value="<?php if($row['status']=='1') echo 'yes' ?>" id="status<?php echo $row['id']?>"
                            <?php if($row['status']=='1') echo 'checked="checked"'; ?> />
                        <label class="form-check-label" for="status<?php echo $row['id']?>">Status</label>
                    </div>
                    <input type="submit" name="updateDoctor" class="btn btn-primary" value="update Doctor" />

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
            $titre = mysqli_real_escape_string($linkDB, $_POST['titre']);
            $username = mysqli_real_escape_string($linkDB, $_POST['username']);
            $email = mysqli_real_escape_string($linkDB, $_POST['email']);
            $password = mysqli_real_escape_string($linkDB, $_POST['password']);
            $experience = mysqli_real_escape_string($linkDB, $_POST['experience']);
            
            if ($_POST['status']== 'on'){
                $status = mysqli_real_escape_string($linkDB, '1');
            }else{
                $status = mysqli_real_escape_string($linkDB, '0');
            }
           

            echo "Username entered is: ". $username . "<br/>";
            echo "status entered is: ". $status . "<br/>";
            echo "nom entered is: ". $nom . "<br/>";
            echo "password entered is: ". $password . "<br/>";

            
            $query = "SELECT * FROM `docteur` WHERE `username`= '$username'";
            $del="DELETE FROM `docteur` WHERE id = 14 ";
            $que = "INSERT INTO `docteur` (`nom`, `username`, `password`, `date_naissance`, `titre`, `experience`, `status`, `prix_consultation`) VALUES ('louis paul', 'louis', 'somepass', '1990-11-01', 'generaliste', '12', '1', '900')";
            $addQuery= "INSERT INTO `docteur` ( `nom`, `username`, `password`, `date_naissance`, `titre`, `experience`, `status`, `prix_consultation`) VALUES ('$nom', '$username', '$password','1985-11-15', '$titre', '$experience', '$status', '1000')";
            
            $result = mysqli_query($linkDB,$addQuery);

            if($result){
                echo "reussi";
                header("location: medecin.php"); 
                exit();     
            }else{
                echo "non";
            }



        }

   ?>


<?php include '../common/footer.php'?>
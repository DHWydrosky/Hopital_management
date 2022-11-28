<?php include 'common/head.php'?>


<section class="container">
    <div class="row list-el pt-4">
        <div class="col-6 offset-3">
            <div class="col-">
                <h5 class="modal-title">
                    login
                </h5>
                <form action="login.php" method="POST">


                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                            placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" name="username" class="form-control" id="username"
                            placeholder="Entrer votre username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="type">type user</label>
                        <select class="form-control" name="type" id="type">
                            <option value="patient"> Patient </option>
                            <option value="docteur"> docteur </option>
                            <option value="admin">admin</option>
                        </select>

                    </div>
                    <input type="submit" name="signup" class="btn btn-primary" value="se connecter" />

                </form>
            </div>
        </div>
    </div>

    <?php



// session_start();
 // //------ PHP code for User registration form---
 // $error = "";
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
      include 'connect.php';
     
     $username = mysqli_real_escape_string($linkDB, $_POST['username']);
     $email = mysqli_real_escape_string($linkDB, $_POST['email']);
     $password = mysqli_real_escape_string($linkDB, $_POST['password']);
     $type = mysqli_real_escape_string($linkDB, $_POST['type']);
     
     
     if ($_POST['type']== 'patient'){
        $usernamePatientQuery="SELECT * FROM `patient` WHERE username='$username'";
        $usernamePatientExist = mysqli_query($linkDB, $usernamePatientQuery);

        echo "Username entered is: ". $username . "<br/>";
        echo "password entered is: ". $password . "<br/>";

        if($usernamePatientExist>0){
                 
            while($row = mysqli_fetch_array($usernamePatientExist)){
               
                if ($row['username']==$username && $row['password']==$password){
                    $_SESSION['user'] = $username;// set the username in a session. 
                    // This serves as a global variable
                  
                    
                    print '<script>window.location.assign("viewpatient.php?id="+'.$row['id'].');</script>';
                }else{
                    print '<script>alert("Incorrect Password!");</script>';        // Prompts the user
                    print '<script>window.location.assign("login.php");</script>';
                }

            }
        
        }else{
            print '<script>alert("Incorrect username!");</script>';       // Prompts the user
            print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
        }
       
     }else if ($_POST['type']== 'docteur'){
        
        $usernameDocteurQuery="SELECT * FROM `docteur` WHERE username='$username'";
        $usernameDocteurExist = mysqli_query($linkDB, $usernameDocteurQuery);

        echo "Username docter entered is: ". $username . "<br/>";
        echo "password entered is: ". $password . "<br/>";

        if($usernameDocteurExist>0){
                 echo "bouclue   jjfn <br/>";
            while($row = mysqli_fetch_array($usernameDocteurExist)){
               
                if ($row['username']==$username && $row['password']==$password){
                    $_SESSION['user'] = $username;// set the username in a session. 
                    // This serves as a global variable
                    print '<script>window.location.assign("viewdoctor.php?id="+'.$row['id'].');</script>';
                }else{
                    print '<script>alert("Incorrect Password!");</script>';        // Prompts the user
                    print '<script>window.location.assign("login.php");</script>';
                }

            }
        
        }else{
            print '<script>alert("Incorrect username!");</script>';       // Prompts the user
            print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
        }

     }else if($_POST['type']== 'admin'){

 
        $usernameAdminQuery="SELECT * FROM `admin` WHERE username='$username'";
        $usernameAdminExist = mysqli_query($linkDB, $usernameAdminQuery);

        echo "Username docter entered is: ". $username . "<br/>";
        echo "password entered is: ". $password . "<br/>";

        if($usernameAdminExist>0){
                 echo "bouclue   jjfn <br/>";
            while($row = mysqli_fetch_array($usernameAdminExist)){
               
                if ($row['username']==$username && $row['password']==$password){
                    $_SESSION['user'] = $username;// set the username in a session. 
                    // This serves as a global variable
                    print '<script>window.location.assign("doctor/medecin.php");</script>';
                }else{
                    print '<script>alert("Incorrect Password!");</script>';        // Prompts the user
                    print '<script>window.location.assign("login.php");</script>';
                }

            }
        
        }else{
            print '<script>alert("Incorrect username!");</script>';       // Prompts the user
            print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
        }


     }

 }

?>


    <?php include 'common/footer.php'?>
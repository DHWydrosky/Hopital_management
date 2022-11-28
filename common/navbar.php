<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Hopital</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                </li>
                <?php if($type){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="../doctor/medecin.php">Docteur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../patient/patientview.php">Patient</a>
                </li>
                <?php } ?>
            </ul>
            <span class="navbar-text">
                <a class="nav-link" href="../login.php">logout</a>
            </span>
        </div>
    </div>
</nav>
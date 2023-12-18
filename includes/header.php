<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img src="../data/img/LogoDSD.png" alt="Logo" class="img-f">
    </div>
    <ul class="sidebar-nav">
        <li class="nav-item"><a class="nav-link" href="../pages/home.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="../pages/tresorerie.php">Trésorerie</a></li>
        <li class="nav-item"><a class="nav-link" href="../pages/remises.php">Remises</a></li>
        <li class="nav-item"><a class="nav-link" href="../pages/impayes.php">Impayés</a></li>
        <?php
        if ($role == 0) {
            echo '
        <li class="nav-item"><a class="nav-link" href="../pages/userProfile.php">Mon profil</a></li>';
        }
        ?>

        <!-- TEMPORAIRE -->
        <li class="nav-item"><a class="nav-link" style="color:tomato" href="../account/deco.php">Se déconnecter</a></li>
    </ul>
    <hr>
    <div class="profile-section mt-auto">

        <div class="profile-picture text-center">
            <img src="../data/img/LogoDSD.png" alt="Photo de profil" class="img-f rounded-circle">
        </div>
        <div class="profile-info text-center">
            <div class="profile-name text-white"><?php echo $_SESSION['displayName'] ?></div>
            <div id="profile-email" class="profile-profession text-white"><?php echo $_SESSION['email'] ?></div>
        </div>
    </div>
</aside>

<div id="navbar-wrapper">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand" id="sidebar-toggle"><img src="../data/img/burger.png" width="35px" height="35px" alt=""></a>
            </div>
        </div>
    </nav>
    <span id="close-navbar"></span>
</div>

<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img src="../data/img/LogoDSD.png" alt="Logo" class="img-fluid">
    </div>
    <ul class="sidebar-nav">
        <li class="nav-item"><a class="nav-link" href="../pages/home.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Trésorerie</a></li>
        <li class="nav-item"><a class="nav-link" href="../pages/impayes.php">Impayés</a></li>
        <li class="nav-item"><a class="nav-link" href="../pages/userProfile.php">Mon profil</a></li>
        <li class="nav-item"><a class="nav-link" href="../pages/remises.php">Remises</a></li>

        <!-- TEMPORAIRE -->
        <li class="nav-item"><a class="nav-link" style="color:tomato" href="../account/deco.php">Se déconnecter</a></li>
    </ul>
    <hr>
    <div class="profile-section mt-auto">
        
        <div class="profile-picture text-center">
            <img src="../data/img/LogoDSD.png" alt="Photo de profil" class="img-fluid rounded-circle">
        </div>
        <div class="profile-info text-center">
            <div class="profile-name text-white"><?php echo $_SESSION['displayName']?></div>
            <div class="profile-profession text-white">heee</div>
        </div>
    </div>
</aside>

<div id="navbar-wrapper">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand" id="sidebar-toggle"><img src="../data/img/hamburger.svg" width="35px" height="35px" alt=""></a>
            </div>
        </div>
    </nav>
</div>
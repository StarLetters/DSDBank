<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/Home.css">
    <link rel="stylesheet" href="../css/varColor.css">
</head>

<body>
    <div class="">
        <div id="wrapper">

            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <img src="../data/img/LogoDSD.png" alt="Logo" class="img-fluid">
                </div>
                <ul class="sidebar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Analyse</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Mon portefeuille</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Compte</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Paramètres</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sécurité</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Centre d'assistance</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Mode sombre</a></li>
                </ul>
                <div class="profile-section mt-auto pt-7">
                    <div class="profile-picture text-center">
                        <img src="../data/img/LogoDSD.png" alt="Photo de profil" class="img-fluid rounded-circle">
                    </div>
                    <div class="profile-info text-center">
                        <div class="profile-name text-white">Prénom Nom</div>
                        <div class="profile-profession text-white">Profession</div>
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

            <section id="content-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="content-title text-white">Bonjour, <span>Prénom Nom</span></h2>
                    </div>
                </div>
            </section>
            <section>
                <div class="row">
                    <div class="col-lg-12">
                        <div style="height: 120px;"></div> 
                        <p class="text-white display-4 ml-5">Actualités</p>
                        <div style="height: 120px;"></div> 
                        <p class="text-white display-4 ml-5">Votre solde</p>
                        <div style="height: 120px;"></div> 
                        <p class="text-white display-4 ml-5">Mentions légales</p>
                    </div>
                </div>
            </section>
        </div>

    </div>
    <!-- Inclure le JavaScript de Bootstrap à la fin de la page -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <script>
        const $button = document.querySelector('#sidebar-toggle');
        const $wrapper = document.querySelector('#wrapper');

        $button.addEventListener('click', (e) => {
            e.preventDefault();
            $wrapper.classList.toggle('toggled');
        });
    </script>
</body>

</html>
<!-- on reprend l'entête de l'Ex, on change les href pour ne plus mettre le nom des pages, mais seulement ce que l'on veut dans l'url -->

<ul class="flexible space-evenly">
    <?php if (isset($_SESSION["user"])) : ?>
        <li class="menu"><a href="/">Home</a></li>
        <li class="menu"><a href="mesEcoles">Mes écoles</a></li>  <!-- index.php devient / -->
        <li  class="menu"><a href="updateProfil">Profil</a></li>
        <li  class="menu"><a href="deconnexion">Déconnexion</a></li>
    <?php else : ?>
        <li  class="menu"><a href="inscription">Inscription</a></li>
        <li  class="menu"><a href="connexion">Connexion</a></li>
    <?php endif ?> 
</ul>
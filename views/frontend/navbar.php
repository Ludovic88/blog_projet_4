<!-- =====  NAVBAR FRONTEND  =====  -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= PATH_PREFIX ?>/">Jean Forteroche <span class="min_title">blog officiel</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php active('/'); ?>">
                <a class="nav-link" href="<?= PATH_PREFIX ?>/">Accueil</a>
            </li>
            <li class="nav-item <?php active('/livre'); ?>">
                <a class="nav-link" href="<?= PATH_PREFIX ?>/livre">Livre</a>
            </li>
            <li class="nav-item <?php active('/contact'); ?>">
                <a class="nav-link" href="<?= PATH_PREFIX ?>/contact">Contact</a>
            </li>
        </ul>
    </div>
</nav> 
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/courPHP/blog_projet_4/">Jean Forteroche <span class="min_title">blog officiel</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php active('/admin'); ?>">
                <a class="nav-link" href="<?= PATH_PREFIX ?>/admin">Administration</a>
            </li>
            <li class="nav-item <?php active('/admin/editer-chapitre'); ?>">
                <a class="nav-link" href="<?= PATH_PREFIX ?>/admin/editer-chapitre">Editer chapitre</a>
            </li>
            <li class="nav-item <?php active('/admin/comment'); ?>">
                <a class="nav-link" href="<?= PATH_PREFIX ?>/admin/comment">Commentaires</a>
            </li>
        </ul>
    </div>
</nav> 
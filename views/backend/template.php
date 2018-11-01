<!-- =====  TEMPLATE  FRONTEND  =====  -->
<!DOCTYPE html>
<html>
    <head>
        <!-- === META & LINK ===  -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link href="<?= PATH_PREFIX; ?>/public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <!-- === NAVBAR ===  -->
        <?php include('navbar.php')?>
        

        <!-- === CONTENU ===  -->

        <div class="block_page">
            <?php
            if (isset($_SESSION['succes'])){
            ?>
                <div class="alert alert-<?= $_SESSION['class-message-succes']; ?>" role="alert">
                    <?= $_SESSION['message-succes'] ?>
                </div>
            <?php
            destroyMessageSucces();
            }
            ?>
                
            <?php 
                if (isset($_SESSION['connect'])) {
                    echo "<p><a href='/courPHP/blog_projet_4/deconnexion'>Déconnexion</a></p>";
                }
            ?>
            <!-- Execution d'une fonction qui vérifie si on a une alerte en session, si oui on l'affiche et on la supprime de la session -->
            <?= $content ?>
        </div>


        <!-- === SCRIPT ===  -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=psn53gxcft0i69plte6ewknlnv9gkoblqqf0hldcdabgk05v"></script>
        <script type="text/javascript" src="<?= PATH_PREFIX; ?>/public/js/TinyMce.js"></script>
    </body>
</html>
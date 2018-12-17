<!-- =====  FRONTEND // PAGE QUI AFFICHE TOUS LES POSTS  =====  -->


<!-- ===  TITRE ENTETE  === -->
<?php $title = 'Acceuil | Blog Jean Forteroche'; ?>



<!-- === PARTIE TEXTE D'ACCUEIL  === -->
<h1>Bienvenue sur le blog de Jean forteroche</h1>
<p class="para-acceuil">
	Bonjour et bienvenue sur mon blog. Pour ceux qui me découvre je suis Jean Forteroche écrivain de roman, je décide de faire une nouvelle aventure : écrire un nouveau roman disponible gratuitement sur internet que je posterais chapitre par chapitre. Vous pourrez laisser vos impréssions par commentaire, laisser des critiques bonnes ou mauvaises à vous de voir. Découvrirez ci-dessous mes 5 derniers chapitre postés.
</p>
<p class="para-acceuil">Bonne lecture à tous !</p>
<p class="para-acceuil"></p>



<!-- === PARTIE POSTS RéCENT  === -->
<?php
foreach ($posts as $post):
?>
	<div class="news">
		<h2>
			<a href="<?= PATH_PREFIX ?>/post?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']); ?></a>
		</h2>
			    
		<p class="chapter">
			<?= $post['post']; ?>
		</p>
		<p>
			<?= htmlspecialchars($post['author']); ?>
			<em>le <?= $post['date_creation_fr']; ?></em>
		</p>
		<p>
			<em><a href="<?= PATH_PREFIX ?>/post?id=<?= $post['id'] ?>">Commentaires</a></em>
		</p>
	</div>
<?php
endforeach;
?>
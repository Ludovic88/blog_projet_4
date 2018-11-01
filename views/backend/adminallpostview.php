<!-- =====  BACKEND // PAGE D'ACCUEIL PARTIE ADMIN  =====  -->


<!-- ===  TITRE ENTETE  === -->
<?php $title = 'Tous les  chapitres | Blog Jean Forteroche'; ?>


<!-- ===  LISTE DE TOUS LES CHAPITRES  === -->
<h1>Livre complet</h1>

<?php
foreach ($posts as $post):
?>
	<div>
		<h2>
			<a href="<?= PATH_PREFIX ?>/admin/modifier-chapitre?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']); ?></a>
		</h2>
			    
		<p class="chapter">
			<?= $post['post']; ?>
		</p>
		<p>
			<?= htmlspecialchars($post['author']); ?>
			<em>le <?= $post['date_creation_fr']; ?></em>
		</p>
		<p>
			<em><a href="<?= PATH_PREFIX ?>/admin/modifier-chapitre?id=<?= $post['id'] ?>">Modifier / suprimer chapitre | moderer commentaire</a></em>
		</p>
	</div>
<?php
endforeach;
?>
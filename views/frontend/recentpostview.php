<?php $title = 'Acceuil | Blog Jean Forteroche'; ?>

<?php ob_start(); ?>
<h1>Post Recent</h1>

<?php
while ($data = $posts->fetch()){
?>
	<div class="news">
		<h2>
			<?= htmlspecialchars($data['title']); ?>
		</h2>
			    
		<p>
			<?= nl2br(htmlspecialchars($data['post'])); ?>
		</p>
		<p>
			<?= htmlspecialchars($data['author']); ?>
			<em>le <?= $data['date_creation_fr']; ?></em>
		</p>
		<p>
			<em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
		</p>
	</div>
<?php
} // Fin de la boucle des billets
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
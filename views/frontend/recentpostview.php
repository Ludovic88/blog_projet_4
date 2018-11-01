<?php $title = 'Acceuil | Blog Jean Forteroche'; ?>

<h1>Post Recent</h1>

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

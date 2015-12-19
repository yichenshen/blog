<div class="container">
	<?php foreach ($posts as $post): ?>
		<h1>
			<?php if (isset($post->title)) echo htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?>
		</h1>
		
		<?php if (isset($post->content)) echo htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8'); ?>
	<?php endforeach; ?>

</div>

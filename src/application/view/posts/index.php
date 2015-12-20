<main>
<div class="text-center jumbotron">
	<h1><b>blog</b></h1>
</div>

<div class="container">
	<?php foreach($posts as $post): ?>
		<!-- Title and Post time -->
		<p>
			<h2>
				<a href = "<?php echo URL ?>posts/show/<?php echo $post->post_id ?>">
					<?php if (isset($post->title)) echo htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?>
				</a>
			</h2>
			<h4>
				<small>
					Posted at: 
					<?php echo $post->create_time; ?>
				</small>
			</h4>
		</p>
	
		<!-- Content -->
		<p>
			<?php if (isset($post->content)) echo nl2br(htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8')); ?>
		</p>
		<hr/>
	<?php endforeach;?>
</div>

</main>
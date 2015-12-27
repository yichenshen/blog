<main>
<div class = "container">
	<p>
		<h2>
			<?php if (isset($post->title)) echo htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?>
		</h2>
		<h4>
			<small>
				Posted at: 
				<?php echo $post->create_time; ?>
			</small>
		</h4>
	</p>
	<br /> 
	<p>
		<?php if (isset($post->content)) echo nl2br(htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8')); ?>
	</p>
	<hr />
</div>
<br />
<div class="container">
	<div class = "pull-right">
	<?php if(isset($_SESSION['user'])): ?>
		<a href="<?php echo URL . "posts/edit/" . $post->post_id; ?>">Edit</a>
		|
	<?php endif; ?>
	<a href="<?php echo URL; ?>">Back</a>
	</div>
</div>
</main>
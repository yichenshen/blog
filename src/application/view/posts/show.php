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
		<h4>
			<small>
				By
				<?php echo $post->user_username ?>
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

<!-- Comments Section -->
<div class="container">
	<div>
		<h3 class="low-margin"><b>Comments</b></h3>
		<?php foreach($comments as $comment): ?>
			<div class="well">
				<p>
					<strong><?php if (isset($comment->author_name)) echo htmlspecialchars($comment->author_name, ENT_QUOTES, 'UTF-8'); ?></strong>
				</p>
				<p>
					<?php if (isset($comment->content)) echo nl2br(htmlspecialchars($comment->content, ENT_QUOTES, 'UTF-8')); ?>
				</p>
				<p class="text-muted">
					<small><?php echo $comment->create_time; ?></small>
				</p>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<div class="container">
	<div class = "pull-right">
	<?php if(isset($_SESSION['user']) && $post->user_username === $_SESSION['user']): ?>
		<a href="<?php echo URL . "posts/edit/" . $post->post_id; ?>">Edit</a>
		|
	<?php endif; ?>
	<a href="<?php echo URL; ?>">Back</a>
	</div>
</div>
</main>
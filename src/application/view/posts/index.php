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

	<nav>
	  <ul class="pager">
	  	<?php if($page !== 1): ?>
		    <li class="previous"><a href="<?php echo URL . 'posts/page/'. ($page - 1);?>"><span aria-hidden="true">&larr;</span> Older</a></li>
		<?php endif; ?>

		<?php if($page !== $total_pages): ?>
		    <li class="next"><a href="<?php echo URL . 'posts/page/'. ($page + 1); ?>">Newer <span aria-hidden="true">&rarr;</span></a></li>
		<?php endif; ?>
	  </ul>
	</nav>
</div>

</main>
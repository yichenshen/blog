<div class="container">
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#commentBox">
		Add New Comment
	</button>

	<!-- Modal -->
	<div class="modal fade" id="commentBox" tabindex="-1" role="dialog" aria-labelledby="commentBoxLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="commentBoxLabel">New Comment</h4>
			    </div>
	      
	    		<form action="<?php echo URL . 'comments/create/' . $post->post_id; ?>" method="post">
		     		<div class="modal-body">
		       			<div class="form-group">
		       				<label for="title" class="sr-only">Name ('Anonymous' if blank)</label>
					    	<input type="text" name="name" class="form-control" placeholder="Name ('Anonymous' if blank)" />
		       			</div>
		       			<div class="form-group">
		       				<label for="content" class="sr-only">Comment</label>
					    	<textarea name="content" class="form-control" rows = "10" placeholder="Comment"></textarea>
		       			</div>
		    		</div>
		    		
		    		<div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <input type="submit" class="btn btn-primary" />
			    	</div>
			    </form>
	    	</div>
		</div>
	</div>

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
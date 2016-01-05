<div class="container">
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#commentBox" data-type = "new"  data-postid="<?php echo $post->post_id; ?>" >
		Add New Comment
	</button>

	<h3 class="low-margin"><b>Comments</b></h3>

	<?php foreach($comments as $comment): ?>
		<div class="well">
			<?php if(isset($_SESSION['user']) && $_SESSION['user'] === $comment->user_username): ?>
				<div class="pull-right">
					<a 	data-toggle="modal" 
						href="#commentBox" 
						data-type = "edit" 
						data-commentid="<?php echo $comment->comments_id; ?>" 
						data-postid="<?php echo $comment->post_id; ?>" 
					>

						<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span class="sr-only">Edit</span>	
					</a>
					|
					<form 	action = "<?php echo URL . 'comments/delete/' . $comment->post_id . '/' . $comment->comments_id; ?>" 
							method = "POST"
							style = "display:inline;">

					    <!-- Confirm delete dialog -->
					    <a  href = "#" 
					        onclick="if(confirm(&quot;Are you sure you want to delete this post?&quot;)) this.parentNode.submit()">
					        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					        <span class="sr-only">Delete</span>
					    </a>
					</form>
				</div>
			<?php endif; ?>
			<p class="comment-author">
				<strong><?php if (isset($comment->author_name)) echo htmlspecialchars($comment->author_name, ENT_QUOTES, 'UTF-8'); ?></strong>
			</p>
			<p class="comment-content">
				<?php if (isset($comment->content)) echo nl2br(htmlspecialchars($comment->content, ENT_QUOTES, 'UTF-8')); ?>
			</p>
			<p class="text-muted">
				<small><?php echo $comment->create_time; ?></small>
			</p>
		</div>
	<?php endforeach; ?>
</div>

<!-- Modal -->
<!-- Content is loaded dynamically from JS in /public/js/application.js -->
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
	       				<?php $default_name = isset($_SESSION['user']) ? $_SESSION['user'] : 'Anonymous'; ?> 
	       				<label for="title" class="sr-only">Name ('<?php echo $default_name; ?>' if blank)</label>
				    	<input id='authorField' type="text" name="name" class="form-control" placeholder="Name ('<?php echo $default_name; ?>' if blank)" maxlength=60 />
	       			</div>
	       			<div class="form-group">
	       				<label for="content" class="sr-only">Comment</label>
				    	<textarea id='contentField' name="content" class="form-control" rows = "10" placeholder="Comment" maxlength=4000 required></textarea>
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

<main>
<div class="container">
	<h1>New Article</h1>

	<?php require APP . 'view/_templates/errorbox.php'; ?>

	<form action = "<?php echo URL; ?>posts/create" method = "post">

	    <div class="form-group">
	    	<label for="title" class="sr-only">Title</label>
	    	<input type="text" name="title" class="form-control" placeholder="Title" maxlength=250 required/>
	    </div>
	   
	    <div class="form-group">
	    	<label for="content" class="sr-only">Text</label>
	    	<textarea name="content" class="form-control" rows = "20" placeholder="Text" required></textarea>
	    </div>
	   
	   	<input type="submit" class="btn btn-primary">
	</form>

	<br />

	<a href="<?php echo URL; ?>posts/admin/1" class="pull-right">Back</a>
</div>
</main>

<?php if(isset($error)): ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		
		<strong>Error!</strong>
		<?php echo $error; ?>
	</div>
<?php endif; ?>
